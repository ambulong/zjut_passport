<?php
if (! defined ( "Z_ENTRANCE" )) {
	header ( "HTTP/1.0 404 Not Found" );
	exit ();
}
if(!z_is_login()) {
	resp(0, "还未登录！");
}
if(z_validate_token()) {
	z_logout();
	resp(1, "退出成功！");
}else {
	resp(0, "Token is incorrect.");
}