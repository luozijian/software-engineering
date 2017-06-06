<?php

namespace App\Http\Controllers;

use App\Criteria\MyPolicyCriteria;
use App\Criteria\OrderByCriteria;
use App\Criteria\SelectCriteria;
use App\Http\Requests;
use App\Http\Requests\CreatePolicyRequest;
use App\Http\Requests\UpdatePolicyRequest;
use App\Models\Channel;
use App\Models\ChannelProduct;
use App\Models\Employee;
use App\Models\Policy;
use App\Models\Product;
use App\Repositories\PolicyRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use App\Services\ExcelService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use App\Criteria\RequestCriteria;
use Response;

class PolicyController extends InfyOmBaseController
{
    /** @var  PolicyRepository */
    private $policyRepository;

    public function __construct(PolicyRepository $policyRepo)
    {
        parent::__construct();
        $this->policyRepository = $policyRepo->pushCriteria(new MyPolicyCriteria());
    }

    /**
     * Display a listing of the Policy.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        \Session::put("policy_back_url", $request->getRequestUri());
        $this->policyRepository->pushCriteria(new RequestCriteria($request))->orderBy('id', 'desc');
        $policies = $this->policyRepository->with(['policieable'])->paginate(15);

        return view('policies.index')
            ->with('policies', $policies);
    }

    /**
     * Show the form for creating a new Policy.
     *
     * @return Response
     */
    public function create()
    {
        return view('policies.create');
    }

    /**
     * Store a newly created Policy in storage.
     *
     * @param CreatePolicyRequest $request
     *
     * @return Response
     */
    public function store(CreatePolicyRequest $request)
    {
        $input = $request->all();

        if (!$input['currency']){
            //结算方式1美元0港币
            $input['repay_amount'] = $input['repay_amount'] / option('rate');//美元兑换港币
        }
        $input['repay_amount_year'] = $input['repay_amount'] / $input['repay_year'];//计算年供款

        $employee = Employee::where('work_id', $request->work_id)->first();
        $channel = Channel::where('work_id', $request->work_id)->first();

        if ($employee && $employee->isOn()) {
            $input['job_point'] = $employee->job_point;

            \DB::beginTransaction();

            $policy = $employee->policies()->create($input);

            $this->storePerformance($policy, $employee);//计算业绩并存储

            $performance = $policy->performances()->sum('release_amount');

            $policy->update(compact('performance'));

            \DB::commit();

            Flash::success('员工单据新增成功');

        } elseif ($channel && $channel->isOn()) {
            $input['job_point'] = $channel->job_point;

            $product = ChannelProduct::where('product_id',$input['product_id'])->where('channel_id',$channel->id)->first();

            if (!$product->is_confirm){
                Flash::error('渠道产品未修改');

                return redirect(route('policies.create'))->withInput();
            }

            \DB::beginTransaction();

            $policy = $channel->policies()->create($input);

            $this->storePerformance($policy, $channel);//计算业绩并存储

            $performance = $policy->performances()->sum('release_amount');

            $policy->update(compact('performance'));

            \DB::commit();

            Flash::success('渠道单据新增成功');
        } else {
            Flash::error('员工和渠道不存在或已离职');

            return redirect(route('policies.create'))->withInput();
        }

        return redirect(session('policy_back_url', route('policies.index')));
    }

