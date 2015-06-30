<?php
//Facebook Application Configuration.
$facebook_appid='471711949651534';
$facebook_app_secret='6aa9b8ca0fe9fc47029f0be9a1d67da3';
$facebook_scope='email,user_birthday,user_about_me'; // Don't modify this

$facebook = new Facebook(array(
'appId'  => $facebook_appid,
'secret' => $facebook_app_secret,
));
?>