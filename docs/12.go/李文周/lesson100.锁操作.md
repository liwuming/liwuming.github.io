

# 同步

goroutine之间共享数据的问题





## 异步写日志





## 互斥锁





## 读写互斥锁









## 同步锁



go语言包中的sync包提供了两种所类型,sync.Mutex和sync.RWMutex.

Mutex是最简单的一种所类型,同时也比较暴力,相当于文件锁,当一个goroutine获得了Mutex后,其他goroutine只能等到这个goroutine释放该锁.

RWMutex相对友好一些,是经典的单写多读模型,



使用goroutine计算和,现在多次计算结果不一致.

```go
var num int
var wg1 sync.WaitGroup

func add() {
	defer wg1.Done()
	for i := 0; i < 10000; i++ {
		num += 1
	}
}
func main() {
	wg1.Add(3)
	go add()
	go add()
	go add()
	wg1.Wait()
	fmt.Println(num)
}
```

为什么会如此,

在高并发下,竞争关系,在

保证原子性,

使用锁机制改良后的代码

````go
var num int
var wg1 sync.WaitGroup
var lock sync.RWMutex

func add() {
	lock.Lock()
	defer wg1.Done()
	defer lock.Unlock()
	for i := 0; i < 10000; i++ {
		num += 1
	}
}
func main() {
	wg1.Add(3)
	go add()
	go add()
	go add()
	wg1.Wait()
	fmt.Println(num)
}
````







## 全局唯一性操作--syce.Once

对于从全局的角度只需要运行一次的代码,比如全局初始化曹祖哦,go语言提供了一个**once类型**来保证全局的唯一性操作,

once是一种类型





once包









sync.Map操作













