



# 三剑客
man7.org



清屏命令

## grep

作用说明，内容过滤

工作原理，
逐行匹配

使用格式
grep [options] patterns... [file...]
grep [options] -e patterns... [file...]
grep [options] -f pattern_file... [file...]


常用参数
-G,base基础正则表达式
-E,extension，扩展正则表达式
-F，
-P,perl-grep,使用perl风格正则表达式


匹配选项\[match options\]
-i，忽略大小写
-q，静默模式
-v，invert-match,反向匹配,
-c，统计次数
-f,指定模式文件

-A，after-conten=行数，
-B,before-content=,显式行数


-v，revert-match，反向匹配，

输出控制选项\[output control\]

-c,--count,统计匹配次数
-o，--only-matching,仅显式匹配partner的部分

-n，显式行号
-e，多模式匹配



-B,before-content=nums
-A,after-conten=nums,

--color=auto,为grep过滤结果添加颜色
> linux发行版都默认加了这个选项

```bash
[root@192 ~]# alias|grep grep
alias egrep='egrep --color=auto'
alias fgrep='fgrep --color=auto'
alias grep='grep --color=auto'
```



```bash
[root@192 ~]# grep -n /bin/bash /etc/passwd
1:root:x:0:0:root:/root:/bin/bash
19:liwuming:x:1000:1000:liwuming:/home/liwuming:/bin/bash
20:zhangsan:x:1001:1001::/home/zhangsan:/bin/bash
```

> egrep,fgrep命令语法已被弃用，应使用grep -E,grep -F



默认行为，
默认以严格匹配大小写的方式进行匹配，








注意事项，
注意grep与通配符的区别
1. 通配符是bash内置功能，正则表达式需要借助指令，通常是三剑客--grep,sed,awk
2. 两者的作用不一致，
3. 所支持的原子符不一致，以及原子符的含义也有所差异

通配符所支持的原子符

- `?`，单个字符

> `?`不能匹配空字符，必须有内容

- `[...]`,指定范围内的任意单个字符

> `[^...]`,除指定范围意外的任意单个字符

- `*`,任意数量的任意字符

- {...}模式

- {start...end}模式






## sed

## awk

