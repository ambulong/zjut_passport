<?php
/**
 * 用户是否登录
 * @return bool
 */
function z_is_login() {
	if (isset ( $_SESSION ["user"] )) {
		if ($_SESSION ["user"]["status"] == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	} else {
		return FALSE;
	}
}
/**
 * 获取当前用户用户名
 *
 * @return string
 */
function z_get_username() {
	return isset($_SESSION ["user"]["name"])?$_SESSION ["user"]["name"]:"";
}

/**
 * 用户登录
 * @return bool
 */
function z_login($username) {
	$_SESSION ["user"]["status"] = TRUE;
	$_SESSION ["user"]["name"] = "{$username}";
	$_SESSION ["user"]["token"] = get_salt(100);
}

/**
 * 登出
 */
function z_logout() {
	session_unset ();
	session_destroy ();
}