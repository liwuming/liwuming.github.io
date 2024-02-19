


# mysql函数

lower,转化为小写
upper,转化为大写,

concat,拼接字符串或字段
length(),获取字符串长度

trim,去除左右空格


concat_group,



## 日期时间函数

now(),获取当前日期时间字符串

curret_date():仅获取日期部分
curret_time():仅获取时间部分





unixtime_timestamp(),获取当前时间戳
from_timestamp(),时间戳格式化为时间字符串



如何实现由时间戳转to_days?

- to_days,接收一个日期时间参数,返回一个天数
- from_timestamp,将时间戳转化为字符串
- unixtime_timestamp,获取当前系统时间戳



select to_days(from_unixtime(unix_timestamp()))





