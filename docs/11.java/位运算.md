



在通过变长参数，批量向集合中添加元素时，结果返回一个boolean，表示是否添加元素成功，会如何实现？
```java
public boolean addAll(){
	boolean result = false;
	if(result == false) result = true;
	return result;
}
```


两个操作数对应位同为0时，结果为0，其余全为1。
（或者是只要有一个操作数为1，结果就为1）。