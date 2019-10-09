<?php
require_once '.././head.php';//设置请求头和定义返回体类
if( !(
    $_POST['description']
    &&$_POST['ID']
    &&$_POST['link']
    &&$_POST['icon']
    &&$_POST['classify']
    &&(!is_null($_POST['downloads']))
    &&$_POST['name']
    &&$_POST['access']
    &&$_POST['release_time']) ) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
if($_POST['release_time'] == "now"){
    $_POST['release_time'] = date("Y-m-d");
}
$sql = "UPDATE software SET description='{$_POST['description']}',link='{$_POST['link']}',icon='{$_POST['icon']}',classify='{$_POST['classify']}',downloads={$_POST['downloads']},name='{$_POST['name']}',release_time='{$_POST['release_time']}',access={$_POST['access']} WHERE ID={$_POST['ID']}";

if(!($rows=mysqli_query($link,$sql))){
    //echo mysqli_error($link);
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1007;
echo json_encode($data);
exit(1);

