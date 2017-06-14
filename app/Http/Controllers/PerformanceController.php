<?php

namespace App\Http\Controllers;

use App\Criteria\MyEmployeeCriteria;
use App\Http\Requests;
use App\Http\Requests\CreatePerformanceRequest;
use App\Http\Requests\UpdatePerformanceRequest;
use App\Models\Channel;
use App\Models\Employee;
use App\Repositories\ChannelRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\PerformanceRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use App\Criteria\RequestCriteria;
use Response;

class PerformanceController extends InfyOmBaseController
{
    /** @var  PerformanceRepository */
    private $performanceRepository;

    public function __construct(PerformanceRepository $performanceRepo)
    {
        parent::__construct();
        $this->performanceRepository = $performanceRepo;
    }

    /**
     * Display a listing of the Performance.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    	\Session::put("performance_back_url",$request->getRequestUri());
        $this->performanceRepository->pushCriteria(new RequestCriteria($request))->orderBy('id','desc');
        $performances = $this->performanceRepository->with('employee')->paginate(15);

        return view('performances.index',compact('performances'));
    }

    /**
     * Show the form for creating a new Performance.
     *
     * @return Response
     */
    public function create()
    {
        return view('performances.create');
    }

    /**
     * Store a newly created Performance in storage.
     *
     * @param CreatePerformanceRequest $request
     *
     * @return Response
     */
    public function store(CreatePerformanceRequest $request)
    {
        $input = $request->all();

        $performance = $this->performanceRepository->create($input);

        Flash::success('新增成功');

        return redirect(session('performance_back_url',route('performances.index')));
    }

    /**
     * Display the specified Performance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $performance = $this->performanceRepository->findWithoutFail($id);

        if (empty($performance)) {
            Flash::error('找不到页面');

            return redirect(session('performance_back_url',route('performances.index')));
        }

        return view('performances.show')->with('performance', $performance);
    }

    /**
     * Show the form for editing the specified Performance.
     *
     * @param  int $id
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        $performance = $this->performanceRepository->findWithoutFail($id);

        if (empty($performance)) {
            Flash::error('找不到页面');

            return redirect(session('performance_back_url',route('performances.index')));
        }

        return view('performances.edit')->with('performance', $performance);
    }

    /**
     * Update the specified Performance in storage.
     *
     * @param  int              $id
     * @param UpdatePerformanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePerformanceRequest $request)
    {
        $performance = $this->performanceRepository->findWithoutFail($id);

        if (empty($performance)) {
            Flash::error('找不到页面');

            return redirect(session('performance_back_url',route('performances.index')));
        }

        $input=$request->all();

        $performance = $this->performanceRepository->update($input, $id);

        Flash::success('编辑成功');

        return redirect(session('performance_back_url',route('performances.index')));
    }

    /**
     * Remove the specified Performance from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $performance = $this->performanceRepository->findWithoutFail($id);

        if (empty($performance)) {
            Flash::error('找不到页面');

            return redirect(session('performance_back_url',route('performances.index')));
        }

        $this->performanceRepository->delete($id);

        Flash::success('删除成功');

        return redirect(session('performance_back_url',route('performances.index')));
    }

    public function indexByEmployee(Request $request,EmployeeRepository $employeeRepository)
    {
        \Session::put("performance_back_url",$request->getRequestUri());
        $employeeRepository->pushCriteria(new RequestCriteria($request))->pushCriteria(new MyEmployeeCriteria())->orderBy('id','desc');
        $employees = $employeeRepository->with('performances')->paginate(15);

        $input = $request->all();
        if (isset($input['start_at'])){
            if (!$input['end_at']){
                $input['end_at'] = Carbon::now()->toDateTimeString();
            }
            foreach ($employees as &$employee){
                $employee['personal_performance'] = $employee->performances()->where('type','personal')->whereBetween('created_at',[$input['start_at'],$input['end_at']])->sum('release_amount');
                $employee['team_performance'] = $employee->performances()->where('type','team')->whereBetween('created_at',[$input['start_at'],$input['end_at']])->sum('release_amount');
                $employee['total_performance'] = $employee['personal_performance'] + $employee['team_performance'];

            }
        }
        return view('performances.indexByEmployee')->with('employees', $employees);
    }
}
