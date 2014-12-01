<?php
/**
 * 登录
 */
if (! defined ( "Z_ENTRANCE" )) {
	header ( "HTTP/1.0 404 Not Found" );
	exit ();
}
$username = isset ( $_POST ['username'] ) ? trim($_POST ['username']) : "";
$password = isset ( $_POST ['password'] ) ? trim($_POST ['password']) : "";
if($username == "" || $password == ""){
	resp(0, "帐号或者密码不准为空！");
	exit;
}

$admin_obj = new zAdmin();
if (! $admin_obj->auth ($username, $password)) {
	resp(0, "帐号或者密码错误！");
}else{
	z_login($username);
	resp(1, "登录成功！", array("token"=>$_SESSION ["user"]["token"]));
}
