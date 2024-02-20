# 面向对象编程

自定义类型与类型别名

自定义类型,type type


类型别名的语法格式:type alias=type;

> 
go语言自带两个类型别名byte和rune
type byte=int8;
type rune=int32;

类型别名只会出现在代码中,编译完成后,就不会有如byte,rune以及自定义类型别名

类型别名还是非常有用的,鉴于go语言有些类型写起来非常繁琐,比如json相关操作等写起来很繁琐的操作,可以起个简单的类型别名.


自定义类型与类型别名是两个不同的概念

```go
//自定义类型
type Integer int;

//类型别名
type Integer = int;
```

自定义类型在编译完成之后,依旧存在,但类型别名在编译之后就会恢复原类型.

rune就是一个int32类型的别名

> 类型别名,是为了在编写代码时,更加清晰.



给类型添加方法

在go语言中,可以给除指针外的其他任意类型添加方法.



```go
type Integer int

func (num1 Integer) add(num2 Integer) Integer {
	num1 += num2
	fmt.Println(num1)
	return num1
}
func main() {
	var num1 Integer = 10

	res := num1.add(3)
	fmt.Println(res)
}
```

## 结构体

结构体是将任意个任意类型的命名变量组合在一起的聚合数据类型.
每个变量都叫做结构体的成员,

结构体的成员通过点号--.的方式来访问,如person.name,person.age.

多个相同类型成员,可以写在一行,


## 结构体字面量

1. 根据结构体成员的定义顺序进行赋值

2. 根据结构体成员key:value进行赋值,顺序任意,更加常用

```go
type pointer struct {
	x, y int
}

func main() {
	var p1 = pointer{10, 20}

	var p2 = pointer{x: 10, y: 20}

	fmt.Println(p1, p2)
	fmt.Printf("%T\n", p1)
	fmt.Printf("%T\n", p2)
}
```





```go
// 结构体
type Rect struct {
	x, y          float64
	width, height float64
}

func (rect Rect) area() float64 {
	return rect.width * rect.height
}
func main() {
	rect := Rect{x: 5, y: 5, width: 20, height: 10}

	res := rect.area()
	fmt.Println(res)
}
```


结构体初始化.

1. 可以带字段名称,也可以不带

如果不带字段名称,必须严格按照结构体对应字段的进行赋值,

> go语言没有构造函数的概念.


2. 结构体的嵌套




匿名结构体


结构体初始化


go语言对关键字的使用是吝啬的,如果结构体成员的首字母是小写的,则意味着不能导出使用.

两种初始化类型的方式不可混合使用.

> 如果结构体中的成员没有显示赋值,则取成员类型的零值.



结构体可以作为函数参数或返回值使用,但处于性能的考虑,大型的结构体通常都使用结构体指针的方式直接传递给函数或者从函数中返回.


由于通常结构体都是通过指针的方式使用,因此可以使用一种简单的方式来创建,初始化一个struct类型的变量并获取其地址:
```go
type point struct {
	x, y int
}

func main() {
	pp := &point{x: 10, y: 20}

	fmt.Printf("%T,%v", pp, pp)
}
```




结构体比较


如果结构体的所有成员变量都可以比较,那么整个结构体就是可比较的.
当结构体成员类型是复合类型(map,slice,func)时是不可比较的,因此结构体是不可比较的.



结构体是值类型
```go
type point3 struct {
	x, y int
}

func main() {
	p1 := point3{10, 20}

	p2 := p1
	fmt.Println(p1, p2)
	p2.x = 20
	fmt.Println(p1, p2)
}
```

如何判断是否是值类型,还是引用类型
b=a;
b.modify

看b的修改是否会引起a的更新,如果b的修改会引起a的更新,则是引用类型,否则是值类型.




## 关于结构体的嵌套


考虑这样一个场景
```go
type point struct {
	x, y int
}

type circle struct {
	x, y, radius int
}

type wheel struct {
	x, y, radius, spokes int
}
```

这里定义了三个结构体,但是细看,有好多重复的成员,
```go
type point struct {
	x, y int
}

type circle struct {
	point
	radius int
}

type wheel struct {
	circle
	spokes int
}

func main() {
	var wheel0 wheel

	wheel0.x = 10
	wheel0.y = 20
	wheel0.radius = 30
	wheel0.spokes = 40

	//结构体嵌套时,结构体字面量无简写方式
	wheel1 := wheel{circle: circle{point: point{x: 10, y: 20}, radius: 30}, spokes: 40}
	fmt.Println(wheel0, wheel1)

}
```





# json数据格式


结构体与json的相互转化


结构体转json
```go
type one struct {
	X, Y int
}

func main() {
	obj := one{10, 20}

	str, err := json.Marshal(obj)
	if err != nil {
		fmt.Println(err)
		return
	}
	fmt.Println(string(str))
}
```


> 在转化时,仅转化结构体成员首字母大写的成员,首字母小写的会被忽略

/*
* 结构体属性首字母为大写，转换 json 才能成功，小写则不能
* 结构体属性有 json 标签的，使用标签里面的字段名，否则为结构体属性名
* 结构体属性有 json 标签的，注意标签里面的冒号后面没有空格，否则字段名仍为结构体属性名
*/

json字符串转结构体对象






## 接口--interface





go语言的特点
goroutine,
channel,
go语言有类型系统,





结构体的定义

type struct{
	prote type
	...
}

同一包下必须唯一,
同一结构体的属性不可重复

多个连续的类型相同的成员,可简写


1. 匿名结构体
2. 指针类型的结构体
3. 

