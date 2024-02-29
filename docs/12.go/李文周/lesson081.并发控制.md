# 并发控制

goroutine是在后台运行的




主goroutine
封装main函数的goroutine成为主goroutine









```go
var wg sync.WaitGroup
func hello(i int) {
	fmt.Println("hello world--", i)
	wg.Done()
}
func main() {
	for i := 0; i < 10; i++ {
		wg.Add(1)
		go hello(i)
	}
	wg.Wait()
}
```

main函数优雅的退出--等待goroutine执行完毕之后再退出.





为什么waitgroup可以使得main函数能够等待goroutine执行.



wg.done,其实就是wg.add(-1)而已.



wg.wait执行了什么操作,



```go
internal/race,这个库是干啥用的


```





goroutine与线程的区别

goroutine是

线程是固定大小2m,而gotoutine是动态扩容的,初始大小为2k.





## gotoutine调度

GMP模型.

M,machine,M与内核线程是对应的

P,

P与M一般是一一对应的,



P的个数是通过runtine.GIMAXPROCS设定,最大256,

Go1.5之后版本默认为物理线程数.





1. 如何启动
2. 何时结束
3. goroutine调度模型--GMP

M,

p调度者

m:n,把m个goroutine分配给n个os,线程去执行.









## channel初识



通过共享内存来通讯

通过通讯来实现共享内存,



通道是引用类型,必须使用make函数初始化才能使用

> slice,map,channel是引用类型,必须使用make函数初始化才能使用

在初始化时,可指定通道容量,

带缓冲区的通道,

不带缓冲区的通道,





通道操作

1. 发送,ch <- 1

2. 接受,<- ch

3. 关闭,通过close函数关闭通道





无缓存通道发送,接收数据

```go
var wg2 sync.WaitGroup

func main() {
	ch := make(chan int)
	wg2.Add(1)
	go func() {
		defer wg2.Done()
		num := <-ch
		fmt.Println("后台goroutine接收数据", num)
	}()
	ch <- 10
	fmt.Println("main发送数据成功")
	wg2.Wait()
}
```



go语言生成随机数



想实现这样的场景,

将随机生成的随机数发送给通道1,在接收到通道1中的





select语句







关于channel的遍历

```go
//

//通过range方法
rand.Seed(time.Now().UnixNano())
chs := make([]chan int, 10)

wg.Add(10)
for i := 0; i < 10; i++ {
    chs[i] = make(chan int)
    go count(chs[i])
}

for _, ch := range chs {
    num := <-ch
    fmt.Println(ch, num)
}
wg.Wait()
```

channel本质上是一个数据结构--队列,先进先出

具有线程安全机制,不需要加锁

有类型的





个人对带缓冲的通道的理解就是类似有数组,可批量管理,

需求,生成10个随机数,发送给通道1,从通道1中读取数据,生成该值的平方,发送给通道2,最后将结果打印输出.

以不带缓冲的通道来实现

```go
```

以带缓冲的通道来实现

```go
```





close函数的作用,不能再写入,但是可以读已写入的数据

```go
ch := make(chan int, 2)
ch <- 1
ch <- 2
close(ch)
num1 := <-ch
fmt.Println(num1)
num2 := <-ch
fmt.Println(num2)

//如果对已关闭的通道进行取值,
num3, ok := <-ch
fmt.Println(num3, ok)
```

如果读取通道值时超出了其范围,默认值为通道类型的默认值,并且其取值状态为false.





## 双向通道

## 单向通道

故名意思,所谓单向通道就是只能用于发送或者接收数据,channel本身必须是同时支持读写的,否则根本没法用,

单向通道一般用于函数的参数,限定操作类型.



time.







通道的生命周期

1. 创建

2. 赋值
3. 读取
4. 结束



关于通道超时

go语言没有直接提供超时的处理机制,但可以利用select机制,虽然select机制不是专门为超时而设计的,却能很方便的解决超时问题,因为select的特点是只要其中一个case已经完成,程序就会继续往下执行,而不会考虑其他case的情况.





## 线程池



使用goroutine和channel实现一个计算int64随机数各位数和的程序,

求的随机数各个位之和

```go
var wg2 sync.WaitGroup

type job struct {
	pool int
	num  int
}

type task struct {
	job
	sum int
}

func pool2(id int, ch1 <-chan job, ch2 chan<- task) {
	defer wg2.Done()
	for ch := range ch1 {
		ch.pool = id
		res := sum(ch.num)
		//fmt.Printf("%T,%v\n", ch, ch)
		//fmt.Println(ch, res)
		ch2 <- task{
			ch,
			res,
		}
	}
}

func main() {
	ch1 := make(chan job, 10)
	ch2 := make(chan task, 10)
	wg2.Add(3)
	for i := 0; i < 3; i++ {
		go pool2(i, ch1, ch2)
	}

	for j := 0; j < 10; j++ {
		ch1 <- job{num: rand.Intn(100)}
	}
	close(ch1)
	wg2.Wait()
	close(ch2)

	for ch := range ch2 {
		fmt.Println("main", ch)
	}
}

func sum(num int) int {
	str := strconv.Itoa(num)
	tmp := 0
	for _, bit := range str {
		tmp += int(bit - '0')
	}
	return tmp
}
```



## select多路复用

可以同时响应多个通道的操作,有些类似switch,但有区别与switch,因为每个case语句是随机的,并不是从上到下匹配















