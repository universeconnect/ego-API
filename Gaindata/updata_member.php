<?php
require_once '.././head.php';//设置请求头和定义返回体类
if(!(
    $_POST['ID']
    &&$_POST['name']
    &&$_POST['imgs']
    &&$_POST['motto']
    &&$_POST['age']
    &&$_POST['intro']
    &&$_POST['interest']
    &&$_POST['adept']
    &&$_POST['address']
    &&$_POST['type']
    &&$_POST['good']) ) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "UPDATE member SET type='{$_POST['type']}',good={$_POST['good']},name='{$_POST['name']}',imgs='{$_POST['imgs']}',motto='{$_POST['motto']}',age={$_POST['age']},intro='{$_POST['intro']}',interest='{$_POST['interest']}',adept='{$_POST['adept']}' WHERE ID={$_POST['ID']}";
$rows=mysqli_query($link,$sql);
if(!$rows){
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1007;
echo json_encode($data);
exit(1);
