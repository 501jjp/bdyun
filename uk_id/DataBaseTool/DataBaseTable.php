<?php
/**
 * Created by PhpStorm.
 * User: jjp
 * Date: 2017/5/9
 * Time: 21:08
 */

namespace GetUKID\DataBaseTool;


interface DataBaseTable
{
    public function add($arr);
    public function delate($arr);
    public function update($arr);
    public function find($arr);

    public function where($arr);
    public function limit($arr);
    public function order($arr);
}