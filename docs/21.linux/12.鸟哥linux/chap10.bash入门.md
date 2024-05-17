## shell概述





shell的种类



如何查看本机所支持的shell种类

```bash
[root@localhost ~]# cat /etc/shells
/bin/sh
/bin/bash
/usr/bin/sh
/usr/bin/bash
```



## bash何以成为默认的shell

### 路径/命令的自动补全

> 路径的自动补全是需要可读权限的.



命令别名

命令历史

命令hash

命令替换

快捷键

ctrl+c,取消

ctrl+d,

ctrl+z,放入后台运行

ctrl+u,

ctrl+k,







## 别名与历史

命令历史

在用户的家目录中有存在一个bash_history文件,其内容是当前用户之前所执行的历史命令,对于当前所执行的命令,默认记录在内存中,当用户退出时,会将其刷新到bash_history文件中.

-n,显示最近的n条命令历史

-w,将内存中的历史命令写入文件中



快捷键查看历史

histsize,设置命令历史的大小.



















