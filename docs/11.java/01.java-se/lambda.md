

# lambda

lambda表达式是jkd8开始新增的一种语法形式，能够以一种简洁的方式传递代码块


在排序
- 类实现comparable接口，并实现compareTo方法
- 实现comparator比较器接口


```java
import java.util.Arrays;
import java.util.Comparator;

public class demo02 {
    public static void main(String[] args) {
        var students = new student[]{
                new student("刘备",50),
                new student("关羽",45),
                new student("张飞",40),
                new student("孙权",43),
                new student("曹操",47),
        };

        class one implements Comparator<student>{
            @Override
            public int compare(student s1, student s2) {
                return Integer.compare(s2.getAge(),s1.getAge());
            }
        }

        System.out.println("=======排序之前遍历结果==========");
        for(student s1:students){
            System.out.println(s1.toString());
        }


        System.out.println("=======排序之后遍历结果--one类实现Comparator接口的compare方法--升序==========");
       	Arrays.sort(students,new one());
       	for(student s1:students){
           System.out.println(s1.toString());
       	}
    }
}
```

以上代码虽然实现了升序对student数组进行排序，但是为了达到这一目的，不得不创建类，实例化类，略显繁琐，以下是使用lambda表达式实现同等效果的代码实现。

```java
import java.util.Arrays;
import java.util.Comparator;

public class demo02 {
    public static void main(String[] args) {
        var students = new student[]{
                new student("刘备",50),
                new student("关羽",45),
                new student("张飞",40),
                new student("孙权",43),
                new student("曹操",47),
        };

        System.out.println("=======排序之后遍历结果--one类实现Comparator接口的compare方法--升序==========");
        Arrays.sort(students, new Comparator<student>() {
            @Override
            public int compare(student o1, student o2) {
                return Integer.compare(o2.getAge(),o1.getAge());
            }
        });

        for(student s1:students){
            System.out.println(s1.toString());
        }
    }
}
```




函数式接口，
在java中有很多封装代码块的接口，

对于只有一个抽象方法的接口，需要这种接口的对象时，就可以提供一个lambda表达式，这种接口称之为函数式接口


接口中的equals方法不需要实现？
接口完全有可能重新声明object类中的方法，这些方法会让方法不再是抽象的。


https://blog.csdn.net/qq_40850266/article/details/113550953

@functionalInterface，函数式接口







```java
import java.util.Arrays;
import java.util.Comparator;

public class demo02 {
    public static void main(String[] args) {
        var students = new student[]{
                new student("刘备",50),
                new student("关羽",45),
                new student("张飞",40),
                new student("孙权",43),
                new student("曹操",47),
        };

        class one implements Comparator<student>{
            @Override
            public int compare(student s1, student s2) {
                return Integer.compare(s2.getAge(),s1.getAge());
            }
        }

        System.out.println("=======排序之前遍历结果==========");
        for(student s1:students){
            System.out.println(s1.toString());
        }
        System.out.println("=======排序之后遍历结果--student类实现comparable接口的compareTo方法--降序==========");
//        Arrays.sort(students);
//        for(student s1:students){
//            System.out.println(s1.toString());
//        }

        System.out.println("=======排序之后遍历结果--one类实现Comparator接口的compare方法--升序==========");

//        Arrays.sort(students,new one());
//        for(student s1:students){
//            System.out.println(s1.toString());
//        }
        
        System.out.println("=======排序之后遍历结果--one类实现Comparator接口的compare方法--升序==========");
        Arrays.sort(students, new Comparator<student>() {
            @Override
            public int compare(student o1, student o2) {
                return Integer.compare(o2.getAge(),o1.getAge());
            }
        });

        for(student s1:students){
            System.out.println(s1.toString());
        }
    }
}




class student{
    private int age;
    private String name;

    public student(String name,int age){
        this.name = name;
        this.age = age;
    }


    public int compareTo(Object o) {
        if(o instanceof student){
            student s1 = (student)o;

            return Integer.compare(s1.getAge(),this.age);
        }else{
            throw new RuntimeException("传入的数据类型不一致");
        }
        //return this.age-s1.getAge();
    }


    public int getAge() {
        return age;
    }

    public void setAge(int age) {
        this.age = age;
    }

    public String toString(){
        return "name:"+this.name+",age"+this.age;
    }

}
```

lambda表达式是jkd8开始新增的一种语法i形式，
作用是简化匿名内部类的代码写法


使用前提条件，只能简化函数式接口的匿名内部类



# lambda表达式的省略写法

- 参数类型可以省略不写
- 如果只有一个参数，参数类型可以省略，同时()有可以省略
- 如果lambda表达式中的方法体代码只有一行代码，可以省略大括号，同时要省略分号，如果这条语句是return语句，需要省略return关键字

