<?php
namespace App\Services;

use Excel;

class ExcelService{


    public function export($filename,$data,$head,$width="")
    {
        return Excel::create($filename, function($excel) use($data,$head,$width){

            $excel->sheet('Sheet1', function($sheet) use($data,$head,$width){

                $sheet->fromArray($data, null, 'A1', false, false);

                $sheet->prependRow($head);

                if($width){
                    $sheet->setWidth($width);
                }
            });
        })->export('xlsx');
    }

    public function isExcel($name)
    {
        return strstr($name,'.xlsx');
    }

    public function import($path)
    {
        $result=Excel::load($path)->all();
        $data=[];
        foreach($result as $row){
            $data[]=$row->toArray();
        }
        return $data;
    }


    public function exportByView($name,$view,$key,$data,$width="")
    {
        return Excel::create($name, function($excel)use($view,$key,$data,$width) {
            $excel->sheet('sheet1', function($sheet)use($view,$key,$data,$width) {
                if($width){
                    $sheet->setWidth($width);
                }
                $sheet->loadView($view)->with($key,$data);
            })->download('xlsx');
        });
    }
}