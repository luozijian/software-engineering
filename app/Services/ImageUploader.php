<?php

namespace App\Services;

use Illuminate\Http\Request;


class ImageUploader
{

    /**
     * @var Request
     */
    private $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $file
     *
     * @return $this
     */
    public function upload($index,$path,&$input)
    {
        $save_path=public_path(str_finish($path, '/'));

        if(!is_dir($save_path)){
            \File::makeDirectory($save_path, 0755, true);
        }

        $file= $this->request->file($index);
        if($file){
            $filename=md5(time()).".".$file->getClientOriginalExtension();
            $file->move($save_path,$filename);
            $input[$index]=str_finish($path, '/').$filename;
        }
    }
}
