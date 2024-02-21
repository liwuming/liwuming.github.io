
# 结构体







## 自定义类型与类型别名

自定义类型与类型别名是两个不同的概念

自定义类型定义格式

type 自定义类型名 基本类型,比如	

为什么需要自定义类型

go语言可以给除指针类型外的其他任意类型添加方法,但不能直接给内置的基本类型添加方法,但可以基于内置的基本类型的自定义类型添加方法.

关于方法,仅能为本包的接收者添加方法,无法为import导入的接收者添加方法,除非基于非本包的接收者自定义类型.



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



类型别名

type 类型别名=基本类型

为什么需要类型别名

go语言是强类型的静态语言,为了更加清晰的表达值的类型.

> 类型别名仅存在于程序源码中,在程序编译时会被还原为原始类型.

go语言内置的两个类型别名:byte和rune

```go
//来自build.go
type byte = uint8
type rune = int32
```



```go
type Integer int
type Myint = int

func main() {
	num1 := Integer(10)
	fmt.Printf("%T,%v\n", num1, num1)

	num2 := Myint(10)
	fmt.Printf("%T,%v\n", num2, num2)
}
```

运行结果如下:

main.Integer,10
int,10



上述代码中的Integer(10),Myint(10)是什么?是否还记得之前类型转化string(byte[])...,是否明白过来,就是强制类型转化而已.



## 结构体



go语言中的基础数据类型可以表示一些事物的基本属性,但当想表达一个事物的全部属性时,单一的基本类型显然就无法满足需求了,于是go语言提供了一种自定义数据类型的能力,可以封装多个基本类型,这种数据类型叫做结构体--struct.

> go语言通过struct来实现面向对象.

## 结构体的定义

结构体使用type关键字和struct关键字来定义,具体格式如下:

```go
type 类型名 struct{
    字段名 字段类型
    ...
}
```

说明:

1. 类型名,标识自定义结构体的名称,同一包内不能重复
2. 字段名,表示结构体字段,同一结构体内不能重复
3. 字段类型,表示结构体字段的具体类型.

```go
type Person struct {
	name string
	age  int
	city string
}

func main() {
	person := Person{name: "张三", age: 20}
	
	fmt.Println(person)
}
```



在声明结构体时,如果多个类型相同的属性可简写.

```go
type Person struct {
	name,city string
	age  int
}
```



结构体实例化



```go
type person struct {
	name string
	age  int
}

func main() {
	//方法1
	var p1 person
	p1.name = "张三"
	p1.age = 20

	p2 := person{"李四", 21}

	p3 := person{name: "王五", age: 22}

	fmt.Println(p1, p2, p3)
}
```



虽然结构体的初始化,声明和赋值分开在此处略显繁琐,但在结构体嵌套时,就能体现出其简便性.











结构体是值类型



验证,

> 如何验证呢,将变量a赋值给变量b,对b进行更新操作,观察变量a是否变化,如果b的更新会引起变量a的变化,则是引用类型,否则是值类型

```go
type pointer struct {
	x, y int
}

func main() {
	p1 := pointer{x: 10, y: 20}

	p2 := p1

	p2.x = 20
	p2.y = 30

	fmt.Println(p1, p2)
}
//运行输出结果为:
//{10 20} {20 30}
```

说明p2的更新操作不会引起变量p1的变化,由此可验证结构体是值类型.



结构体是值类型,这也就意味着,结构体可以像基础类型那样使用new关键字进行初始化

```go
func main() {
	person1 := new(Person)
	person1.name = "张三"
	person1.age = 20
	person1.city = "河南洛阳"

	person2 := Person{
		name: "李四",
		age:  20,
	}
	fmt.Println(person1, person2)
}
//输出结果为:
//&{张三 河南洛阳 20} {李四  20}
```

new关键字返回的结果是一个指针引用.







## 匿名结构体

一些临时数据结构体等场景下还可以使用匿名结构体

```go
func main() {
	var animal1 struct {
		name string
		age  int
	}
	animal1.name = "狗"
	animal1.age = 20

	animal2 := struct {
		name string
		age  int
	}{"猫", 10}

	fmt.Println(animal1, animal2)
}
```







## 结构体嵌套

```go
type point struct {
	x, y int
}

type circle struct {
	point  point
	radius int
}

func main() {
	c1 := circle{
		radius: 10,
		point:  point{x: 10, y: 20},
	}

	c2 := circle{
		point{x: 20, y: 20},
		30,
	}
	fmt.Println(c1.point.x, c1.point.x)
	fmt.Println(c2.point.x)
}
```

对于结构体嵌套时,如何访问属性--剥皮,一层一层访问,



对于结构体嵌套时,结构体使用匿名类型,且结构体不冲突时,可直接访问

```go
type point struct {
	x, y int
}

type circle struct {
	point
	radius int
}

func main() {
	c1 := circle{
		radius: 10,
		point:  point{x: 10, y: 20},
	}

	c2 := circle{
		point{x: 20, y: 20},
		30,
	}
	fmt.Println(c1.point.x, c1.x)
	fmt.Println(c2.point.x)
}
```

非常常用.最佳实现,最好在只有一个匿名字段结构体时使用,防止兄弟结构体字段冲突



查找顺序,从外层结构体到内层匿名结构体,递归查找,至到查到即终止.











结构体匿名字段





结构体显式初始化与隐式初始化不能混用,适用于同一层级的结构体,不同层级的结构体,无此限制







是值类型,也就意味着,可以使用new关键字声明变量.











> 注意事项:
>
> 在结构体初始化时,如果最后一个成员和花括号不在同一行,末尾的逗号不可少,否则会报错.

```go
//ok
person := Person{name: "张三", age: 20}
//ok
person := Person{
    name: "张三",
    age: 20}
//error--Need a trailing comma before a newline in the composite literal ',' or new line expected
person := Person{
    name: "张三",
    age: 20
}
```





## 结构体初始化



初始化有两种方式,

1. 使用键值对赋值
2. 简写,按照结构体键的声明顺序赋值,省略键名

注意事项

1. 简写方式,必须不可省略字段
2. 初始化时的字段顺序必须与顺序保持一致
3. 两者不可混用.

> 推荐使用键值对初始化结构体,如果后期修改结构体,代码不用修改,方便维护.





## 方法与接收者

go语言中的方法是一种作用于特定类型变量的函数,这种特定类型变量叫做接收者,接收者的概念就类似于其他面向对象编程语言中的this或者self.

```go
func (接收者变量 接收者类型)方法名(参数列表)[(返回值)]{
    函数体
}
```



对接收者的限制







### 值类型的接收者

```go
type person struct {
	name string
	age  int
}

func (p person) introduce() {
	fmt.Println("my name is "+p.name+", age is ", p.age)
}

func main() {
	p1 := person{"张三", 20}

	p1.introduce()
}

```



### 指针类型的接收者

```go
type person struct {
	name string
	age  int
}

func (p person) introduce() {
	fmt.Println("my name is "+p.name+", age is ", p.age)
}

func (p *person) incage() {
	p.age++
}

func main() {
	p1 := person{"张三", 20}
	p1.incage()
	p1.introduce()
}
```









## 结构体模拟实现继承



```go
type animal struct {
	name string
}

func (a animal) move() {
	fmt.Println(a.name, "i can move")
}

type cat struct {
	animal
}

func (c cat) move() {
	c.animal.move()
	fmt.Println(c.name, "我不仅会动,还会抓老鼠")
}

func main() {
	c := cat{animal{"猫"}}
	c.move()
}
```

其原理还是匿名结构体的嵌套,可直接访问匿名结构体的属性及方法























