

# servlet



动态web资源开发技术

> servlet是一个规范
>
> 所谓规范就是一个接口



# servlet的快速入门

1. 创建web项目,导入servlet依赖的坐标

```java
<dependency>
    <groupId>javax.servlet</groupId>
    <artifactId>javax.servlet-api</artifactId>
    <version>3.1.0</version>
    <scope>provided</scope>
</dependency>
```

细心的话,会发现servlet的坐标多了一个scope标签,这是什么呢?

注意,scope依赖配置provided



2. 创建类,并实现servlet接口,并重写接口中的所有方法,
3. 以@WebServlet注解的方式配置该servlet的访问路径

![image-20240306063813478](https://img1.ibiancheng.net/liwuming/image-20240306063813478.png)

> 注意,注解的结尾不能有分号

2. 启动





我的idea怎么没有run maven?

原来这是一个插件,需要自行安装



file->setting->plugins

![image-20240306064533437](https://img1.ibiancheng.net/liwuming/image-20240306064533437.png)



maven helper



项目右键-->run maven-->clean install



# Cannot access defaults field of Properties





```xml
<plugin>
    <groupId>org.apache.maven.plugins</groupId>
    <artifactId>maven-war-plugin</artifactId>
    <version>3.2.0</version>

    <!--要在下面添加以下配置-->
    <configuration>
        <failOnMissingWebXml>false</failOnMissingWebXml>
    </configuration>
</plugin>
```





https://blog.csdn.net/An_tu_tu/article/details/128780634







# servlet执行流程

servlet是由谁来执行的,是由谁来调用的.







# servlet生命周期

## init--初始化方法

1. 执行时机,第一次被访问时
2. 执行次数,既然是初始化操作,只会被执行一次

## server--方法



体系结构

简化结构





servlet urlparse配置





xml配置方式编写servlet









