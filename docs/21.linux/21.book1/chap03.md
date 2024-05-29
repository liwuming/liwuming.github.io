

一切皆文件


## 查看文件内容

### 1. 查看文件类型

file命令

使用说明，
file [options] ...file

```bash
[root@localhost ~]# file passwd 1.sh
passwd: ASCII text
1.sh:   ASCII text
```

file命令不仅可以探测文件内容的类型还可以查看编码信息。

-e，--exclude testname,

### 2. 查看整个文件

1. cat命令

cat命令一次性显示文件所有内容，

-n，显示行号
-b，只给有文本的行加上行号，
-T，


more命令

less命令



head命令

tail命令








cat,一次性直接输出，如果当文件过大时，并不适用。

如果仅想查看前几行，head,
如果仅想查看后几行，tail,



## 文件内容过滤，

grep

-i，忽略大小写
-o,
-q,静默模式
-v,反向

-E，扩展模式
-E，扩展模式
-f，文件

