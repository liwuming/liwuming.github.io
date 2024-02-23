# 并发控制

go语言中支持两种并发编程风格

1. goroutine和channel
2. 传统的共享内存

goroutine
channel,用于在goroutine进行通讯

csp,

在go语言中,每一个并发执行的活动称为goroutine,

什么是并发,

并发本是操作系统的一个词汇,
并发是指一个处理器同时处理多个任务,
并行是指多个处理器同时处理多个任务,
并发是逻辑上的同时发生,而并行是物理上的同时发生.

并行(parallel)：指在同一时刻，有多条指令在多个处理器上同时执行。
并发(concurrency)：指在同一时刻只能有一条指令执行，但多个进程指令被快速的轮换执行，使得在宏观上具有多个进程同时执行的效果，但在微观上并不是同时执行的，只是把时间分成若干段，使多个进程快速交替的执行。这就好像两个人用同一把铁锨，轮流挖坑，一小时后，两个人各挖一个小一点的坑，要想挖两个大一点得坑，一定会用两个小时。

https://blog.csdn.net/scarificed/article/details/114645082



当一个程序启动时,只有一个goroutine来调用main函数,主goroutine
goroutine


## 关于通道



通道的作用,


## 关于通道的操作
声明通道
var ch chan int;

声明一个int类型的channel变量,用于传递int类型的变量

无缓冲通道


关闭
close(ch)
