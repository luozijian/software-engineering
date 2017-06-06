<?php
/*
 * Created by PhpStorm.
 * User: Remx
 * Time: 17/12/15 PM4:32
 */

function textAreaToHtml($text){
    $text=str_replace("\n","<br>",$text);
    $text=str_replace(" ","&nbsp;",$text);
    return $text;
}
function weekNumber($timestamp = 'today') {
    $date_now=date("j");
    $cal_result=(int)ceil($date_now/7);
    return $cal_result;
    //if($timestamp == 'today') $timestamp = time();
    //return date("W", $timestamp) - date("W", strtotime(date("Y-m-01", $timestamp))) + 1;
}

function _debug($data,$die=false){
    if(\Request::get('debug')){
        if($die){
            dd($data);
        }else{
            dump($data);
        }
    }
}

function subtext($text, $length){
    if(mb_strlen($text, 'utf8') > $length)
        return mb_substr($text, 0, $length, 'utf8').'...';
    return $text;
}

function paginate($data){
    $data=$data->toArray();
    unset($data['per_page']);
    unset($data['from']);
    unset($data['to']);
    unset($data['prev_page_url']);

    foreach($data['data'] as $key=>$d){
        isset($d['created_at']) && $data['data'][$key]['created_at']=strtotime($d['created_at']);
    }

    return $data;
}

/**
 * 获取字符首字符的字母
 * @param $s0
 *
 * @return string
 */
function getFirstPinYinChar($s0){
    $s0=mb_substr($s0,0,5);
    $pinyin=new \App\Lib\PinYin();
    $char=strtoupper(substr($pinyin->str2py($s0),0,1));
    if (!preg_match ("/^[A-Za-z]/", $char)) {
        return "#";
    } else {
        return $char;
    }


    //之前的方法，对某些字处理不了
    $fchar = ord($s0{0});
    if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
    $s1 = iconv("UTF-8","gb2312", $s0);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $s0){$s = $s1;}else{$s = $s0;}
    $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
    if($asc >= -20319 and $asc <= -20284) return "A";
    if($asc >= -20283 and $asc <= -19776) return "B";
    if($asc >= -19775 and $asc <= -19219) return "C";
    if($asc >= -19218 and $asc <= -18711) return "D";
    if($asc >= -18710 and $asc <= -18527) return "E";
    if($asc >= -18526 and $asc <= -18240) return "F";
    if($asc >= -18239 and $asc <= -17923) return "G";
    if($asc >= -17922 and $asc <= -17418) return "I";
    if($asc >= -17417 and $asc <= -16475) return "J";
    if($asc >= -16474 and $asc <= -16213) return "K";
    if($asc >= -16212 and $asc <= -15641) return "L";
    if($asc >= -15640 and $asc <= -15166) return "M";
    if($asc >= -15165 and $asc <= -14923) return "N";
    if($asc >= -14922 and $asc <= -14915) return "O";
    if($asc >= -14914 and $asc <= -14631) return "P";
    if($asc >= -14630 and $asc <= -14150) return "Q";
    if($asc >= -14149 and $asc <= -14091) return "R";
    if($asc >= -14090 and $asc <= -13319) return "S";
    if($asc >= -13318 and $asc <= -12839) return "T";
    if($asc >= -12838 and $asc <= -12557) return "W";
    if($asc >= -12556 and $asc <= -11848) return "X";
    if($asc >= -11847 and $asc <= -11056) return "Y";
    if($asc >= -11055 and $asc <= -10247) return "Z";
    return "#";
}

