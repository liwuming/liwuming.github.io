
# 结构体


# 接口


什么是接口

接口是一种类型



侵入式接口
实现类必须显示的声明实现了某个接口


非侵入式接口,


在go语言中,一个类只需要实现了接口要求的所有函数,就成该类实现了该接口.



## 接口赋值

1. 将对象实例赋值给接口
2. 将一个接口赋值给另一个接口

### 对象实例赋值给接口

该对象必须实现了接口要求的所有方法.

```go
type Integer int

type LessAdder interface {
	Less(integer Integer) bool
	Add(integer Integer)
}

func (i Integer) Less(num Integer) bool {
	return i < num
}

func (i *Integer) Add(num Integer) {
	*i += num
}

func main() {
	num1 := Integer(10)
	var num2 LessAdder = &num1

	fmt.Println(num2.Less(30))
}
```



为什么上述代码在将实例对象赋值给接口类型时,必须使用指针呢?

go语言可以根据下面的函数

```go
func (i Integer) Less(num Integer) bool {
	return i < num
}
```

自动生成一个新的less方法

```go
func (i *Integer) Less(num Integer) bool{
    (*a).Less(b)
}
```

这样,类型`*Integer`就既存在Less*()方法,又存在Add()方法,复合LessAdder接口,而从另一方面来说,根据

```go
//函数3
func (i *Integer) Add(num Integer) {
	*i += num
}		
```

无法自动生成

```go
//函数4
func (i Integer) Add(num Integer) {
    (&i).add(num)
}
```

这是为什么呢?这是因为接口LessAdder的add方法没有返回值,表示需要通过传递指针来修改自身值,而go语言函数形参都是值传递,上述函数中的(&i).add(num)只能修改形参的值,对外部没有影响,所以Integer只存在Less()方法,不存在Add()方法.

如果LessAddr接口稍作修改,给add()方法添加返回值,此时无论是传递值,还是指针都是可以的.

```go
type Integer int

type LessAdder interface {
	Less(integer Integer) bool
	Add(integer Integer) Integer
}

func (i Integer) Less(num Integer) bool {
	return i < num
}

func (i Integer) Add(num Integer) Integer {
	i += num
	return i
}

func main() {
	num1 := Integer(10)
	var num2 LessAdder = &num1
	var num3 LessAdder = num1

	fmt.Println(num2.Less(30), num3.Less(30))
}
```



### 将一个接口赋值给另一个接口





## 接口查询





## 类型查询





## 接口组合





## any类型









go语言会根据值的接收者自动生成一个新的指针类型的方法





