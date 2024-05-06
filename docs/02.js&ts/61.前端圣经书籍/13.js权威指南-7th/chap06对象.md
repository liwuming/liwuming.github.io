

## 对象的创建

在js中,对象的创建有以下几种方式:
1. 通过new关键字
2. 通过对象字面量
3. 通过Object.create()函数来创建

## new关键字创建对象

## 对象字面量

## object.create()
object.create的强大之处在于可以创建以任意对象为原型的对象.

通过对象字面量创建的对象都有相同的原型对象,在js代码中可以通过Object.prototype引用这个原型对象.

几乎所有对象都有原型,但至于少数对象有prototype属性.



## 查询和设置属性

判断属性是否存在?


在访问对象属性,或者设置对象属性值时,可使用点号--`.`或使用方括号--`[]`,不过一般更多的是使用点号
那为啥存在即合理,当属性为变量时,或者属性包含特殊字符时,就必须使用方括号.



1. 属性访问错误

当访问的属性存在时,会得到一个undefined.





## 属性操作



4) 删除属性

可通过detele操作符进行操作,但是不建议使用这种方式.

可通过反射来进行操作.
```js
const obj={name:"zhangsan"};
//删除属性
Reflect.deleteProperty(obj,"name");
console.log(obj);
```

使用,Reflect.deleteProperty,返回值表示删除属性的状态--成功或失败.
1. 可以删除什么,自身拥有的属性且configurable属性为true的属性


in操作符,自身拥有或者继承都会返回true
hasOwnProperty,自身拥有时返回true
propertyIsEnemerable,





## Object.assign();
如果目标对象中存在来源对象中的属性,会如何处理?


## tostring()






defineProperty(),定义单个对象的属性描述信息
defineProperties(),定义单个对象的多个属性描述信息

getOwnPropertyDescriptor,获取属性描述信息
getOwnPropertyDescriptors,获取属性描述信息

hasOwn
preventExtensions,是否被阻止扩展


freeze,冻结,
isFrozen,是否被冻结

seal,密封对象
isSealed,是否被密封





