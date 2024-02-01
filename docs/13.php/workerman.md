Worker process terminated意思是进程退出了。

原因：
1 workerman不允许调用exit die...因此代码中不要有退出的
2 php代码错误，可设置错误提示通过控制台可查看错误信息