


# 模块化



es6的模块实现是编译时加载，或者静态加载，在编译时就完成模块的加载


es6的模块自动开启严格模式，无需显式的"use strict";
严格模式的限制，


- 变量必须先声明后使用，
- 不能使用delete操作符删除变量


对象的要求
- 不能对只读属性赋值，
- 不能删除不可删除属性
  
不能对eval和arguements进行重新赋值
arguments和形参是相互独立的，不会反应彼此的变化
不能使用arguements.caller和arguements.callee
不能使用fn.caller和fn.arguments获取函数的堆栈。






模块的特点，
一个文件就是一个模块，模块之间是相互隔离的，可以通过import和export进行导入和导出







在class及模块内自动开启严格模式


何为严格模式



