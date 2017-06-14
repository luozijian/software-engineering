<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;

class AdminController extends AppBaseController
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function bossName(Request $request,EmployeeRepository $repository)
    {
        $boss = $repository->find($request->boss_id);
        $name = '';
        if($boss){
            $name = $boss->name;
        }
        return \Response::json(compact('name'));
    }

    public function signerName(Request $request)
    {
        $employee = Employee::where('work_id', $request->work_id)->first();

        if ($employee && $employee->isOn()) {
            $name = $employee->name;
        }

        return \Response::json(compact('name'));
    }

}
