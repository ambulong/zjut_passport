##精弘网络用户中心（zjut_passport）

###url

####前台（独立）
* `/login?url=http://xxx.zjut.com/xxx` 登录页面
* `/profile` 修改/查看资料页面
* `/api/profile?token=xxx&appid=xxx&key=xxx` APP获取个人信息页面 status:0(token失效)|1(成功)|-1(appid或key无效) data:(此部分信息用seckey加密)

####管理后台（独立，内网可见）
* `/index.php` 管理界面（纯静态, ajax）
* `/api.php?action=login` 登录
* `/api.php?action=chgpwd` 更改密码
* `/api.php?action=logout` 退出登录
* `/api.php?action=apps` 应用列表
* `/api.php?action=addapp` 添加应用
* `/api.php?action=updateapp` 更新应用信息

####lib
* `zjutauth/auth.php`
 * `zIsLogin()`
 * `zUsername()`
 * `zUID()`
* `zjutauth/class.zjutauth.php`
