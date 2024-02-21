# 文件读写



## 1. file.read()

```go
func main() {
	workdir, err1 := os.Getwd()

	if err1 != nil {
		fmt.Println(err1)
		return
	}
	fmt.Println(workdir)
	dirpath := workdir + "/module6/lesson071/1.txt"

	file, err2 := os.Open(dirpath)
	if err2 != nil {
		fmt.Println(err2)
		return
	}
	defer func(file *os.File) {
		err := file.Close()
		if err != nil {
			fmt.Println(err)
			return
		}
	}(file)

	var contents []byte
	buf := make([]byte, 10)
	for {
		_, err3 := file.Read(buf)
		if err3 == io.EOF {
			break
		} else if err3 != nil {
			fmt.Println(err3)
			return
		}
		contents = append(contents, buf[:]...)
	}
	fmt.Println(string(contents))
}
```



os.open是对os.openfile的封装,在读取文件是使用os.open更加简单,在写入时需要使用openfile,有更多的选项控制.



## 2. bufio读取文件

在bufio包下有一个

```go
func main() {
	workdir, err1 := os.Getwd()
	if err1 != nil {
		fmt.Println(err1)
		return
	}
	filepath := workdir + "/module6/lesson071/1.txt"
	file, err2 := os.Open(filepath)
	if err2 != nil {
		fmt.Println(err2)
		return
	}
	defer func(file *os.File) {
		err := file.Close()
		if err != nil {
			fmt.Println(err)
		}
	}(file)

	var lines []string
	reader := bufio.NewReader(file)

	for {
		line, _, err3 := reader.ReadLine()
		if err3 == io.EOF {
			break
		} else if err3 != nil {
			fmt.Println(err3)
			return
		}
		lines = append(lines, string(line))
		fmt.Println(string(line))
	}
	fmt.Println(lines)
}
```





```go
func main() {
	workdir, err1 := os.Getwd()
	if err1 != nil {
		fmt.Println(err1)
		return
	}
	filepath := workdir + "/module6/lesson071/1.txt"
	file, err2 := os.Open(filepath)
	if err2 != nil {
		fmt.Println(err2)
		return
	}
	defer func(file *os.File) {
		err := file.Close()
		if err != nil {
			fmt.Println(err)
		}
	}(file)

	var lines []string
	reader := bufio.NewReader(file)
	for {
		line, err3 := reader.ReadString('\n')
		if err3 == io.EOF {
			lines = append(lines, line)
			break
		} else if err3 != nil {
			fmt.Println(err3)
			return
		}
		//line = line[:len(line)-1]
		lines = append(lines, line)
		//fmt.Println()
	}
	fmt.Println(lines)
}
```





```go
func main() {
	workdir, err1 := os.Getwd()
	if err1 != nil {
		fmt.Println(err1)
		return
	}
	filepath := workdir + "/module6/lesson071/1.txt"
	file, err2 := os.Open(filepath)
	if err2 != nil {
		fmt.Println(err2)
		return
	}
	defer func(file *os.File) {
		err := file.Close()
		if err != nil {
			fmt.Println(err)
		}
	}(file)

	var lines []string

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		lines = append(lines, scanner.Text())
	}
	fmt.Println(lines)
}
```





按行读取

## 3.io.readFile

```go
func main(){	
	root,_:= os.Getwd();
	// fmt.Println(root);
	filepath:=root+"/day07/1.txt"
	contents,err:=os.ReadFile(filepath);

	if err != nil{
		fmt.Println(err);
		return;
	}
	fmt.Println(string(contents));
}
```



研究一下大神的代码

```go
func ReadFile(name string) ([]byte, error) {
	f, err := Open(name)
	if err != nil {
		return nil, err
	}
	defer f.Close()

	var size int
	if info, err := f.Stat(); err == nil {
		size64 := info.Size()
		if int64(int(size64)) == size64 {
			size = int(size64)
		}
	}
	size++ // one byte for final read at EOF

	// If a file claims a small size, read at least 512 bytes.
	// In particular, files in Linux's /proc claim size 0 but
	// then do not work right if read in small pieces,
	// so an initial read of 1 byte would not work correctly.
	if size < 512 {
		size = 512
	}

	data := make([]byte, 0, size)
	for {
		if len(data) >= cap(data) {
			d := append(data[:cap(data)], 0)
			data = d[:len(data)]
		}
		n, err := f.Read(data[len(data):cap(data)])
		data = data[:len(data)+n]
		if err != nil {
			if err == io.EOF {
				err = nil
			}
			return data, err
		}
	}
}
```

可以看出os.readFile实际上就是对file.read的封装而已,但是做了优化,比自己写的代码完善性能更高,值得学习.





## 附录1:关于os包常用方法









## 附录2:

















文件os模块

