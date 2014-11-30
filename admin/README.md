##管理后台

####管理后台（独立，内网可见）
* `/index.php` 管理界面（纯静态, ajax）
* `/api.php?action=login` 登录
* `/api.php?action=chgpwd` 更改密码
* `/api.php?action=logout` 退出登录
* `/api.php?action=apps` 应用列表
* `/api.php?action=addapp` 添加应用
* `/api.php?action=delapp` 添加应用
* `/api.php?action=updateapp` 更新应用信息

* `/api.php?action=users` 用户管理
* `/api.php?action=user` 用户详细信息
* `/api.php?action=realinfo` 实名认证信息列表
* `/api.php?action=addrealinfo` 删除实名认证信息
* `/api.php?action=delrealinfo` 删除实名认证信息
* `/api.php?action=updaterealinfo` 更新实名认证信息
* `/api.php?action=uploadrealinfo` 上传实名认证信息

####需要的类
* zAdmin:
 * -add
 * -getUsername
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
* zUser
 * -add
 * -isExistID
 * -getDetail
* zRealInfo
 * -add
 * -del
 * -update
