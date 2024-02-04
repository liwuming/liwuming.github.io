---
sidebar_position: 1
---

# 跟着李文周学习go语言编程



go语言中的随机数

```go

//设置随机数种子
rand.Seed(time.now()).unixNano;



```

此包的输出可能很容易预测种子，对于适用于安全敏感工作的随机数，可使用`crypto/rand`包


为什么不加种子结果一样？

默认情况下，给定的种子是确定的，每次都会产生相同的随机数数字序列。 要产生不同的数字序列，需要给定一个不同的种子。 注意，对于想要加密的随机数，使用此方法并不安全， 应该使用 crypto/rand。


math/rand,伪随机数，效率相对较高
crypto/rand,真随机数，效率相对较低

什么是伪随机数，







## goruntine何时结束
goruntine对应的函数执行完毕




## 如何使得main函数等待所有goruntine结束再退出
sync.WaitGroup

如何让main函数在所有goruntine结束之后再退出。

类似一个计数器，每开启一个goruntine就增加1，goruntine执行结束就-1，带计数器为0时，main函数再退出。

wg.wait();//等待wg计数器减为0

```go
var wg sync.WaitGroup

func main() {
	for i := 0; i < 10; i++ {
		wg.Add(1)
		go hello(i)
	}

	wg.Wait()
	fmt.Println("main-over")
}

func hello(num int) {
	defer wg.Done()
	fmt.Println("hello over", num)
}
```


goroutine调度模型--面试


对操作系统的映射

m:n,


## channel--通道

goruntine是隔离的，如何实现goruntine之间的数据传递

- 数据共享
- 消息

go语言的goruntine是通过发送消息来实现数据传递的


创建一个通道
chan是在go语言中也是一种类型，也具备类型，不同的类型，只能传递不同类型的消息。

ch :=make(chan int);

通道有两个主要操作:发送和接收，两者统称为通信

发送数据，ch<-x;
接收数据，x = <-ch;


通道支持第三个操作--关闭，调用内置的close函数来关闭通道

关闭通道后发送操作会导致宕机。


在使用make创建时，还可以接收第二个可选参数，表示通道容量的整数，

无缓冲通道，使用无缓冲通道进行的通讯导致发送和接收goruntine同步化，因此，无缓冲通道也成为同步通道
有缓冲通道，


```go
var wg1 sync.WaitGroup

func main() {
	naturals := make(chan int)
	squares := make(chan int)
	defer close(naturals)
	defer close(squares)

	for i := 0; i < 10; i++ {
		wg1.Add(1)
		go func(i int) {
			naturals <- i
		}(i)
	}

	go func() {
		for {
			x := <-naturals
			squares <- x * x
		}
	}()

	for {
		num := <-squares
		fmt.Println(num)
		wg1.Done()
	}

	wg1.Wait()
}
```
fatal error: all goroutines are asleep - deadlock!

为什么会出现这样的问题，在main函数中的for循环是一个无限循环，而第一个匿名函数是一个有限循环，没有



修正后的代码
```go
var wg1 sync.WaitGroup

func main() {
	naturals := make(chan int)
	squares := make(chan int)
	defer close(naturals)
	defer close(squares)

	for i := 0; i < 10; i++ {
		wg1.Add(1)
		go func(i int) {
			naturals <- i
		}(i)
	}

	go func() {
		for {
			x := <-naturals
			squares <- x * x
		}
	}()

	for i := 0; i < 10; i++ {
		num := <-squares
		fmt.Println(num)
		wg1.Done()
	}

	wg1.Wait()
}
```




关闭通道不是必须操作，只有在通知接收方goruntine所有的数据都发送关闭的时候才需要关闭通道。

通道也可以通过垃圾回收器根据其是否可以访问来决定是否回收，而不是根据是否关闭。

> 注意不要将管道的close和对于文件的close操作混淆，当结束的时候对每一个文件调用close方法是非常重要的。


使用range循环语法在通道上迭代，更方便的接收在通道上所有发送的值，接受完最后一个值后关闭循环。



```go
var wg2 sync.WaitGroup

func main() {
	naturals := make(chan int)
	squares := make(chan int)

	go func() {
		for i := 0; i < 10; i++ {
			wg2.Add(1)
			naturals <- i
		}
		close(naturals)
	}()

	go func() {
		for natural := range naturals {
			squares <- natural * natural
		}
		close(squares)
	}()

	for square := range squares {
		fmt.Println(square)
		wg2.Done()
	}

	wg2.Wait()
}
```

