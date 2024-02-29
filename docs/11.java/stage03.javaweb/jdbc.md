

## jdbc


## DreamManager

工具类,

1. 注册驱动
2. 获取数据库连接对象

在mysql5之后的jar包,可以省略class.forName语句的
在jar文件有有个mata-inf


## 获取数据库连接对象

url参数



注意事项,
如果ip地址是127.0.0.1,且端口号是3306,则url中可省略ip和端口号.

参数,
useSSL=false,禁用ssl提示



## 2. connection

2.1. 获取执行SQL的对象

createStatement.
prepareStatement,获取预编译的执行sql对象,防止sql注入


2.2. 管理事务

开启事务,begin,start transaction;
提交事务,commit
回滚事务,rollback


jdbc的事务管理
开启事务,setAuto(state),当为true时,开启事务,当为false时关闭事务
提交事务,commit
回滚事务,rollback




## 3. statement对象

执行SQL语句
executeUpdate,DDL,DML语句
返回值
DML语句,返回受影响的行数
DDL语句,只要没有异常就是ok的.


executeQuery,DQL语句 
返回值,resultSet,结果集





关于结果集对象
next
getXX,获取字段的值






关于预编译的原理

数据库的连接池



