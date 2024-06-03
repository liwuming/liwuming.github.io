---
sidebar_position: 6
---

go语言程序设计


# chap05





函数名，



匿名函数



## 函数参数，

1. go语言中的参数不支持默认值
> 多个连续的相同类型的参数可简写，
2. 变长参数
3. go语言中所有实参均以值进行传递，但是像会间接的修改原始值。

-----



如何实现函数默认值




# 递归

函数可以递归调用,这意味着函数可以直接或间接的调用自己.



求1+2+3+...+100之和
```go
func sum(num int) int {
	if num == 1 {
		return 1
	} else {
		return num + sum(num-1)
	}
}

func main() {
	res := sum(100)
	fmt.Println(res)
}
```






# 返回值

在go语言中,函数可以有多个返回值.



# 错误处理

error是go语言内置的接口类型的错误类型.




