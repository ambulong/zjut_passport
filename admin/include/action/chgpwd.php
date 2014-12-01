<?php
/**
 * 更改登录密码
 */
if (! defined ( "Z_ENTRANCE" )) {
	header ( "HTTP/1.0 404 Not Found" );
	exit ();
}

if(!z_is_login()) {
	resp(0, "还未登录！");
}

if(!z_validate_token()) {
	resp(0, "Token is incorrect.");
}

$password = isset ( $_POST ['password'] ) ? trim($_POST ['password']) : "";
$newpassword = isset ( $_POST ['newpassword'] ) ? trim($_POST ['newpassword']) : "";
$confirmpassword = isset ( $_POST ['confirmpassword'] ) ? trim($_POST ['confirmpassword']) : "";
if($password == "" || $newpassword == "" || $confirmpassword == ""){
	resp(0, "信息不完整！");
}

if(strcmp($newpassword, $confirmpassword) != 0) {
	resp(0, "两次输入密码不同！");
}

if(strlen($newpassword) < 16) {
	resp(0, "密码不能小于16位！");
}

$admin_obj = new zAdmin();

if (! $admin_obj->auth ($_SESSION ["user"]["name"], $password)) {
	resp(0, "原密码错误！");
}

if ($admin_obj->update($_SESSION ["user"]["name"], $newpassword)) {
	resp(1, "更改密码成功！");
}else{
	resp(0, "更改密码失败！");
}
