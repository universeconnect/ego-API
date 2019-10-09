<?php
$username = $_POST['username'];
$email = $_POST['email'];
require_once '.././head.php';//设置请求头和定义返回体类
if(!($_POST['username'] && $_POST['password'] && $_POST['email'])){
    header("HTTP/1.1 802 Data received error");
    exit(1);
}
//验证数据是否合格
$verifyUsername = preg_match('/^[a-zA-Z0-9-_!@#$%^&*]{6,20}/',$_POST['username']);
$verifyPassword = preg_match('/^(?![a-zA-z]+$)(?!\d+$)(?![!@#$%^&*]+$)[a-zA-Z\d!@#$%^&*]+$/',$_POST['password']);
$verifyEmail = preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD',$_POST['email']);
if(!($verifyUsername && $verifyPassword && $verifyEmail)){
    header("HTTP/1.1 807 Data illegal");
    exit(1);
}
require_once '.././connectMySql.php';//初始化数据库链接
//检验用户名和邮件是否存在
$sql1 = "SELECT * FROM userinfo WHERE username = '{$_POST['username']}'";
$sql2 = "SELECT * FROM userinfo WHERE email = '{$_POST['email']}'";
$assoc1=mysqli_fetch_row(mysqli_query($link,$sql1));
$assoc2=mysqli_fetch_row(mysqli_query($link,$sql2));
if ($assoc1 && $assoc2){//用户名和密码都已经存在
    $data -> status_code = 1108;
    echo json_encode($data);
    exit(1);
}else if ($assoc1){//用户名已经存在
    $data -> status_code = 1106;
    echo json_encode($data);
    exit(1);
}else if ($assoc2){//邮件已经存在
    $data -> status_code = 1107;
    echo json_encode($data);
    exit(1);
}
$_POST['creation_time'] = date("Y-m-d H:i");//获取注册时间
if(mysqli_query($link,"INSERT INTO userinfo(ID,username,password,email,nickname,head_portrait,creation_time,access,access_code) VALUES (0,'{$_POST['username']}','{$_POST['password']}','{$_POST['email']}','','','{$_POST['creation_time']}',1,'')")){
    //注册成功，获取当前注册用户的信息返回给前台
    $sql = "SELECT ID,username,email,nickname,head_portrait,creation_time,access FROM userinfo WHERE username = '{$_POST['username']}'";
    $assoc=mysqli_fetch_object(mysqli_query($link,$sql));
    $data -> datas[0] = $assoc;
    $data -> status_code = 1109;
    echo json_encode($data);
}else{
    header("HTTP/1.1 805 Mysql statement execution error");
    exit(1);
}