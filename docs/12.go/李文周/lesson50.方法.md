面向对象思想

对象是什么

对象就是简单的一个值或者变量,并且拥有方法,而方法是某种特定类型的函数.

面向对象编程就是使用方法来描述每个数据结构的属性和操作,使用者不需要了解对象本身的实现.





## 方法声明



> 在go语言中,可以给任意类型(包括内置类型,但不包括指针类型)添加相应方法,

```go
func (a int) sum(b int) {
	fmt.Println(a + b)
}
func main() {
	num1 := 10
	num1.sum(20)
}
```

结果goland提示报错如下:

```go
cannot define new methods on non-local type int
```

> 经搜索,错误原因是**go语言不允许为简单的内置类型添加方法,但可以通过自定义类型添加方法**

```go
type Integer int

func (a Integer) sum(b Integer) Integer {
	return a + b
}
func main() {
	var num1 Integer = 10
	res := num1.sum(20)
	fmt.Printf("%T,%v", res, res)
}
```

运行结果

main.Integer,30



注意事项

关于方法,仅能为本包的接收者添加方法,无法为import导入的接收者添加方法,除非基于非本包的接收者自定义类型.







概念:

选择子,选择合适的方法

选择子也用于选择结构体类型中的某些字段值,由于方法和字段来自同一命名空间,因此如果结构体类型中出现字段值和方法重名时,编译器会报错.



### 值类型的接收者

```go
func (num1 Integer) less(num2 Integer) bool {
	return num1 < num2
}
```



### 指针类型的接收者

```go
func (num1 *Integer) add(num2 Integer) {
	*num1 += num2
}
```



指针类型的接收者适用场景

1. 需要修改接收者本身,而非其副本
2. 接收者为复合类型,结构复杂,副本成本比较高时,使用指针可提高效率



