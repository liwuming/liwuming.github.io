## shell概述


linux系统安全的核心是用户账户

uid,



## /etc/passwd文件,

```bash
[liwuming@192 ~]$ ll /etc/passwd
-rw-r--r-- 1 root root 1063 Feb 18 22:29 /etc/passwd
```

```bash
[liwuming@192 ~]$ cat /etc/passwd
root:x:0:0:root:/root:/bin/bash
bin:x:1:1:bin:/bin:/sbin/nologin
daemon:x:2:2:daemon:/sbin:/sbin/nologin
adm:x:3:4:adm:/var/adm:/sbin/nologin
lp:x:4:7:lp:/var/spool/lpd:/sbin/nologin
```




七个字段,使用冒号进行分割,



第一个字段是用户名,
第二个字段是密码,但所有用户的密码都是x,
> 由于密码是敏感数据,所以将密码数据专门保存在/etc/shadow文件中.并且只有超级管理员可读

```bash
[liwuming@192 ~]$ ll /etc/shadow
---------- 1 root root 811 Feb 18 22:29 /etc/shadow
```


第三个字段是uid
0,是超级管理员
1000以下是系统账户,一般而言,系统账户是,而不用于登录,所以其shell类型一般为/sbin/nologin


第4个字段是gid,主组id
第5个字段,备注字段,用户描述账户信息
第6个字段,是家目录
第7个字段,login成功时,所执行的shell

如果可登录用户指定其指定的shell路径,



## /etc/shadow文件,

每条记录都有9个字段,
1. 登录名,
2. 密码
3. 
4. 多少天后才能修改密码
5. 多少天后必须修改密码
6. 密码过期前多少天提醒用户更改密码 
7. 密码过期后多少天禁用用户账户
8. 用户被禁止日期
9. 预留字段


## 账户管理

1. useradd--添加账户



useradd命令使用非常简单,甚至可以零配置--后面直接跟账户名,

useradd,


-D,查看默认选项
GROUP=100
HOME=/home
INACTIVE=-1
EXPIRE=
SHELL=/bin/bash
SKEL=/etc/skel
CREATE_MAIL_SPOOL=yes


-g,设置gid
-G,附加组
-M,不创建家目录
-r,创建系统账户
-s,执行shell类型

-----


修改默认配置
```bash
-D -s /bin/tsch

SHELL=/bin/bash
```














2. usermod--修改账户









3. userdel--删除账户

如果需要从系统中删除用户,userdel可以满足需求.

默认情况下,userdel命令会只删除/etc/passwd文件中的用户信息,而不会删除系统中属于该账户的任何文件.

-r,删除用户的家目录,以及邮件目录



4. 








## 改变安全性设置

1. 改变权限
2. 改变所属关系




## 共享文件

linux为每个文件和目录存储了3个额外的信息位,
1. 设置用户id,suid,当文件被用户使用时,程序会以文件属主权限运行.
2. 设置组id,sgid,对文件来说,程序会以文件属组的权限运行,对目录来说,目录中创建的新文件会以目录的默认属组作为默认属组.
3. 粘着位,进程结束后,文件还驻留在内存中.

权限设定
chmod o+t dir,

```bash
drwxrwxrwt.   8 root root  168 May 27 23:05 tmp
```





sgid可通过chmod目录设置,




安全上下文

文件是由属主和属组的,
进程是由属主和属组的,进程的属主是文件发起者.

1)是否可以运行,取决于发起者对文件是否拥有执行权限.
2)如果可以启动为进程,该进程的属主,为该进程的发起者.



suid打破了安全上下文的规则
在文件存在suid权限.
1. 
2. 启动为进程之后,其进程的属主为文件的属主




sgid,




粘着位,



/etc/fstab文件












