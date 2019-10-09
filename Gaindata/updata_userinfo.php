<?php
require_once '.././head.php';//设置请求头和定义返回体类
if( !(
    $_POST['ID']
	&&$_POST['password']
	&&$_POST['email']
	&&$_POST['nickname']
	&&$_POST['access']
	&&$_POST['head_portrait'])) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "UPDATE userinfo SET access={$_POST['access']},password='{$_POST['password']}',email='{$_POST['email']}',nickname='{$_POST['nickname']}',head_portrait='{$_POST['head_portrait']}' WHERE ID={$_POST['ID']}";
$rows=mysqli_query($link,$sql);
if(!$rows){
    //echo mysqli_error($link);
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1007;
echo json_encode($data);
exit(1);
