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
        $policies = $this->policyRepository->with(['employee'])->paginate(15);

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

        $employee = Employee::where('work_id', $request->work_id)->first();

        if ($employee && $employee->isOn()) {
            $input['job_point'] = $employee->job_point;

            \DB::beginTransaction();

            $input['performance'] = $input['deal_amount'] * $input['job_point'];

            $policy = $employee->policies()->create($input);

            $input['release_amount'] = $input['performance'];
            $performance = $employee->performances()->create($input);

            \DB::commit();

            Flash::success('员工单据新增成功');

        } else {
            Flash::error('员工不存在或已离职');

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

        \DB::beginTransaction();

        $policy->performances()->delete();

        $this->policyRepository->delete($id);

        \DB::commit();

        Flash::success('删除成功');

        return redirect(session('policy_back_url', route('policies.index')));
    }

}