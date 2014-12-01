<?php
/**
 * 更新APP seckey&key
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

if($app_obj->refresh($id))
	resp(1, "更新成功！");
else
	resp(0, "更新失败！");