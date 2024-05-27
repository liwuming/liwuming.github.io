
# v-for


在vue3中，vue3是否支持map循环，测试一下


```js
<script type="module">
	const { createApp, ref } = Vue;
	// 创建Vue应用
	const app = createApp({
  setup() { // 传说中的setup
   const students = new Map();
   students.set(1,{sname:'aa',age:10});
   students.set(2,{sname:'bb',age:20});
   students.set(3,{sname:'cc',age:30});

   
   const items= students.values();


   return {
    students,items
   }
  }
 });
// 挂载应用
app.mount('#app');
```

在vue3中如何声明响应式的map数据