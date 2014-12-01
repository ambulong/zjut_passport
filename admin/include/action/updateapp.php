<?php
/**
 * 更新APP
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
$name = isset ( $_POST ['name'] ) ? trim($_POST ['name']) : "";
$trust = isset ( $_POST ['trust'] ) ? intval($_POST ['trust']) : -1;

if($name == "" || $trust == -1){
	resp(0, "信息不完整！");
}

if($trust != 0 && $trust != 1){
	resp(0, "信息错误！");
}

$app_obj = new zApp();

if(!$app_obj->isExistID($id))
	resp(0, "app不存在！");

if($app_obj->update($name, $trust, $id))
	resp(1, "更改成功！");
else
	resp(0, "更改失败！");