
# awk

作用:格式化输出

命令使用：gawk options project file

options
-F,指定输入分隔符
-f，从文件中读取awk脚本
-v，定义awk程序中的一个变量及默认值
-nr，行数
-nf，字段数
-W，


1. 从命令行读取程序脚本
从命令行读取程序脚本，必须将脚本命令放在两个花括号内，

花括号外使用一对单引号将其包裹。

```bash
cat /etc/passwd|awk '{print "hello world"}'
```

要终止这个awk程序，必须表明数据流已经结束，bash shell提供了一个组合键来生成EOF字符，

> ctrl+d组合键会在bash中产生一个EOF字符，从而实现终止awk程序并返回到命令行界面提示符下。



$0,表示整行文本
$1,表示子一个字段
$2,表示第二个字段
...

向查看当前系统有那些用户?
```bash
[root@192 ~]# cat -n /etc/passwd|awk -F: '{print $1}'
     1  root
     2  bin
     3  daemon
```

默认的输入分隔符是空格,因此这里需要指定分隔符.



在程序脚本中使用多条命令,

默认的密码字段是x,如果希望将其修改为xx,怎么办呢?
```bash
[root@192 ~]# cat -n /etc/passwd|awk -F: '{$2="xx";print $0}'
     1  root xx 0 0 root /root /bin/bash
     2  bin xx 1 1 bin /bin /sbin/nologin
     3  daemon xx 2 2 daemon /sbin /sbin/nologin
```

发现密码字段已有原有的x变为了xx,但是字段分隔符好像也有原来的:变为了空格,如何实现



提前运行--begin

靠后运行--end










2. 从文件中读取程序脚本






常量
输入分隔符



输出控制
输出分隔符




内建变量
FS,
RS
OFS
ORS
FILEWIDTHS,有空格分割的一列数字



```bash
[root@192 ~]# cat -n /etc/passwd|awk '{FS=":";OFS=":"}{$2="xx";print $0}'
1:xx
     2  bin:xx:1:1:bin:/bin:/sbin/nologin
     3  daemon:xx:2:2:daemon:/sbin:/sbin/nologin
     4  adm:xx:3:4:adm:/var/adm:/sbin/nologin
```



