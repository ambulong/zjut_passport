##管理后台

####管理后台（独立，内网可见）
* `/index.php` 管理界面（纯静态, ajax）
* `/api.php?action=login` 登录 `username, password`
* `/api.php?action=chgpwd` 更改密码 `password, confirmpassword, newpassword, token`
* `/api.php?action=logout` 退出登录 `token`
* `/api.php?action=apps` 应用列表 `offset, rows, token`
* `/api.php?action=addapp` 添加应用 `name, trust`
* `/api.php?action=delapp` 删除应用 `id, token`
* `/api.php?action=updateapp` 更新应用信息 `id, name, strust, token`
* `/api.php?action=refreshapp` 更新应用key,seckey `id, token`

* `/api.php?action=users` 用户管理 `offset, rows, token`
* `/api.php?action=user` 用户详细信息 `id, token`
* `/api.php?action=realinfo` 实名认证信息列表 `offset, rows, token`
* `/api.php?action=addrealinfo` 添加实名认证信息 `schoolid, name, idcard, idcard, email, token`
* `/api.php?action=delrealinfo` 删除实名认证信息 `id, token`
* `/api.php?action=updaterealinfo` 更新实名认证信息 `id, schoolid, name, idcard, idcard, email, token`
* `/api.php?action=uploadrealinfo` 上传实名认证信息

####需要的类
* zAdmin:
 * -getPassword
 * -auth
 * -update
* zApp
 * -add
 * -getDetail
 * -isExistID
 * -del
 * -update
 * -updateTrust
* zAppList
 * -getList
* zUser
 * -isExistID
 * -getDetail
 * -getMoreDetail
* zUserList
 * -getList
* zRealInfo
 * -add
 * -del
 * -update
* zRealInfoList
 * -getList
