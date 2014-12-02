<?php
/**
 * 获取认证信息列表
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

$offset = isset ( $_POST ['offset'] ) ? intval($_POST ['offset']) : 0;
$rows = isset ( $_POST ['rows'] ) ? intval($_POST ['rows']) : 0;

$realinfo_obj = new zRealInfoList();
$list = $realinfo_obj->getList($offset, $rows);
if(count($list) <= 0)
	resp(0, "还没有认证信息！");
else
	resp(1, "获取成功", $list);