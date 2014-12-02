<?php
/**
 * 添加认证信息
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

$schoolid = isset ( $_POST ['schoolid'] ) ? trim($_POST ['schoolid']) : "";
$name = isset ( $_POST ['name'] ) ? trim($_POST ['name']) : "";
$idcard = isset ( $_POST ['idcard'] ) ? trim($_POST ['idcard']) : "";
$email = isset ( $_POST ['email'] ) ? trim($_POST ['email']) : "";

if($schoolid == "" || $name == "" || $idcard == "" || $email == ""){
	resp(0, "信息不完整！");
}

$realinfo_obj = new zRealInfo();

if($realinfo_obj->add($schoolid, $name, $idcard, $email)){
	resp(1, "添加成功！");
}else{
	resp(0, "添加失败！");
}