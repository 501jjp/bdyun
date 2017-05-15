<?php
/**
 * Created by PhpStorm.
 * User: jjp
 * Date: 2017/5/10
 * Time: 15:57
 */

namespace GetUKID\DataBaseTool;


class DataBaseIm implements DataBaseTable
{
    private $className = "";
    private $features = [];
    private $handle = null;
    private $wheres = "";
    private $wherev = [];
    private $limits = "";
    private $limitv = [];
    private $orders = "";
    private $orderv = [];
    public function __construct()
    {
        $cl = explode("\\",strtolower(get_class($this)));
        $this->className = end($cl);
        $hObject = new GetPDOhandle();
        $this->handle = $hObject->getHandle()[0];
        $sql = "select COLUMN_NAME from information_schema.COLUMNS where table_name = ? and table_schema = ?";
        $res = $this->pdoExecute($sql,[$this->className,$GLOBALS["database"]]);
        $ar = [];
        $i = 0;
        foreach ($res as $key=>$value){
            $ar[$i] = $value['COLUMN_NAME'];
            $i++;
        }
        $this->features = $ar;
    }

    public function add($arr)
    {
        // TODO: Implement add() metho
        if(count($arr)<=0){
            throw new Exception("array is null");
        }
        $fornt = implode(",",$this->features);
        //var_dump($fornt);
        $backA = [];
        $arrs = [];
        for ($i = 0;$i<count($this->features);$i++){
            $backA[$i] = "?";
            $arrs[$i] = $arr[($this->features)[$i]];
        }
        $back = implode(",",$backA);
        $sql = "INSERT INTO $this->className (".$fornt.")VALUES(".$back.")";
        return $res = $this->pdoExecute($sql,$arrs);
    }

    public function delate($arr)
    {
        //$arr示例[]
        // TODO: Implement delate() method.

        $follow = $this->wheodlim();
        $sql = "delete from ".$this->className.$follow[0];
        $arr = array_merge($arr,$follow[1]);
        $end = $this->pdoExecute($sql,$arr);
        $this->recovery();
        return $end;
    }

    public function find($COLUMN_Arr)
    {
        //$COLUMN_Arr示例['*']或['uk','follow_count']
        // TODO: Implement find() method.
        if(count($COLUMN_Arr)<=0){
            throw new Exception("array is null");
        }
        $COLUMN_Arr_str = implode(",",$COLUMN_Arr);
        $follow = $this->wheodlim();
        $sql = "select $COLUMN_Arr_str from ".$this->className.$follow[0];

        $end = $this->pdoExecute($sql,$follow[1]);
        $this->recovery();
        return $end;
    }



    public function update($arr)
    {
        //$arr示例[['uk','1'],['id','2']]
        // TODO: Implement update() method.
        $i = 0;
        $fornt = [];
        $back = [];
        foreach ($arr as $key=>$value){
            $fornt[$i] = $value[0]."=?";
            $back[$i] = $value[1];
            $i++;
        }
        $follow = $this->wheodlim();
        $fornt = implode(",",$fornt);
        $sql = "update $this->className set ".$fornt.$follow[0];
        $arrs = array_merge($back,$follow[1]);
        $end = $this->pdoExecute($sql,$arrs);
        $this->recovery();
        return $end;
    }

    public function order($arr)
    {
        //$arr范例['id','desc']
        // TODO: Implement order() method.
        var_dump($arr);
        $this->orders = " order by CAST($arr[0] AS DECIMAL) $arr[1]";
        //$this->orderv = $arr;
        return $this;
    }

    public function limit($arr)
    {
        //$arr示例[0,3]
        // TODO: Implement limit() method.

        $this->limits = " limit $arr[0],$arr[1]";
        //$this->limitv = $arr;
        return $this;
    }

    public function where($arr)
    {
        //示例$arr [['>','id','1'],['=','name','jjp']]
        // TODO: Implement where() method.
        $key1 = [];
        $v = [];
        //var_dump($arr);
        foreach ($arr as $key=>$value){
            $key1[$key] = "CAST(".$value[1]." AS DECIMAL)".$value[0]."?";
            $v[$key] = $value[2]; //想要拼接字符串
        }
        $key2 = implode(" and ",$key1);
        //var_dump($key2);
        $this->wheres = " where ".$key2;
        //var_dump($v);
        $this->wherev = $v;
        return $this;
    }

    //处理数据库的执行
    private function pdoExecute($sql,$arr)
    {
        try{
            var_dump($sql);
            $prepare = $this->handle->prepare($sql);
            $prepare->execute($arr);
            //$this->handle->commit();
            return $prepare->fetchALl(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            echo $e->getMessage();
            //$this->handle->rollBack();
        }
    }
    private  function wheodlim()
    {
        $where = "";
        $order = "";
        $limit = "";
        if($this->wheres!=""){
            $where = $this->wheres;
        }

        if($this->orders!=""){
            $order = $this->orders;
        }

        if($this->limits!=""){
            $limit = $this->limits;
        }
        $arr = array_merge($this->wherev,$this->orderv,$this->limitv);
        return [$where.$order.$limit,$arr];
    }
    private  function recovery()
    {
        $this->wheres = "";
        $this->wherev = [];
        $this->orders = "";
        $this->orderv = [];
        $this->limits = "";
        $this->limitv = [];
    }
}