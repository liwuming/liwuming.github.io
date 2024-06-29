---
sidebar_position: 2
---


session，

session的生存周期，

配置session的存储路径
1. 在php.ini中设置，需要用户对有读写权限
2. 在脚本中设置，灵活度高，
```php
session_save_path( ROOT_PATH . '/runtime/session' );
session_start();
```


session_id,


清除session信息

session_destory,清除内存中的session信息
session_destory,清除内存中的session信息