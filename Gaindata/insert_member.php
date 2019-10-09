<?php
require_once '.././head.php';//设置请求头和定义返回体类
if(!(
    $_POST['name']
    &&$_POST['imgs']
    &&$_POST['motto']
    &&$_POST['age']
    &&$_POST['intro']
    &&$_POST['interest']
    &&$_POST['type']
    &&$_POST['good']
    &&$_POST['address']
    &&$_POST['adept']) ) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
$_POST['time'] = date("Y-m-d");
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "INSERT INTO member (ID,name,imgs,motto,age,intro,interest,good,adept,address,type,time) VALUES (0,'{$_POST['name']}','{$_POST['imgs']}','{$_POST['motto']}',{$_POST['age']},'{$_POST['intro']}','{$_POST['interest']}',{$_POST['good']},'{$_POST['adept']}','{$_POST['address']}','{$_POST['type']}','{$_POST['time'] }')";
if(!($rows=mysqli_query($link,$sql))){
    //echo mysqli_error($link);
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1005;
echo json_encode($data);
exit(1);
