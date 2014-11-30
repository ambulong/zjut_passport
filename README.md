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
* `/api.php?action=delapp` 添加应用
* `/api.php?action=updateapp` 更新应用信息

* `/api.php?action=users` 用户管理
* `/api.php?action=user` 用户详细信息
* `/api.php?action=realinfo` 实名认证信息列表
* `/api.php?action=addrealinfo` 删除实名认证信息
* `/api.php?action=delrealinfo` 删除实名认证信息
* `/api.php?action=updaterealinfo` 更新实名认证信息
* `/api.php?action=uploadrealinfo` 上传实名认证信息

####lib
* `zjutauth/auth.php`
 * `zIsLogin()`
 * `zUsername()`
 * `zSID()` 就是SID，绑定帐号请用这个（防止清除用户功能后再次注册导致冲突）
* `zjutauth/class.zjutauth.php`

###设计

####数据库
* users 用户基本信息
 * id 用户ID，不可改
 * sid 用户的字符串ID（给第三方程序，防止遍历），不可改
 * email 用户邮箱（用于找回密码还有登录）
 * password 用户密码
 * username 用户名
 * verify_token 找回密码用TOKEN
 * verify_time 生成TOKEN时间（判断TOKEN是否过期）
 * reginfo 注册时的主机信息
 * mgmt_info 最后一次登录时的主机信息
* users_detail 用户详细信息
 * id
 * uid
 * real 是否实名 0|1
 * verify_token 确认实名认证&删除用户 {"0(实名认证)|1(删除用户)","xxx"}
 * verify_time
 * phone 手机
 * avatar 头像
 * schoolid 学号/工号
 * schoolemail 之前输入的学校邮箱
 * realname 真实姓名
 * idcard 身份证号码
 * bankcard 银行卡号
 * label 个人标签
 * introduction 个人简介
 * site 网站
 * qq QQ号码
 * weixin 微信号码
 * picture 大头照片
* access_token
 * id
 * uid
 * token 当前token
 * time 生成时间
 * mgmt_time token最后请求时间（如果记住登录就是accesstoken永远不过期,除非用户点击退出）
 * info 主机信息
* users_temp 激活前用户
 * id
 * email
 * verify_token 激活TOKEN
 * time
* apps
 * id
 * name 应用名
 * key 等于应用的连接密码
 * seckey 用来加密传输时的用户数据
 * trust 0(只能获取sid, email, username, avatar, label, introduction)|1(可以获取是否实名，银行卡，身份证，大头照片，手机，真实姓名...) 
* admin
 * id
 * username
 * password
* realinfo（在下面信息内的人才可申请实名）
 * id
 * schoolid 必须(唯一)
 * name 必须
 * idcard 必须(唯一)
 * email 必须(唯一)
* users_logs 用户日志
 * id
 * uid 用户ID
 * data
 * time
* admin_logs
 * id
 * data
 * time
* apps_logs
 * id
 * data
 * time
* bin 存放删除用户信息
 * id
 * data
 * time

###迁移

####用户中心
将旧邮箱学号导入新用户中心，教师的email和schoolemail相同，学生的schoolemail为学号+@zjut.edu.cn

password为md5:salt

导入用户默认全未实名认证

####论坛
论坛独立出去，注册登录改密码于用户中心分离。把用户导向轻论坛

###新用户中心

####登录流程
* 判断邮箱/号/校邮箱
* 密码是否正确，错误终止
* 是否为旧密码，是则更新为phpass加密的密码

####注册流程
* 输入学校邮箱，是否已经存在于users_detail，是则终止
* 系统发送激活邮件（学校邮箱为用来确认身份信息的关键）
* 输入用户名和密码，个人信息，完成注册（如果邮箱存在realinfo里直接完成实名认证）

####实名认证流程（可多次实名认证，比如：现在这个不是我，重新用别的学号重新认证）
* 系统判断学号/工号是否存在于realinfo，有则发送到realinfo里的邮箱激活，否则提示联系管理员添加
* 系统从realinfo自动导入

####删除用户功能
* *用学校邮箱可以清空与学校邮箱关联的账户（放入回收站），这样就可以重新注册新用户中心帐号*
* 输入学校邮箱，是否已经存在于users_detail，否则终止
* 发送重置邮件
* 输入姓名+身份证
* 校验姓名和身份证
* 把关联账户放入回收站
