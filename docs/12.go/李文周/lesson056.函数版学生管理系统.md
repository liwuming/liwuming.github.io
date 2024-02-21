# 学生管理系统





学生信息,姓名,年龄

查看所有学生,新增学生,编辑,删除



v1版--函数版学生管理系统

```go
type student struct {
	sname string
	age   int
}

func (s student) introduce() {
	fmt.Println("my name is", s.sname, ", and age is ", s.age)
}

// 学号
var no int = 1000
var students = make(map[int]student)

func main() {
	sname := "学生管理系统"
	fmt.Println("欢迎使用" + sname)

	var choose int
	for {
		menu()
		//读取用户输入
		fmt.Println("请输入菜单编号并回车:")
		_, err := fmt.Scan(&choose)
		if err != nil {
			fmt.Println("输入错误,程序退出", err)
			return
		}

		switch choose {
		//查看全部学生
		case 1:
			if len(students) > 0 {
				for _, student := range students {
					student.introduce()
				}
			} else {
				fmt.Println("当前学生列表为空")
			}
		//新增学生
		case 2:
			var sname string
			var age int
			fmt.Println("请在一行分别输入学生姓名及年龄,并以空格分割,回车结束:")
			_, err2 := fmt.Scan(&sname, &age)
			if err2 != nil {
				fmt.Println(err2)
				return
			}
			students[no] = student{sname, age}
			no++
			fmt.Println("新增学生成功")
		//编辑学生
		case 3:
			var sid int
			fmt.Println("请在一行分别输入学生编号,并回车结束:")
			_, err3 := fmt.Scan(&sid)
			if err3 != nil {
				fmt.Println(err3)
				return
			}

			//此处判断输入学生号码的合法性
			_, ok := students[sid]
			if ok {
				var sname string
				var age int
				fmt.Println("请在一行分别输入学生姓名及年龄,并以空格分割,回车结束:")
				_, err4 := fmt.Scan(&sname, &age)
				if err4 != nil {
					fmt.Println(err4)
					return
				}
				students[sid] = student{sname, age}
			} else {
				fmt.Println("输入有误,不存在该学生编号")
			}
		//删除学生
		case 4:
			var sid int
			fmt.Println("请输入学生编号,并回车结束:")
			_, err3 := fmt.Scan(&sid)
			if err3 != nil {
				fmt.Println(err3)
				return
			}

			//此处判断输入学生号码的合法性
			_, ok := students[sid]
			if ok {
				delete(students, sid)
				fmt.Println("操作成功")
			} else {
				fmt.Println("输入有误,不存在该学生编号")
			}
			break
		case 5:
			fmt.Println("bye,感谢使用" + sname)
			return
		}
	}
}

// 显示菜单
func menu() {
	fmt.Println("1. 查看全部学生")
	fmt.Println("2. 新增学生")
	fmt.Println("3. 编辑学生")
	fmt.Println("4. 删除学生")
	fmt.Println("5. 退出系统")
}

// 查看所有学生
func list() {

}

// 新增学生
func insert() {

}

// 更新学生
func update() {

}

// 删除学生
func del() {

}
```





v2版--结构体版学生管理系统

```go
	
```
