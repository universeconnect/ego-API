<?php
require_once '.././head.php';//设置请求头和定义返回体类
if(is_null($_GET['ID'])){
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "SELECT ID,username,email,nickname,head_portrait,creation_time,access FROM userinfo WHERE ID = '{$_GET['ID']}'";
$assoc=mysqli_fetch_object(mysqli_query($link,$sql));
$data -> datas[0] = $assoc;
$data -> status_code = 1007;
echo json_encode($data);