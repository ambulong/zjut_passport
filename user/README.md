##用户前台

###API

**不需登录**
* `/api.php?action=login` 登录 `user`, `password`, `captcha`
* `/api.php?action=captcha` 获取验证码
* `/api.php?action=forget[&step=1]` 发送找回密码邮件 `email`, `captcha`
* `/api.php?action=forget&step=2` 更改密码 `email`, `newpassword`, `confirmpassword`, `verify_token`
* `/api.php?action=delete[&step=1]` 获取删除token `schoolemail`, `verify_token`
* `/api.php?action=delete&step=2` 删除帐号 `schoolemail`, `verify_token`, `realname`, `schoolid`, `idcard`
* `/api.php?action=register[&step=1]` 注册帐号  `schoolemail`, `captcha`
* `/api.php?action=register&step=2` 获取注册token `schoolemail`, `verify_token`
* `/api.php?action=register&step=3` 注册 `verify_token`, `email`, `username`, `phone`, `password`, `confirmpassword`

**需要登录**
* `/api.php?action=profile` 获取资料 `token`
* `/api.php?action=chgpwd` 更改密码 `password`, `newpassword`, `confirmpassword`, `token`
* `/api.php?action=updateavatar` 更改头像 `avatar`, `token`
* `/api.php?action=updateemail` 更改邮箱 `email`, `token`
* `/api.php?action=updatepicture` 更改照片 `picture`, `token`
* `/api.php?action=updateprofile` 更改资料 `phone`, `bankcard`, `label`, `introduction`, `site`, `qq`, `weixin`, `token`
* `/api.php?action=identity[&step=1]` 发送实名认证邮件 `schoolemail`, `token`
* `/api.php?action=identity&step=2` 实名认证 `schoolemail`, `verify_token`, `token`

***

###需要的类
* zUser
 * -add
 * -del
 * -isExistID
 * -isExistSID
 * -isExistSchoolID
 * -isExistName
 * -isExistEmail
 * -isExistSchoolEmail
 * -getID
 * -getIDBySchoolEmail
 * -getDetail
 * -getMoreDetail
 * -getMail
 * -getPassword
 * -getAvatar
 * -getVerifyToken
 * -getVerifyTime
 * -updatePassword
 * -updateAvatar
 * -updatePicture
 * -updateProfile
 * -updateIdentity
 * -validateVerifyToken
 * -genVerifyToken
 * -delVerifyToken
 * -auth
 
* zUserTemp
 * -add
 * -isExistID
 * -isExistEmail
 * -getVerifyToken
 * -getVerifyTime
 * -genVerifyToken 生成token
 * -updateVerifyToken 更新token，需要校验token {"0", "xxx"}
 * -delVerifyToken
 * -validateVerifyToken
 
* zRealInfo
 * -isExistID
 * -isExistSchoolID
 * -isExistName
 * -isExistEmail
 * -validate
