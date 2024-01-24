

java中产生随机数的方法有三种
- Math.random

左开，右闭区间，


- Random类
```java
random r = new random();
int index=r.nextInt(data.length());


```



# 关于字符串

字符串的拼接

1. +=
2. append




为什么不建议在for循环中使用+=的方式来进行字符串拼接呢？
`String concatenation '+=' in loop`


如果不是在循环体中进行字符串拼接的话，直接使用+=就可以，+=其实是语法糖而已。



https://blog.csdn.net/dreamingzihao/article/details/105605098

