

该类包含用于操作数组的各种方法，比如排序和搜索等，


- toString,

- copyOfRange,(strat,end),[start,end)

- copyOf,(strat,end),[start,end)

如果所指定的数组长度比原数组长度长，则会用类型默认值进行填充

字符串，空
int，0

- sort，默认升序，从小到大

如何实现降序排序

首先，如果需要实现降序排序，不能使用基本数据类型，--int，double，char
至于什么原因，现在不清楚，等学明白了，再回来修改


```java
public class demo02 {
    public static void main(String[] args) {
        Integer[] nums={11,23,43,94,25,161,171,81,19,10};

        Arrays.sort(nums, Collections.reverseOrder());
        System.out.println(Arrays.toString(nums));
    }
}
```


如何实现对象的排序


1. 对象类实现comparable接口，然后重写compartTo方法
2. 使用sort方法，创建comparator比较器接口的匿名内部类对象，然后自己制定比较规则


s1,左边对象
s2,右边对象

左边对象>右边对象，返回正整数
左边对象=右边对象，返回0
左边对象<右边对象，返回负整数


降序
s1.age50,s2.age45,diff-5
s1.age40,s2.age50,diff10
s1.age40,s2.age45,diff5
s1.age43,s2.age45,diff2
s1.age43,s2.age40,diff-3
s1.age38,s2.age43,diff5
s1.age38,s2.age40,diff2
s1.age47,s2.age43,diff-4
s1.age47,s2.age45,diff-2
s1.age47,s2.age50,diff3
----
升序
s1.age50,s2.age45,diff5
s1.age40,s2.age50,diff-10
s1.age40,s2.age50,diff-10
s1.age40,s2.age45,diff-5
s1.age43,s2.age45,diff-2
s1.age43,s2.age40,diff3
s1.age38,s2.age45,diff-7
s1.age38,s2.age43,diff-5
s1.age38,s2.age40,diff-2
s1.age47,s2.age43,diff4
s1.age47,s2.age50,diff-3
s1.age47,s2.age45,diff2

s2-s1<0,



https://blog.csdn.net/u013066244/article/details/78997869



官方排序的结果是升序，是在如下的硬性规定之下实现的
< return -1
= return 0
> return 1


a,b,a>b=1,
a=b=>0
a<b=>-1


那进行反向思考，如果对硬性规定进行取反，不久实现了降序了吗？
< return 1
= return 0
> return -1



a>b=-1


https://blog.csdn.net/u013066244/article/details/78997869



负数表示不换位置，正数换位置

①： o2.a > o1.a : 那么此时返回正数，表示需要调整o1,o2的顺序，也就是需要把o2放到o1前面，这不就是降序了么。

②：o2.a < o1.a : 那么此时返回负数，表示不需要调整，也就是此时o1 比 o2大， 不还是降序么。





## 数组的排序


## 数组的搜索


## 数组的复制

