<?php
/**
 * Created by PhpStorm.
 * User: jjp
 * Date: 2017/5/9
 * Time: 20:01
 * 获取数据库连接
 */

namespace GetUKID\DataBaseTool;


class GetPDOhandle
{
    private $arr = [];
    function __construct()
    {
        $this->arr = include ('DataConfig.php');
        $GLOBALS["database"] = $this->arr["DATABASENAME"];
    }

    public function getHandle()
    {
        try{
            $dsn="{$this->arr['TYPE']}:host={$this->arr['HOST']};dbname={$this->arr['DATABASENAME']}";
            $handle = new \PDO($dsn,$this->arr['USER'],$this->arr['PASSWORD'],[\PDO::ATTR_PERSISTENT => true]);
            $handle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $handle->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $handle->exec("set names 'utf8'");
            return [$handle,"Connect success"];
        } catch (\Exception $e) {
            return [null, "Unable to connect: " . $e->getMessage()];
        }
    }
}