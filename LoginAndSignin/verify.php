<?php
require_once '.././head.php';//设置请求头和定义返回体类
if( !( $_GET["content"] && $_GET["header"] && $_GET["list"]) ){
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
//查找数据
$sql = "SELECT * FROM {$_GET["list"]} WHERE {$_GET["header"]} = \"{$_GET['content']}\"";
$assocs=mysqli_query($link,$sql);
if($assocs){
}else{
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$assoc = mysqli_fetch_row($assocs);
if($assoc){
    $data -> status_code = 1002;
    echo json_encode($data);
    exit(1);
}else{
    $data -> status_code = 1000;
    echo json_encode($data);
    exit(1);
}
