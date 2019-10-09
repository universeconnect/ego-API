<?php
header("Access-Control-Allow-Origin:*");//允许跨域
header("content-type:text/json;charset=utf-8");//字符集
class data{//定义返回体类
    public $status_code = 1001;
    public $datas = [];
}
$data = new data();//创建返回对象
//对get和post提交的数据josn化
foreach ($_POST as $key => $value){
    $_POST["$key"] = addslashes($value);
}
foreach ($_GET as $key => $value){
    $_GET["$key"] = addslashes($value);
}
