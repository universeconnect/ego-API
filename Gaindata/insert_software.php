<?php
require_once '.././head.php';//设置请求头和定义返回体类
if(!(
    $_POST['description']
    &&$_POST['link']
    &&$_POST['icon']
    &&$_POST['classify']
    &&$_POST['name']) ) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
$_POST['release_time']=date("Y-m-d");
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "INSERT INTO software (ID,description,classify,link,icon,name,release_time) VALUES (0,'{$_POST['description']}','{$_POST['classify']}','{$_POST['link']}','{$_POST['icon']}','{$_POST['name']}','{$_POST['release_time']}')";

if(!($rows=mysqli_query($link,$sql))){
    //echo mysqli_error($link);
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1005;
echo json_encode($data);
exit(1);
