



# sublime新增代码片段<!DOCTYPE html>
点击 工具 -> 插件开发 -> 新建代码片段，或者英文 Tools -> Develoer -> New snippet

```ini
<snippet>
	<content><![CDATA[
Hello, ${1:this} is a ${2:snippet}.
]]></content>
	<!-- Optional: Set a tabTrigger to define how to trigger the snippet -->
	<!-- <tabTrigger>hello</tabTrigger> -->
	<!-- Optional: Set a scope to limit where the snippet will trigger -->
	<!-- <scope>source.python</scope> -->
</snippet>
```

console.log();
```js
1. 
<![CDATA[
Hello, ${1:this} is a ${2:snippet}.
]]>

2. <!-- <tabTrigger>hello</tabTrigger> -->

3. 可设置该代码片段的生效文件。

保存时，必须以.sublime-snippet为文件后缀、


> ${1:}表示光标的位置，多个可使用tab键进行切换。
```