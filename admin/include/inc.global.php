<?php
/**
 * 校验TOKEN
 *
 * @return boolean
 */
function  z_validate_token() {
	if (! isset ( $_REQUEST ['token'] )) {
		return FALSE;
	}
	$token = isset ( $_REQUEST ['token'] ) ? $_REQUEST ['token'] : "";
	if (md5 ( $_SESSION ["user"]["token"] ) == md5 ( $token )) {
		return TRUE;
	}
	return FALSE;
}
/**
 * 获取TOKEN
 *
 * @return string|unknown
 */
function z_get_token() {
	return isset($_SESSION ["user"]["token"])?$_SESSION ["user"]["token"]:"";
}