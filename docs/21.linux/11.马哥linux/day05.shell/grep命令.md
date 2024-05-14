

# grep命令



grep

global search Regular express and print out the line.

作用
对文本进行搜索.
模式,

使用说明,
grep options parttern [file...]
grep options [-e parttern|-f file][file]


注意centos6与centos7系统中grep的差异,在centos6中没有定义grep别名,所以没有高亮.

options,


在centos7系统中因为系统定义了别名grep=grep --color=auto
以行为单位进行匹配,



--color=auto,高亮显示符合模式的字段



matcher selection
-b,默认选项,表示基础正则表达式
-E,--extended-regexp,扩展正则表达式
-G,--base-regexp,
-P,perl-regexp,perl-regexp风格正则表达式

matcher control,
-e,
-f, file,
-i,忽略大小写匹配
-v,invert-match,反向匹配
-w,word-regexp

output control
- c,--count
- -o,--only-match,仅输出匹配的记录
- -q,静默显示,不显示匹配结果,通过$?




- -n,line-number


$?,获取上一个命令的退出码




-A #,after,上下文前n行
-B #,before,上下文后n行
-C #,content,上下文前后各n行



before,after






pcre,
rege






英语学习
1. obtain,尤指经过努力,获得,赢得
2. invert,vt,使前后倒置,使反转
3. manage,管理,经营,安排时间,金钱等,设法做到,
i managed to obtain a copy of 

4. distinctions,区别,差异,不同,优秀,卓越
5. 









30,

一个月,就可以记下1000个单词
