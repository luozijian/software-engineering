<?php

namespace App\Http\Controllers;

use App\Models\Spider;
use Beanbun\Beanbun;

class SpiderController extends Controller
{
    public function index()
    {
        $beanbun = new Beanbun;
        $seeds = [];
        //36273
        for($i = 25532;$i <= 25533;$i++){
            $url = 'http://2017.jsjds.org/chaxun/index.php?keys='.$i;
            array_push($seeds,$url);
        }
        $beanbun->seed = $seeds;
        $beanbun->afterDownloadPage = function($beanbun) {
            file_put_contents( '/public/'.$beanbun->url, $beanbun->page);
        };
        $beanbun->start();
    }
}
