








shell编程




1. login shell与nologin shell

在用户登录成功之后,会为当前账户分配一个pid






# 函数

## 创建函数
```bash
//方法1
function fn_name{
	//函数体
}

//付费2
fn_name(){
	//函数体
}
```

bash中的函数,没有圆括号,没有参数列表


> 注意fn_name与花括号之间需要有一个空白字符.




## 调用函数

函数参数的获取
$0,表示文件名
$1,表示第一个参数,
$2,表示第二个参数,
...
以此类推


$@,获取所有参数
$#,获取参数的个数

如何遍历所有参数




数组遍历

```bash
for(()){

}

for var in list
do
	//commands
done
```



获取数组长度

```bash
${#nums}

for((i=0;i<${#nums[@]};i++));do
echo 
done

${nums[@]}

```


# 删除数组元素
删除数组第一项
nums=''




## 删除数组
unset nums











客户端关闭时,自动断开
超过1一分钟,自动断开





beforunload和unload,









