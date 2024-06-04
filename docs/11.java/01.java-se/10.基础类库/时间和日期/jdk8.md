

date，calender的弊端

可变对象


在java jdk8中引入了LocalDate，LocalTime，LocalDateTime新的日期时间对象

不可变对象


## LocalDate对象


静态方法
- now()
- now(clock)





常用方法
getYear,
getMonthValue,获取月份，返回值int类型，返回值范围1-12
getDayOfMonth,获去月份中的日期，返回值int类型，1-31
getDayOfWeek,获取星期几，返回值dayOfWeek类型，是一个枚举类型



对于国人来说，更期待getDayOfWeek方法可以返回一个int类型的值，可以getvalue方法

星期几，从1（星期一）到7（星期日） 


```java
//默认时区的系统时钟的当前时间
var now = LocalDate.now();
System.out.println(now);

var weekday = now.getDayOfWeek().getValue();
System.out.println("weekday:"+weekday);
```




修改值
withYear,withMonth,withDayOfMonth,withDayOfMonth

plusYears,把某个信息增加多少
minusYears,把某个信息减少多少


equals
isBefore
isAfter

of,从给定的年月日中获得localDate实例，






# zoneid，时区

时区，

utc

systemDefault(),获取系统默认时区


获取当前java环境所支持的时区
getAvailableZoneIds()
of,通过时区获取时区id实例对象

通过时区id来获取对应时区的时间




# zonedatetime，时区时间

datetimeFormatter,用于时间的格式化和解析

# instant，时间戳/时间线

通过instant对象可以拿到此刻的时间戳的毫秒数


instant类是jdk8中新增的时间戳类，相较于System.currentTimeMillis()获取到毫秒，Instant可以更为精确的获取到纳秒




总秒数+不够1秒的纳秒数

1秒=1000毫秒
1毫秒=1000纳秒


now，获取instant对象，


epoch，纪元
一个纪元是一个瞬间的时间，用来作为特定日历时代的起源。

时间戳是什么，以utc的1970年1月1日 00:00:00为起点，到某个时间点，所经过的总秒数。





https://blog.csdn.net/qq_31635851/article/details/120151149





在java中如何实现时间戳与日期时间的相互转化







period，日期间隔，
duration，时间间隔，


idea绿色波浪线是什么？
代码或者注释不满足驼峰命名法的时候会出现绿色波浪线，

如果对于强迫症不能容忍的，可以在

settings>editor>inspections>搜索typo，取消literals即可

https://blog.csdn.net/black_shooter/article/details/88318641
