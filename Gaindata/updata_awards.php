<?php
require_once '.././head.php';//设置请求头和定义返回体类
if( !($_POST['awards']
    &&$_POST['prizewinner']
    &&$_POST['ID']
    &&$_POST['teacher']
    &&$_POST['data_of_award']
    &&$_POST['img'])) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "UPDATE awards SET teacher='{$_POST['teacher']}',awards='{$_POST['awards']}',prizewinner='{$_POST['prizewinner']}',data_of_award='{$_POST['data_of_award']}',img='{$_POST['img']}' WHERE ID={$_POST['ID']}";
$rows=mysqli_query($link,$sql);
if(!$rows){
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}
$data -> status_code = 1007;
echo json_encode($data);
exit(1);
