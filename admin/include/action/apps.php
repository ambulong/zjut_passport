<?php
/**
 * 获取APP列表
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

$applist_obj = new zAppList();
$list = $applist_obj->getList();
if(count($list) <= 0)
	resp(0, "还没有APP");
else 
	resp(1, "获取成功", $list);