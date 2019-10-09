<?php
require_once '.././head.php';//设置请求头和定义返回体类
if( is_null($_GET['list']
    &&$_GET['ID']) ) {
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
if ($_GET['list'] == "userinfo"){
    $data -> status_code = 1012;
    echo json_encode($data);
    exit(1);
}else{
    $sql = "DELETE FROM {$_GET['list']} WHERE ID={$_GET['ID']}";
    if ($delete=mysqli_query($link,$sql)){
        $data -> status_code = 1011;
        echo json_encode($data);
        exit(1);
    }else{
        header("HTTP/1.1 805 Mysql statement execution error");
        exit(1);
    }
}


