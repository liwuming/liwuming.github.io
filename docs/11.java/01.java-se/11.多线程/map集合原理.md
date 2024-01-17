

# map集合源码实现


## hashmap

hash是一种增删，以及查询性能都比较好的一种数据结构，
在jdk8之前，hash表=数组+链表
在jkd8开始，hash表=数组+链表+红黑树

在之前学习的hastset也是基于hashmap来实现的，只是hashset支取hashmap的key而已，保障其唯一性。

```java
public HashSet() {
    map = new HashMap<>();
}
	
	
```


hashmap的键，依赖hashcode和equals方法保证键的唯一性。

如果使用hashmap来存储自定义对象，则可以通过重写hashcode和equals方法来保障多个对象内容一样时，不会重新写入。

## 