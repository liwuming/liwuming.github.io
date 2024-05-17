



# 命令别名



bash的操作环境


路径与指令的搜索顺序

1. 相对路径与绝对路径
2. 别名


1. 优先级最高的是包含相对路径或绝对路径
2. alias
> 如何跳过命令别名呢?,在命令前添加--`\`
3. 由bash内建的指令来执行
4. 透过$PATH环境变量顺序搜寻到的第一个指令来执行。



/etc/issue,/etc/motd


\d,显示本地端的日期，应该是date的缩写
\t,显示本地端的时间，应该是time的缩写
\S,操作系统的名称
\v,操作系统的版本

```bash
[root@localhost ~]# cat /etc/issue
\S
Kernel \r on an \m
```
除了/etc/issue文件外，还有一个类似的文件--/etc/issue.net，
这个是什么呢，供给telnet这个远程登录程序用的。
当我们使用


至于如果想要让使用者登录后取得一些讯息，那么可以将讯息加入/etc/motd里面去，如：
```bash
vi /etc/motd
hello world
:wq

```


-bash: warning: setlocale: LC_TIME: cannot change locale (en_US.utf8)

系统已经设置了默认地区_语言.字符集为en_US.UTF-8,但是在系统中没有定义对应的locale文件，

只需要手动生成这个locale文件即可,解决方法如下：
```bash

vim /etc/enviroment

localedef -i en_US -f UTF-8 en_US.UTF-8
```
参考文档
https://www.cnblogs.com/Don/p/17560564.html

## 数据流重导向


## 管道

什么是管道










# 第10章

命令的顺序
1. 相对路径与绝对路径
2. alias
3. 内建命令
4. PATH环境变量


/etc/issue,/etc/issue.net
-d

/etc/motd

