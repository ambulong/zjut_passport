<?php
/**
 * 更新认证信息
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

$id = isset ( $_POST ['id'] ) ? intval($_POST ['id']) : 0;
$schoolid = isset ( $_POST ['schoolid'] ) ? trim($_POST ['schoolid']) : "";
$name = isset ( $_POST ['name'] ) ? trim($_POST ['name']) : "";
$idcard = isset ( $_POST ['idcard'] ) ? trim($_POST ['idcard']) : "";
$email = isset ( $_POST ['email'] ) ? trim($_POST ['email']) : "";

if($schoolid == "" || $name == "" || $idcard == "" || $email == ""){
	resp(0, "信息不完整！");
}

$realinfo_obj = new zRealInfo();

if(!$realinfo_obj->isExistID($id))
	resp(0, "认证信息不存在！");

if($realinfo_obj->update($id, $schoolid, $name, $idcard, $email)){
	resp(1, "更新成功！");
}else{
	resp(0, "更新失败！");
}