```go
func main() {
	root, _ := os.Getwd()
	filepath := root + "/module4/day06/1.txt"

	file, err := os.OpenFile(filepath, os.O_RDONLY, 0755)
	if err != nil {
		fmt.Println(err)
		return
	}
	defer file.Close()

	var bytes = make([]byte, 128)
	var contents []byte
	for {
		n, err := file.Read(bytes)
		if err == io.EOF {
			break
		}
		contents = append(contents, bytes[:n]...)
	}
	fmt.Println(string(contents))
}
```



缓冲


通过io包，或者ioutils包

io读操作，写操作，读写操作，如果仅需要读操作，可使用os.open方法，操作相对简单



分块读取，
read方法，读取指定内容长度




# 文件的读取与写入



## 文件读取


1.
2. iobuf
3. os.ReadFile.

```go
func main(){	
	root,_:= os.Getwd();
	// fmt.Println(root);
	filepath:=root+"/day07/1.txt"
	contents,err:=os.ReadFile(filepath);

	if err != nil{
		fmt.Println(err);
		return;
	}
	fmt.Println(string(contents));
}
```


其实osutils包下的readfile是os包下的别名方法
```go
// ReadFile reads the named file and returns the contents.
// A successful call returns err == nil, not err == EOF.
// Because ReadFile reads the whole file, it does not treat an EOF from Read
// as an error to be reported.
func ReadFile(name string) ([]byte, error) {
	//打开文件
	f, err := Open(name)
	if err != nil {
		return nil, err
	}
	//延迟操作
	defer f.Close()

	var size int
	if info, err := f.Stat(); err == nil {
		size64 := info.Size()
		if int64(int(size64)) == size64 {
			size = int(size64)
		}
	}
	size++ // one byte for final read at EOF

	// If a file claims a small size, read at least 512 bytes.
	// In particular, files in Linux's /proc claim size 0 but
	// then do not work right if read in small pieces,
	// so an initial read of 1 byte would not work correctly.
	if size < 512 {
		size = 512
	}
	
	data := make([]byte, 0, size)
	for {
		if len(data) >= cap(data) {
			d := append(data[:cap(data)], 0)
			data = d[:len(data)]
		}
		n, err := f.Read(data[len(data):cap(data)])
		data = data[:len(data)+n]
		if err != nil {
			if err == io.EOF {
				err = nil
			}
			return data, err
		}
	}
}
```

golang内置函数make
make函数的主要作用是给不同的类型分配内存，默认有三个参数





在一些资料上看到有通过osutils包下readfile方法来读取文件内容，在这里没有列出来，这是因为go从1.16版本就就不推荐使用





行读



文件读取的几种方式




osutils包官方从go1.16开始就不推荐在新代码中使用。




> os.open是对os.openFile的封装，以只读方式打开文件






readFile方法，用于打开文件，然后将其内容转化为字节切片，



缓冲读

行读


使用io.utils工具类进行文件读取

```go
func main() {
	root, _ := os.Getwd()
	filepath := root + "/module4/day06/1.txt"

	buf, err := ioutil.ReadFile(filepath)
	if err == io.EOF {
		fmt.Println(err)
		return
	}

	fmt.Println(string(buf))
}
```

在使用go编辑器时，发现readfile有横线是怎么回事呢？


ioutil.ReadFile deprecated 

从go1.16开始，io包或os包现在提供相同的功能，并且在新代码中应首选这些实现，具体功能请参见具体的功能文档。




可使用io包下的readAll,实现相同的功能，


make函数定义在内置函数，定义如何
```go
func make(t Type, size ...IntegerType) Type
```

type,
size,
cap,为数据类型提前预留的内u才能空间长度，可选参数，所谓的提前预留是当前为，这样可以避免二次内存分配带来的开销，大大提高性能。




疑惑
字符串，byte,rnue之间什么关系


字符串与byte切片之间的转换


在go语言中，字符串是采用utf8编码的只读字节切片，因此对字符串应用len函数，所获取的长度是字节长度，而非字符串长度。


字符串是字节切片，是只读的，




追加，
覆盖，



OpenFile,
四个参数

name,路径，支持相对路径及绝对路径
flag int,
perm,权限位

os.O_RDONLY,
os.O_WDONLY,
os.O_RDWR,
os.O_APPEND,以追加方式打开，

可以多个模式组合使用，多个模式之间使用`|`连接，如os.O_RDONLY|os.O_APPEND








换行符常量


抓取百度首页，保存到文件中

```go
func main() {
	url := "http://www.baidu.com"
	res, err := http.Get(url)
	if err != nil {
		fmt.Println(err)
		return
	}

	contents, err2 := io.ReadAll(res.Body)
	if err2 != nil {
		fmt.Println(err2)
		return
	}

	root, _ := os.Getwd()
	filepath := root + "/module4/day06/index.html"

	file, err2 := os.OpenFile(filepath, os.O_CREATE|os.O_WRONLY, 0755)
	if err2 != nil {
		fmt.Println(err2)
		return
	}
	defer file.Close()
	writer := bufio.NewWriter(file)
	writer.Write(contents)
	writer.Flush()
}
```