    /**
     * Display the specified Policy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $policy = $this->policyRepository->findWithoutFail($id);

        if (empty($policy)) {
            Flash::error('找不到页面');

            return redirect(session('policy_back_url', route('policies.index')));
        }

        return view('policies.show')->with('policy', $policy);
    }

    /**
     * Show the form for editing the specified Policy.
     *
     * @param  int $id
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        $policy = $this->policyRepository->findWithoutFail($id);

        if (empty($policy)) {
            Flash::error('找不到页面');

            return redirect(session('policy_back_url', route('policies.index')));
        }

        return view('policies.edit')->with('policy', $policy);
    }

    /**
     * Update the specified Policy in storage.
     *
     * @param  int $id
     * @param UpdatePolicyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePolicyRequest $request)
    {
        $policy = $this->policyRepository->findWithoutFail($id);

        if (empty($policy)) {
            Flash::error('找不到页面');

            return redirect(session('policy_back_url', route('policies.index')));
        }

        $input = $request->all();

        $policy = $this->policyRepository->update($input, $id);

        Flash::success('员工单据编辑成功');

        return redirect(session('policy_back_url', route('policies.index')));
    }

    /**
     * Remove the specified Policy from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $policy = $this->policyRepository->findWithoutFail($id);

        if (empty($policy)) {
            Flash::error('找不到页面');

            return redirect(session('policy_back_url', route('policies.index')));
        }

        $performances = $policy->performances;

        \DB::beginTransaction();

        foreach ($performances as $performance){
            $signer = $performance->performanceable;
            if($performance->isPersonal()){
                $signer->personal_performance -= $performance->release_amount;
            }else{
                $signer->team_performance -= $performance->release_amount;
            }
            $signer->total_performance -= $performance->release_amount;
            $signer->save();
        }

        $policy->performances()->delete();

        $this->policyRepository->delete($id);

        \DB::commit();

        Flash::success('删除成功');

        return redirect(session('policy_back_url', route('policies.index')));
    }



    //发放佣金
    public function release($id)
    {
        $policy = $this->policyRepository->findWithoutFail($id);

        if (empty($policy)) {
            Flash::error('找不到页面');

            return redirect(session('policy_back_url', route('policies.index')));
        }
        if ($policy->isFinished()){
            Flash::error('保单佣金已发完');

            return redirect(session('policy_back_url', route('policies.index')));
        }
        if (!$policy->isRenewal()) {
            //保单未续费
            Flash::error('请缴费后再发放佣金');

            $policy = $this->policyRepository->update(['is_renewal' => 0], $id);

            return redirect(session('policy_back_url', route('policies.index')));
        }
        if ($message = $policy->hasReleased()) {
            //未到可发放时间
            Flash::error($message);

            return redirect(session('policy_back_url', route('policies.index')));
        }

        return view('policies.release', compact('policy'));
    }

    //处理post保单数据
    public function storeReleaseRecord($id, Request $request)
    {
        $policy = $this->policyRepository->with(['product', 'policieable'])->findWithoutFail($id);

        if (empty($policy)) {
            Flash::error('找不到页面');

            return redirect(session('policy_back_url', route('policies.index')));
        }

        $input = $request->all();//用户输入数据，发放方式，发放时间等

        $signer = $policy->policieable;//获取签单员

        if ($signer->isEmployee()){
            $signer = Employee::where('work_id',$policy->work_id)->first();//获取第一签单员
        }else{
            $signer = Channel::where('work_id',$policy->work_id)->first();//获取第一签单员
        }

        if (empty($signer)) {
            Flash::error('单据找不到第一签单员!');

            return redirect(session('policy_back_url', route('policies.index')));
        }

        $personal_commission = $this->getPersonalCommission($signer, $policy);//获取个人佣金

        $input['current_count'] = $policy->commission_release_count + 1;//佣金发放记录当前发放次数

        \DB::beginTransaction();

        $policy->commissionReleaseRecords()->create(array_merge($personal_commission, $input));//存储个人佣金发放记录

        //签单员有上级
        if ($boss = $signer->boss) {
            $level = 0;
            $job_point_diff = $signer->getJobPointDiff($level);//获取与上级职级差
            $this->storeTeamCommission($boss, $policy, $input, $job_point_diff, $level);//存储团队佣金发放记录
        }

        $data = [];
        $data['commission_release_count'] = $input['current_count'];

        if ($input['current_count'] == 1){//第一次发放佣金
            if ($policy->product->isTypeA()){
                $data['commission'] = $policy->commissionReleaseRecords()->sum('release_amount');
            }else{
                $data['commission'] = $policy->commissionReleaseRecords()->sum('release_amount') * $policy->product->year_period_count;
            }
        }

        $policy = $this->policyRepository->update($data, $id);//更新单据的佣金发放次数

        \DB::commit();

        Flash::success('发放佣金成功');

        return redirect(session('policy_back_url', route('policies.index')));
    }






    //发放业绩
    protected function storePerformance($policy, $signer)
    {
        $data = [];
        $data['policy_id'] = $policy->id;
        $data['product_id'] = $policy->product->id;
        $data['repay_amount'] = $policy->repay_amount;//获取供款总额
        $data['repay_year'] = $policy->repay_year;//获取供款年期
        $data['job_point'] = $policy->job_point;//获取签单时员工职级

        $this->releasePersonalPerformance($policy, $signer, $data);
    }

    //发放个人业绩





}