
# localDateTime


get,获取指定的年月日时分秒字段
getYear
getMonthValue,获取月份，返回值为int，取值范围1-12
getDayOfYear,
getDayOfWeek,

atOffset,将此日期时间与偏移量结合创建offsetDateTime
of,
of(localdate,localtime)
ofEpochSeconds
ofInstant
parse(text,formate),从特定的格式化localtime从获取实例



日期时间比较
compareTo,将此日期时间与其他日期时间进行比较
equals,
isBefore
isAfter



DatetimeFormatter,格式化器，主要有两方面的作用：格式化和解析

## 格式化时间
```java
import java.time.Instant;
import java.time.LocalDateTime;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;

/*
* 学习目标，掌握jdk8新增的datetimeformatter，日期时间格式化对象
* */
public class demo01 {
    public static void main(String[] args) {
        //第一步，使用指定的模式创建格式化对象
        var formate = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");

        //第二步，创建日期时间对象
        var now = LocalDateTime.now();

        //第三步，对日期时间对象应用格式化对象。
        System.out.println(now);
        System.out.println(System.currentTimeMillis());
        System.out.println(Instant.now().getEpochSecond());
        System.out.println(now.toEpochSecond(ZoneId.systemDefault().getRules().getOffset(Instant.now())));
        System.out.println("one"+formate.format(now));
        System.out.println("two"+now.format(formate));
    }
}
```




## 解析时间，一般使用localDateTime提供的解析方法来解析

```java
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class demo02 {
    public static void main(String[] args) {
        var str="2023-12-31 07:51:55";

        var formate = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");
        var datetime = LocalDateTime.parse(str,formate);
        //2023-12-31T07:51:55.382759800
        System.out.println(datetime);
    }
}
```


# period，通过年月日相结合来描述一个时间量
duration，通过年月日时分秒相结合来描述一个时间量

用于计算两个时间的持续








