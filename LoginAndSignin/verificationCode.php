<?php
//1、设置跨域和响应头
header("Access-Control-Allow-Origin:*");
header("content-type:text/json;charset=utf-8");
//2、创建画布资源
$img = imagecreatetruecolor(80,40);
//3、分配颜色#00ffff
$color = imagecolorallocate($img,0,255,255);
//填充背景
imagefill($img,1,1,$color);
//创建随机验证码字符
$pattern = '23456789abdefghjkmnqrtyZBDEFJHJKMNQRTY';
//获取字体
$font = 'C:\Windows\Fonts\corbel.ttf';
//预定义返回的验证码
$key = '';
//添加干扰点
for($i=0;$i<50;$i++){
    //创建随机颜色
    $color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,100),mt_rand(0,100));
    //画干扰点
    imagesetpixel($img,mt_rand(0,80),mt_rand(0,40),$color);
}
//添加干扰线
for($i=0;$i<8;$i++){
    //创建随机颜色
    $color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
    //画干扰点
    imageline($img,mt_rand(0,80),mt_rand(0,40),mt_rand(0,80),mt_rand(0,40),$color);
}
//获取随机验证码
for($i=0,$x=3;$i<4;$i++,$x+=18){
    //得到随机验证码
    $value = $pattern{mt_rand(0,strlen($pattern)-1)};
    //echo $value;
    //将随机字符画到画布上
    //创建随机颜色
    $color = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,100),mt_rand(0,100));
    //写入验证码
    imagettftext($img,25,mt_rand(-15,15),$x-mt_rand(-5,5),mt_rand(28,31),$color,$font,$value);
    //拼接验证码
    $key .= $value;
}
//保存输出
imagepng($img,'C:\inetpub\wwwroot\LoginAndSignin\code.png');
//返回验证码用于验证
echo json_encode($key);
