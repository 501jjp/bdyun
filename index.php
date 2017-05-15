<?php
require 'vendor/autoload.php';
use GetUKID\GetJson\App;
use GetUKID\GetJson\GetContent;
use GetUKID\GetJson\GetJsonUrl;
use GetUKID\DataBaseTool\Test;
use GetUKID\DataBaseTool\BaiDu_User;
//优雅报错
try {
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
} catch (Exception $e) {
    echo $e->getMessage();
}



//$url = new GetJsonUrl();
//$u = $url->getUrl('1112219283','follow','24','24');
//
//$a = new GetContent();
//$content = $a->get($u);

$RUrl = new GetJsonUrl();
$Ru = $RUrl->getUrl('741843076','follow','24','24');

$a = new GetContent();
$content = $a->get($Ru);
//echo $content;
/*$arr = json_decode($content,true);
var_dump($arr);
$user = $arr['follow_list'][0];
$user['get_time'] =  time();
$user['search_time'] =  time();
$t = new Test();
$t->insert($user);*/
$arr = json_decode($content,true);
//var_dump($arr);
$test = new BaiDu_User();
/*for ($i = 1;$i<11;$i++){
    $test->add(add($i,$arr));
}*/



//$test->where([['=','uk','2181213293']])->delate([]);
/*$b = $test->limit([0,3])->find(['uk','follow_count']);
var_dump($b);*/

$test->where([['=','fans_count',7000]])->update([['fans_count','5000']]);


function add($num,$arr)
{
    $arr = $arr['follow_list'][$num];
    $a1 = [];
    $a1['uk'] = $arr['follow_uk'].'';
    $a1['follow_count'] = $arr['follow_count'].'';
    $a1['fans_count'] = $arr['fans_count'].'';
    $a1['get_time'] = time().'';
    $a1['search_time'] = time().'';
    return $a1;
}
