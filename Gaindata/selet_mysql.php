<?php
require_once '.././head.php';//设置请求头和定义返回体类
if( !( $_GET["list"] ) ){
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "SELECT * FROM {$_GET["list"]} order by ID";
$rows=mysqli_query($link,$sql);
if(!$rows){
    //echo mysqli_error();
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
for ($i=0;$row = mysqli_fetch_object($rows);$i++){
    $data -> datas[$i] = $row;
}
$data -> status_code = 1009;
echo json_encode($data);
exit(1);

