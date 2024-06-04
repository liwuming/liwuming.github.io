

## 练兵场


需要一个景点列表，
随机生成一个投票结果，
对结果进行统计，景点与票数之间是一一对应的关系，因此选择hashmap集合
对hashmap根据value进行排序，获取最大value值所对应的key，即投票最多的景点。

```java
public class demo05 {
    public static void main(String[] args) {
        //第一步，生成一个随机数组，用来表示学生的投票结果
        var one = new String[]{"A","B","C","D"};
        var result = new HashMap<String,Integer>();
        var votes = new String[80];
        var random = new Random();
        for (int i = 0; i <votes.length; i++) {
            votes[i] = one[random.nextInt(4)];
        }

        for (int i = 0; i <votes.length; i++) {
            result.putIfAbsent(votes[i],0);
            result.put(votes[i],result.get(votes[i])+1);
        }

        result.forEach((k,v)->{
            System.out.println(k+"--"+v);
        });
        var list = new ArrayList<Map.Entry<String,Integer>>(result.entrySet());
        list.sort((o1,o2)->Integer.compare(o2.getValue(),o1.getValue()));
        var max = list.get(0);
        System.out.println("投票最多的景点："+max.getKey()+",一共票数："+max.getValue());
    }
}
```