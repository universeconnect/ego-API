<?php
require_once '.././head.php';//设置请求头和定义返回体类
if(is_null($_POST['username'] && $_POST['password'])){
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
$sql = "SELECT* FROM userinfo WHERE username='{$_POST['username']}'";
$assocs=mysqli_query($link,$sql);//按用户名查询
$assoc = mysqli_fetch_object($assocs);
$userObjInfo = $assoc;
if(!$userObjInfo){//错误
    //按邮件查询
    $sql = "SELECT * FROM userinfo WHERE email='{$_POST['username']}'";
    $assocs=mysqli_query($link,$sql);
    $assoc = mysqli_fetch_object($assocs);
    $userObjInfo = $assoc;
    if(!$userObjInfo){
        //返回用户名错误
        $data -> status_code = 1105;
        echo json_encode($data);
        exit(1);
    }
}
if($assoc -> password == $_POST['password']){//密码正确
    $data -> status_code = 1104;
    $sql = "SELECT ID,username,email,nickname,head_portrait,creation_time,access FROM userinfo WHERE username = '{$_POST['username']}'";
    $assocs=mysqli_query($link,$sql);
    $assoc = mysqli_fetch_object($assocs);
    $data -> datas[0] = $assoc;
    echo json_encode($data);
    exit(1);
}else{
    $data -> status_code = 1103;//密码错误
    echo json_encode($data);
    exit(1);
}



