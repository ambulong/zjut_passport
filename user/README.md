##用户前台

###前台（独立）

***
####`/login?url=http://xxx.zjut.com/xxx` 登录页面
* 无参数页面
 * 显示静态登录页面
* 有参数页
 * 需要参数:`user`, `password`, `capthca`, `submit`
 
***
####`/profile` 修改/查看资料页面
* 无参数页面
 * 显示资料页面
* 有参数页
 * 需要参数:`id`, `token`, `password`, `newpassword`, `confirmpassword`, `phone`, `avatar`, `bankcard`, `label`, `introduction`, `site`, `qq`, `weixin`, `picture`, `submit`

***
####`/forget?step=x` 找回密码
* 无参数页面
 * 显示静态登录页面

***
####`/delete?step=x` 删除帐号

***
####`/register?step=x` 注册帐号

***
####`/captcha` 验证码

###API
**不需登录**
* `/api.php?action=login` 登录 `user`, `password`, `capthca`
* `/api.php?action=captcha` 获取验证码
* `/api.php?action=forget[&step=1]` 发送找回密码邮件 `email`, `capthca`
* `/api.php?action=forget&step=2` 更改密码 `email`, `newpassword`, `confirmpassword`, `verify_token`
* `/api.php?action=delete[&step=1]` 发送删除帐号邮件  `schoolemail`, `capthca`
* `/api.php?action=delete&step=2` 删除帐号 `schoolemail`, `verify_token`, `realname`, `schoolid`, `idcard`
* `/api.php?action=`
* `/api.php?action=`
* `/api.php?action=`
* `/api.php?action=`
* `/api.php?action=`
**需要登录**
* `/api.php?action=profile` 获取资料 `token`
* `/api.php?action=chgpwd` 更改密码 `password`, `newpassword`, `confirmpassword`, `token`
* `/api.php?action=updateavatar` 更改头像 `avatar`, `token`
* `/api.php?action=updatepicture` 更改照片 `picture`, `token`
* `/api.php?action=updateprofile` 更改资料 `phone`, `bankcard`, `label`, `introduction`, `site`, `qq`, `weixin`, `token`

