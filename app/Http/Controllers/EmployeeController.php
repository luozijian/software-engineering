<?php

namespace App\Http\Controllers;

use App\Criteria\MyEmployeeCriteria;
use App\Http\Requests;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use App\Criteria\RequestCriteria;
use Response;

class EmployeeController extends InfyOmBaseController
{
    /** @var  EmployeeRepository */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        parent::__construct();
        $this->employeeRepository = $employeeRepo->pushCriteria(new MyEmployeeCriteria());

    }

    /**
     * Display a listing of the Employee.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    	\Session::put("employee_back_url",$request->getRequestUri());
        $this->employeeRepository->pushCriteria(new RequestCriteria($request))->orderBy('id','desc');
        $employees = $this->employeeRepository->with('rank')->paginate(15);

        return view('employees.index')
            ->with('employees', $employees);
    }

    /**
     * Show the form for creating a new Employee.
     *
     * @return Response
     */
    public function create()
    {
        $bosses = [null=>'请选择'] + Employee::pluck('work_id','id')->toArray();

        return view('employees.create',compact('bosses'));
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param CreateEmployeeRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeeRequest $request)
    {
        $input = $request->all();

        //是否有上司
        if($input['boss_id']){
            $boss = $this->employeeRepository->findWithoutFail($input['boss_id']);
        }else{
            $input['boss_id'] = 0;
        }

        \DB::beginTransaction();

        $user = $this->storeUser($input);

        $employee = $user->employee()->create($input);

        \DB::commit();

        Flash::success('新增成功');

        return redirect(session('employee_back_url',route('employees.index')));

    }

    /**
     * Display the specified Employee.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);

        if (empty($employee)) {
            Flash::error('找不到页面');

            return redirect(session('employee_back_url',route('employees.index')));
        }

        return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified Employee.
     *
     * @param  int $id
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);

        if (empty($employee)) {
            Flash::error('找不到页面');

            return redirect(session('employee_back_url',route('employees.index')));
        }

        $subordinate_ids = array_column($employee->getAllSubordinates(),'id');

        array_push($subordinate_ids,$employee->id);

        $bosses = [null=>'请选择'] + Employee::whereNotIn('id',$subordinate_ids)->pluck('work_id','id')->toArray();

        return view('employees.edit',compact('employee','bosses'));
    }

    /**
     * Update the specified Employee in storage.
     *
     * @param  int              $id
     * @param UpdateEmployeeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);

        if (empty($employee)) {
            Flash::error('找不到页面');

            return redirect(session('employee_back_url',route('employees.index')));
        }

        $input = $request->all();

        //是否有上司
        if($input['boss_id']){

            if ($input['boss_id'] == $id){
                Flash::error('自己不能当自己上司');

                return redirect(route('employees.edit',$id))->withInput();
            }

            $boss = $this->employeeRepository->findWithoutFail($input['boss_id']);

        }else{
            $input['boss_id'] = 0;
        }

        $employee = $this->employeeRepository->update($input, $id);

        Flash::success('编辑成功');

        return redirect(session('employee_back_url',route('employees.index')));

    }

    /**
     * Remove the specified Employee from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employee = $this->employeeRepository->findWithoutFail($id);

        if (empty($employee)) {
            Flash::error('找不到页面');

            return redirect(session('employee_back_url',route('employees.index')));
        }

        $employee->user()->delete($employee->user_id);

        $this->employeeRepository->update(['status'=>'off'],$id);

        Flash::success('离职成功');

        return redirect(session('employee_back_url',route('employees.index')));
    }

    public function storeUser($input)
    {
        $user['name'] = $input['name'];
        $user['email'] = $input['work_id'];
        $user['password'] = substr($input['phone'],-6);
        $user = User::create($user);
        $user->roles()->attach($input['role_id']);
        return $user;
    }
}
