

-e选项


nl /etc/passwd |sed -ne '5{s/^/hello/;s/$/world/p}'

sed -ne '5{s/^/hello/;s/$/world/p}' /etc/passwd | nl


多命令分组
[address]{
	command1
	command2
}

当多个命令在同一行时需要时需要使用分号进行分割开
[address]{command1;command2[;...]}


```bash
sed -ne '5{s/^/^hello/;s/$/world/p}' /etc/passwd | nl
```


内容复制
```js

```
$('.email[data-toggle="tooltip"]').tooltip();




mysql
```sql
select to_days('2023-07-10 14:28:29')
select to_days('2023-07-10')
```


mysql是否可以使用别名作为where中的查询条件

select concat(firstname,lastname) as uname from hlk_customer where concat(trim(firstname),trim(lastname))='zhanglan'








真坑

1. 字段左右有空格，
2. 使用concat合并字段后的新结果不能作为where查询条件，只能通过having关键字来进行过滤查询
select * from hlk_customer where concat(trim(firstname),trim(lastname))='zhanglan'