



useradd,
usermod,
userdel,删除用户






## 文件



文件属性

## 文件类型



## 权限管理

chown,属主,属主组


chmod,设置权限



umask




# lsattr


# chattr
change file attributes on a Linux file system




文件和目录的权限

r-x,

r,4,
w,2,
r,1,
655,



文件预设权限,umask

查看或设置当前的umask信息


> umask是一个bash的内建命令

查看,有两种方式,
一种是直接输入umask回车,无任何参数,结果以数字形态的权限设定分数,
另外一种是通过-S选项,Symbolic,就会以符号的类型的方式来显示权限.

```bash
[root@192 ~]# umask
0022
[root@192 ~]# !! -S
umask -S
u=rwx,g=rx,o=rx
```

疑惑,权限rwx三位不就可以了,为啥umask有4位呢.
第一组是特殊权限用的.



在默认的权限属性上,目录和文件是不一样的.
至到x权限对于目录是非常重要的,

文件的默认权限666,目录默认权限777,减去umask的值,就是最终的文件/目录的权限值.




755,
rwx,r-x



## 文件隐藏属性