```java
public class demo03 {
    public static void main(String[] args) {
        var nums=new Integer[]{10,11,20,32,40,58,89};

        /*匿名内部类*/
//        Arrays.setAll(nums, new IntFunction<Integer>() {
//            @Override
//            public Integer apply(int index) {
//                return nums[index]+10;
//            }
//        });

        /*lambda表达式*/
//        Arrays.setAll(nums,(index)->{
//            return nums[index]+10;
//        });

        /*lambda表达式简化*/
        Arrays.setAll(nums,index->nums[index]+10);

        System.out.println(Arrays.toString(nums));
    }
}
```



## 方法引用


方法引用的符号表示 ::


- 静态方法引用

lambda表达式里只是调用一个静态方法，并且前后参数形式一致，就可以使用静态方法引用。

```java
import java.util.Arrays;
import java.util.Comparator;

public class demo01 {
    public static void main(String[] args) {
        var students = new student[]{
                new student("刘备",50),
                new student("关羽",45),
                new student("张飞",40),
                new student("孙权",43),
                new student("曹操",47),
        };

        System.out.println("=======排序之后遍历结果--one类实现Comparator接口的compare方法--升序==========");
        Arrays.sort(students,utils::compare);
        //Arrays.sort(students,(student o1, student o2)->Integer.compare(o2.getAge(),o1.getAge()));
        for(student s1:students){
            System.out.println(s1.toString());
        }
    }
}

class utils{
    public static int compare(student s1,student s2){
        return Integer.compare(s2.getAge(),s1.getAge());
    }
}


class student{
    private int age;
    private String name;

    public student(String name,int age){
        this.name = name;
        this.age = age;
    }


    public int compareTo(Object o) {
        if(o instanceof student){
            student s1 = (student)o;

            return Integer.compare(s1.getAge(),this.age);
        }else{
            throw new RuntimeException("传入的数据类型不一致");
        }
        //return this.age-s1.getAge();
    }


    public int getAge() {
        return age;
    }

    public void setAge(int age) {
        this.age = age;
    }

    public String toString(){
        return "name:"+this.name+",age"+this.age;
    }

}
```



## 实例方法引用

使用场景
```java
import java.util.Arrays;
import java.util.Comparator;

public class demo01 {
    public static void main(String[] args) {
        var students = new student[]{
                new student("刘备",50),
                new student("关羽",45),
                new student("张飞",40),
                new student("孙权",43),
                new student("曹操",47),
        };

        //静态方法引用
        //Arrays.sort(students,(student s1,student s2)->utils.compare(s1,s2));
        /*
        *
        * 代码简化
        */
        //Arrays.sort(students,utils::compare);




        //Arrays.sort(students,(student s1,student s2)->new utils().compare(s1,s2));
        //代码简化
        Arrays.sort(students,new utils()::desc);
        
        //Arrays.sort(students,utils::compare);
        //Arrays.sort(students,(student o1, student o2)->Integer.compare(o2.getAge(),o1.getAge()));
        //实例方法引用
        //Arrays.sort(students,new utils()::desc);
        for(student s1:students){
            System.out.println(s1.toString());
        }
    }
}

class utils{
    public static int compare(student s1,student s2){
        return Integer.compare(s2.getAge(),s1.getAge());
    }

    //
    public int desc(student s1,student s2){
        return Integer.compare(s2.getAge(),s1.getAge());
    }
}


class student{
    private int age;
    private String name;

    public student(String name,int age){
        this.name = name;
        this.age = age;
    }


    public int compareTo(Object o) {
        if(o instanceof student){
            student s1 = (student)o;

            return Integer.compare(s1.getAge(),this.age);
        }else{
            throw new RuntimeException("传入的数据类型不一致");
        }
        //return this.age-s1.getAge();
    }


    public int getAge() {
        return age;
    }

    public void setAge(int age) {
        this.age = age;
    }

    public String toString(){
        return "name:"+this.name+",age"+this.age;
    }

}
```

## 特定类型的引用

如果某个lambda表达式里只是调用一个实例方法，并且前面参数列表中的第一个参数是作为方法的主调，后面的参数所有参数都作为该实例方法的入参的，此时就可以使用特定类型的方法引用。

```java
public class demo02 {

    public static void main(String[] args) {
        var names = new String[]{"China","hello","one","two","Tom","America","a"};

        //Arrays.setAll(names,index->names[index].toLowerCase());
        //System.out.println(Arrays.toString(names));

        //Arrays.sort(names);
//        Arrays.sort(names,(String s1,String s2)->s1.compareToIgnoreCase(s2));
        Arrays.sort(names, String::compareToIgnoreCase);
        System.out.println(Arrays.toString(names));
    }
}
```

## 构造器的引用

