##PHP类 用来连接用户中心

####lib
可以从用户中心获取到的信息尽量不要储存在本地
* `zjutauth/auth.php`
 * `appid(number), key(string), seckey(string), debug(boolean)` 配置信息
 * `zIsLogin()`
 * `zUsername()`
 * `zSID()` 就是SID，绑定帐号请用这个（防止清除用户功能后再次注册导致冲突）
 * `zEmail()`
 * `zDetail()`
* `zjutauth/class.zjutauth.php`
