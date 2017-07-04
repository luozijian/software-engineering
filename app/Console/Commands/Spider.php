<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;


class Spider extends Command
{
    private $totalPageCount;
    private $counter        = 1;
    private $concurrency    = 16;  // 同时并发抓取
    protected $ids = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->totalPageCount = 10741;

        $client = new Client();

        $requests = function ($total) use ($client) {
            //25532-36273
            for ($i = 25532;$i <= 36273;$i++) {
                array_push($this->ids,$i);
                $uri = 'http://2017.jsjds.org/chaxun/index.php?keys=' . $i;
                yield function() use ($client, $uri) {
                    return $client->getAsync($uri);
                };
            }
        };

        $pool = new Pool($client, $requests($this->totalPageCount), [
            'concurrency' => $this->concurrency,
            'fulfilled'   => function ($response, $index)use($client){

                $res = $response->getBody()->getContents();

                //匹配作品名
                preg_match('/(?<=作品名称<\/td>)\s+<td colspan="5">((\p{Han})+|\w+|\,|\"|\s+|d+|\《|\》|\-|\·|\—|\（|\）|\\(|\\)|\_|\＋|\－|\'|\！|\？|\，|\の|\：|\、|\?|\。|\】|\【|\!|\”|\“|\.){0,9}/iu',$res,$match);

                $name = ltrim($match[0]);
                $name = ltrim($name,'<td colspan="5">');

                preg_match('/(?<=作品分类<\/td>)\s+<td colspan="5">((\p{Han})+|\w+|\\(|\\)|\-|\）|\（){0,9}/iu',$res,$g);
                $group = ltrim($g[0]);
                $group = ltrim($group,'<td colspan="5">') . '--';


                $imgs = [];
                if ($name && !strpos($group,'省赛')){
                    $name = $group.$name;

//                    preg_match('/(?<=<td colspan="5">)((\p{Han})+|\w+|\"|\,|\s+|\d+|\《|\》|\-|\·|\—|\（|\）|\\(|\\)|\_|\＋|\－|\'|\！|\？|\，|\の|\：|\、|\?|\。|\】|\【|\!){0,9}/iu',$match[0],$work_name);

//                    $this->info($work_name[0]);
//                    exit();
                    //匹配图片地址
                    preg_match_all('/\/dasai\/assets\/uploadFiles\/\w+\/\w+\.\w+/',$res,$match);
                    if (count($match[0])){
                        foreach ($match[0] as $item){
                            $imgs[] = 'http://2017.jsjds.org'.$item;//匹配图片线上地址
                        }
                    }else{
                        preg_match_all('/http:\/\/\w+\.\w+\.\w+\/\w+\/\w+\.\w+/',$res,$match);
                        foreach ($match[0] as $item) {
                            $imgs[] = $item;//匹配图片线上地址
                        }
                    }

                    $data = [];
                    foreach ($imgs as $img){
                        $data[] = $client->get($img)->getBody()->getContents();//下载图片
                    }


                    //匹配文件夹
                    $path = '/home/vagrant/Code/software-engineering/';
                    preg_match_all('/(?<=\/uploadFiles\/)\w+\//',$res,$dir);

                    $dirs = [];
                    if (count($dir[0])){
                        foreach ($dir[0] as $item){
                            $dirs[] = $path.'public/files/dasai/assets/uploadFiles/'.$item;//拼接文件夹
                        }

                        $files = [];
                        foreach ($match[0] as $key => $item){
                            preg_match('/\/2017\w+\.\w+/',$item,$file);//匹配文件名
                            $files[] = ltrim($file[0],'/');

                            if (!is_dir($dirs[$key])){
                                //如果文件夹不存在则创建文件夹
                                mkdir($dirs[$key], 0777);
                            }
                            if (!file_exists($dirs[$key].$files[$key])){
                                file_put_contents($dirs[$key].$files[$key],$data[$key]);
                            }
                        }

                        $res = str_replace('/dasai/assets','./dasai/assets',$res);
                        file_put_contents($path.'public/files/'.$name.'.html',$res);
                    }else{
                        foreach ($match[0] as $key => $item){
                            $temp = ltrim($item,'http://');
                            $dirs[] = $path . 'public/files/'.$temp;
                            if (!file_exists($dirs[$key])){
                                file_put_contents($dirs[$key],$data[$key]);
                            }
                        }

                        $res = str_replace('http://','./',$res);

                        file_put_contents($path.'public/files/'.$name.'.html',$res);

                    }

                    $this->info("请求第".($index+1)."个请求，作品编号:".$this->ids[$index]);

                }
//              else{
//                    \Log::info($this->ids[$index]);
//                    $this->info("请求第".($index+1)."个请求，作品不存在,编号：".$this->ids[$index]);
//                }


                $this->countedAndCheckEnded();
            },
            'rejected' => function ($reason, $index){
                $this->error("rejected".$this->ids[$index]);
                \Log::info($this->ids[$index]." rejected reason: " . $reason);
                $this->countedAndCheckEnded();
            },
        ]);

        // 开始发送请求
        $promise = $pool->promise();
        $promise->wait();

    }

    public function countedAndCheckEnded()
    {
        if ($this->counter < $this->totalPageCount){
            $this->counter++;
            return;
        }
        $this->info("请求结束！");
    }
}
