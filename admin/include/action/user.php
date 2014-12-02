<?php
/**
 * 获取用户详细信息
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

$user_obj = new zUser();
if(!$user_obj->isExistID($id))
	resp(0, "用户不存在！");
$data = array(
		"detail"	=> $user_obj->getDetail($id),
		"more"	=> $user_obj->getMoreDetail($id)
);
resp(1, "获取成功", $data);