<?php
$link = NULL;
$link=mysqli_connect('localhost:3306','root','000000');
if($link == NULL){
    header("HTTP/1.1 803 Database connection failed");
    exit(1);
}
$set=mysqli_set_charset($link,'utf8');
if ($query=mysqli_query($link,'USE universe')){
}else{
    header("HTTP/1.1 804 Failed to connect to database");
    exit(1);
}
