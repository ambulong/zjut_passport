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

