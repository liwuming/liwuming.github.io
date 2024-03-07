# tomcat安装

版本的选择

在选择版本时,需要考虑当前java jdk的版本

这边选择tomcat9.0.86



https://mirrors.huaweicloud.com/apache/tomcat/tomcat-9/



tomcat是一个绿色软件,直接解压即可,移到一个没有文件夹下,



文件结构



## 基本使用

卸载,

启动,双击bin/setup.bat即可启动

关闭,

- 直接关闭窗口

- ctrl+c,正常关闭

- bin/shutdown.bat



双击之后,tomcat闪退如何解决?



对于免安装的tomcat的bin



新增两个环境变量

```bat

```

或者在setup.bat文件中,新增两行

```bat
SET JAVA_HOME=D:\jdk1.8.0_131 （java jdk目录）
SET TOMCAT_HOME=D:\Tomcat\apache-tomcat-9.0.40-windows-x64\apache-tomcat-9.0.86
```



https://zhuanlan.zhihu.com/p/353404326





新建JAVA_HOME环境变量,



乱码如何解决

这是由于tomcat默认编码和命令行的默认编码不一致导致的.

编辑conf/logging.properties文件

```tomcat
# 第51行左右
java.util.logging.ConsoleHandler.encoding = GBK
```





# 配置和部署项目

修改启动端口号

修改启动端口号,conf/server.xml文件

![image-20240305224824133](https://img1.ibiancheng.net/liwuming/image-20240305224824133.png)





端口号冲突怎么办

```bash
netstat -ano | findstr "8080"
taskkill /f /t pid
```





# tomcat部署项目

将项目放置到webapps目录下,即部署完成

> 一般javaweb项目会被打成war包,然后将war包放在webapps目录下,tomcat会自动解压缩war文件



# idea中创建maven web项目



web-inf

classes,字节

lib,所依赖坐标对应的jar包



## 使用骨架



删除pom.xml中多余的坐标



补齐缺失的目录结构





## 不使用骨架



修改pom.xml文件,新增标签,修改打包方式





# idea中使用tomcat







![image-20240306061059628](https://img1.ibiancheng.net/liwuming/image-20240306061059628.png)



![image-20240306061134314](https://img1.ibiancheng.net/liwuming/image-20240306061134314.png)



![image-20240306061456241](https://img1.ibiancheng.net/liwuming/image-20240306061456241.png)







