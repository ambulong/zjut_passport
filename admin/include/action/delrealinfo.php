<?php
/**
 * 删除认证信息
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
$realinfo_obj = new zRealInfo();
if(!$realinfo_obj->isExistID($id))
	resp(0, "认证信息不存在！");
if($realinfo_obj->del($id))
	resp(1, "删除成功！");
else 
	resp(0, "删除失败！");