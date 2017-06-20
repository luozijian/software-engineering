<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Employee;
use App\Models\Product;
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
        $series = [];
        $employees = Employee::where('status','on')->get();
        $product_ids = Product::where('status','on')->pluck('id');
        foreach ($employees as $employee){
            $serie['name'] = $employee->name;

            foreach ($product_ids as $key => $product_id){
                $count = $employee->policies()->where(compact('product_id'))->count();
                $serie['data'][$key] = $count;
            }
            array_push($series,$serie);
        }
        $products = Product::where('status','on')->pluck('name');

        $series = json_encode($series);
        $products = json_encode($products);

        return view('home',compact('series','products'));
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
