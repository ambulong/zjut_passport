<?php
/**
 * 删除APP
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
$app_obj = new zApp();
if(!$app_obj->isExistID($id))
	resp(0, "app不存在！");
if($app_obj->del($id))
	resp(1, "删除成功！");
else 
	resp(0, "删除失败！");