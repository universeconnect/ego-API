<?php
header("Access-Control-Allow-Origin:*");
header("content-type:text/json;charset=utf-8");
require_once '.././head.php';//设置请求头和定义返回体类
if(!(
    $_POST['title']
    &&$_POST['abstract']
    &&$_POST['link']
    &&$_POST['classify']
    &&$_POST['icon']
    &&$_POST['promulgator']) ) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
$_POST['release_time']=date("Y-m-d");
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "INSERT INTO video (ID,title,abstract,link,promulgator,release_time,classify,icon) VALUES (0,'{$_POST['title']}','{$_POST['abstract']}','{$_POST['link']}','{$_POST['promulgator']}','{$_POST['release_time']}','{$_POST['classify']}','{$_POST['icon']}')";
$rows=mysqli_query($link,$sql);
if(!$rows){
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1005;
echo json_encode($data);
exit(1);
