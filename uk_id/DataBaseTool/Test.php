<?php
/**
 * Created by PhpStorm.
 * User: jjp
 * Date: 2017/5/9
 * Time: 20:30
 */

namespace GetUKID\DataBaseTool;


class Test
{
    public function insert($values){
        $GetPdo = new GetPDOhandle();
        $arr = $GetPdo->getHandle();
        if($arr[0]!=null){
            $handle = $arr[0];
        }else{
            print_r($arr[1]);
        }

        try{
            $handle->beginTransaction();
            $handle->exec("insert into baidu_user (uk, follow_count, fans_count,get_time,search_time) values ({$values['follow_uk']}, {$values['follow_count']}, {$values['fans_count']},{$values['get_time']},{$values['search_time']})");
            $handle->commit();
        } catch (\Exception $e){
            $handle->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}