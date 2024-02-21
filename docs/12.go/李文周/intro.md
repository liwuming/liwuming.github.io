

# json

## json格式



在go语言中

json包下的

Marchal方法将复合类型转json字符串,



byte[],err

byte[]转字符串



## 数组与json

```go
func main() {
	nums := [...]int{1, 2, 3}

	//数组转json
	str1, err1 := json.Marshal(nums)
	if err1 != nil {
		fmt.Println(err1)
		return
	}
	fmt.Println(string(str1))

	var nums2 []int
	err2 := json.Unmarshal(str1, &nums2)
	if err2 != nil {
		fmt.Println(err2)
		return
	}
	fmt.Printf("%T,%v",nums2,nums2)
	//fmt.Println(json.Marshal(nums))
}
```

由于go语言中的数组是必须指定长度的,在将json字符串转化为类数组对象之前是无法确定数组长度的,因此一般将类数组json字符串转化为切片类型.





## 切片与json相互转化







## map与json相互转化

```go
students := map[string]int{
    "张三": 78,
    "李四": 59,
    "赵六": 98,
}

for student, score := range students {
    fmt.Println(student, score)
}

str, err1 := json.Marshal(students)
if err1 != nil {
    fmt.Println(err1)
}
fmt.Println(string(str))

//bytes转map
var omap = make(map[string]int, 10)
err2 := json.Unmarshal(str, &omap)
if err2 != nil {
    fmt.Println(err2)
    return
}
fmt.Println(omap)
```





## 结构体与json的相互转化

```go
type person struct {
	sname string
	age   int
}

func main() {
	p1 := person{"张三", 20}

	buf, err1 := json.Marshal(p1)
	if err1 != nil {
		fmt.Println(err1)
		return
	}
	fmt.Println(string(buf))

	p2 := new(person)
	err2 := json.Unmarshal(buf, &p2)
	if err2 != nil {
		fmt.Println(err2)
		return
	}
	fmt.Printf("%T,%v\n", p1, p1)
	fmt.Printf("%T,%v", p2, p2)
}
```

以上代码运行多次,打印json字符串都是空,后来才发现造成这种错误的原因如下:

> 上述代码不在json包中,也就是属于跨包操作,跨包时,json包仅能访问到导出属性,首字母小写的属性相当于私有属性,对其他包时不可见的.

将结构体person的成员属性的首字母改为大写之后,重新编译执行,此时得到正确结果

```go
type person struct {
	Sname string
	Age   int
}
```



```go
type person struct {
    Sname string `json:"sname"`
    Age   int    `json:"age"`
}
```
