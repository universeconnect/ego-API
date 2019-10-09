<?php
require_once '.././head.php';//设置请求头和定义返回体类
if(!(
    $_POST['title']
    &&$_POST['ID']
    &&$_POST['abstract']
    &&$_POST['link']
    &&$_POST['icon']
    &&$_POST['promulgator']
    &&$_POST['release_time']
    &&(!is_null($_POST['reading_quantity']))
    &&$_POST['classify']
    &&$_POST['access']) ) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
if($_POST['release_time'] == "now"){
    $_POST['release_time'] = date("Y-m-d");
}
$sql = "UPDATE video SET icon='{$_POST['icon']}',title='{$_POST['title']}',abstract='{$_POST['abstract']}',link='{$_POST['link']}',promulgator='{$_POST['promulgator']}',release_time='{$_POST['release_time']}',reading_quantity={$_POST['reading_quantity']},classify='{$_POST['classify']}',access={$_POST['access']} WHERE ID={$_POST['ID']}";
$rows=mysqli_query($link,$sql);
if(!$rows){
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1007;
echo json_encode($data);
exit(1);
