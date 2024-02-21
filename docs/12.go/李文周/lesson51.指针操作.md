# 指针操作

一个指针变量,指向了一个变量的内存地址.

```go
func main() {
	var num1 int = 10
	var p *int = &num1
	//p := &num1
	fmt.Println(num1, p)
	*p++
	fmt.Println(num1, p)
	num2 := &p
	fmt.Println(num1, num2)
}
```



*号,放在类型前表示指针类型,放在变量前,表示对指针对应的值进行操作.

go语言取地址符是&,放到变量前使用,就会返回相应变量的内存地址.



