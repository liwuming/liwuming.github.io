import React from 'react';
import ComponentCreator from '@docusaurus/ComponentCreator';

export default [
  {
    path: '/__docusaurus/debug',
    component: ComponentCreator('/__docusaurus/debug', 'd01'),
    exact: true
  },
  {
    path: '/__docusaurus/debug/config',
    component: ComponentCreator('/__docusaurus/debug/config', '609'),
    exact: true
  },
  {
    path: '/__docusaurus/debug/content',
    component: ComponentCreator('/__docusaurus/debug/content', 'af9'),
    exact: true
  },
  {
    path: '/__docusaurus/debug/globalData',
    component: ComponentCreator('/__docusaurus/debug/globalData', '4b0'),
    exact: true
  },
  {
    path: '/__docusaurus/debug/metadata',
    component: ComponentCreator('/__docusaurus/debug/metadata', '27b'),
    exact: true
  },
  {
    path: '/__docusaurus/debug/registry',
    component: ComponentCreator('/__docusaurus/debug/registry', '9ee'),
    exact: true
  },
  {
    path: '/__docusaurus/debug/routes',
    component: ComponentCreator('/__docusaurus/debug/routes', '201'),
    exact: true
  },
  {
    path: '/blog',
    component: ComponentCreator('/blog', 'd74'),
    exact: true
  },
  {
    path: '/blog/20240107',
    component: ComponentCreator('/blog/20240107', 'b92'),
    exact: true
  },
  {
    path: '/blog/archive',
    component: ComponentCreator('/blog/archive', 'e7f'),
    exact: true
  },
  {
    path: '/blog/first-blog-post',
    component: ComponentCreator('/blog/first-blog-post', 'f01'),
    exact: true
  },
  {
    path: '/blog/long-blog-post',
    component: ComponentCreator('/blog/long-blog-post', '620'),
    exact: true
  },
  {
    path: '/blog/mdx-blog-post',
    component: ComponentCreator('/blog/mdx-blog-post', '17e'),
    exact: true
  },
  {
    path: '/blog/tags',
    component: ComponentCreator('/blog/tags', '5bf'),
    exact: true
  },
  {
    path: '/blog/tags/docusaurus',
    component: ComponentCreator('/blog/tags/docusaurus', '29e'),
    exact: true
  },
  {
    path: '/blog/tags/facebook',
    component: ComponentCreator('/blog/tags/facebook', 'ac4'),
    exact: true
  },
  {
    path: '/blog/tags/hello',
    component: ComponentCreator('/blog/tags/hello', '929'),
    exact: true
  },
  {
    path: '/blog/tags/hola',
    component: ComponentCreator('/blog/tags/hola', 'b1e'),
    exact: true
  },
  {
    path: '/blog/we1lcome112',
    component: ComponentCreator('/blog/we1lcome112', '266'),
    exact: true
  },
  {
    path: '/blog/welcome',
    component: ComponentCreator('/blog/welcome', '322'),
    exact: true
  },
  {
    path: '/blog/welcome111',
    component: ComponentCreator('/blog/welcome111', 'ca0'),
    exact: true
  },
  {
    path: '/blog/welcome212',
    component: ComponentCreator('/blog/welcome212', '935'),
    exact: true
  },
  {
    path: '/blog/welcome221',
    component: ComponentCreator('/blog/welcome221', 'bc8'),
    exact: true
  },
  {
    path: '/markdown-page',
    component: ComponentCreator('/markdown-page', '57e'),
    exact: true
  },
  {
    path: '/docs',
    component: ComponentCreator('/docs', '211'),
    routes: [
      {
        path: '/docs/algorithms/红黑树',
        component: ComponentCreator('/docs/algorithms/红黑树', '374'),
        exact: true,
        sidebar: "算法与数据结构"
      },
      {
        path: '/docs/algorithms/刷题必备',
        component: ComponentCreator('/docs/algorithms/刷题必备', '559'),
        exact: true,
        sidebar: "算法与数据结构"
      },
      {
        path: '/docs/algorithms/intro',
        component: ComponentCreator('/docs/algorithms/intro', 'e06'),
        exact: true,
        sidebar: "算法与数据结构"
      },
      {
        path: '/docs/algorithms/leecode/两数之和',
        component: ComponentCreator('/docs/algorithms/leecode/两数之和', 'a21'),
        exact: true,
        sidebar: "算法与数据结构"
      },
      {
        path: '/docs/books/被讨厌的勇气/intro',
        component: ComponentCreator('/docs/books/被讨厌的勇气/intro', 'a74'),
        exact: true,
        sidebar: "books"
      },
      {
        path: '/docs/books/金字塔原理/intro',
        component: ComponentCreator('/docs/books/金字塔原理/intro', '5e9'),
        exact: true,
        sidebar: "books"
      },
      {
        path: '/docs/books/intro',
        component: ComponentCreator('/docs/books/intro', 'fe8'),
        exact: true,
        sidebar: "books"
      },
      {
        path: '/docs/database/intro',
        component: ComponentCreator('/docs/database/intro', '694'),
        exact: true,
        sidebar: "database"
      },
      {
        path: '/docs/database/mysql学习手册/intro',
        component: ComponentCreator('/docs/database/mysql学习手册/intro', '850'),
        exact: true,
        sidebar: "database"
      },
      {
        path: '/docs/database/redis学习手册/intro',
        component: ComponentCreator('/docs/database/redis学习手册/intro', '537'),
        exact: true,
        sidebar: "database"
      },
      {
        path: '/docs/docker/刷题必备',
        component: ComponentCreator('/docs/docker/刷题必备', 'ff4'),
        exact: true
      },
      {
        path: '/docs/docker/intro',
        component: ComponentCreator('/docs/docker/intro', '013'),
        exact: true
      },
      {
        path: '/docs/economist/intro',
        component: ComponentCreator('/docs/economist/intro', '269'),
        exact: true,
        sidebar: "economist"
      },
      {
        path: '/docs/economist/year-2024/month01/2024-01-03',
        component: ComponentCreator('/docs/economist/year-2024/month01/2024-01-03', 'ae3'),
        exact: true,
        sidebar: "economist"
      },
      {
        path: '/docs/economist/year-2024/month01/2024-01-07',
        component: ComponentCreator('/docs/economist/year-2024/month01/2024-01-07', 'cff'),
        exact: true,
        sidebar: "economist"
      },
      {
        path: '/docs/git/忽略文件',
        component: ComponentCreator('/docs/git/忽略文件', '4d5'),
        exact: true
      },
      {
        path: '/docs/go/intro',
        component: ComponentCreator('/docs/go/intro', 'd8a'),
        exact: true,
        sidebar: "go"
      },
      {
        path: '/docs/intro',
        component: ComponentCreator('/docs/intro', 'e84'),
        exact: true
      },
      {
        path: '/docs/java/面试题/查找算法',
        component: ComponentCreator('/docs/java/面试题/查找算法', 'f87'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/面试题/排序算法',
        component: ComponentCreator('/docs/java/面试题/排序算法', '3d0'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/面试题/intro',
        component: ComponentCreator('/docs/java/面试题/intro', 'e70'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/设计模式/单例模式',
        component: ComponentCreator('/docs/java/设计模式/单例模式', '9eb'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/设计模式/intro',
        component: ComponentCreator('/docs/java/设计模式/intro', 'e28'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/算法与数据结构/查找算法',
        component: ComponentCreator('/docs/java/算法与数据结构/查找算法', 'de4'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/算法与数据结构/排序算法',
        component: ComponentCreator('/docs/java/算法与数据结构/排序算法', '8e5'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/算法与数据结构/intro',
        component: ComponentCreator('/docs/java/算法与数据结构/intro', '11a'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/位运算',
        component: ComponentCreator('/docs/java/位运算', '3d0'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/ide使用技巧/错误集锦',
        component: ComponentCreator('/docs/java/ide使用技巧/错误集锦', '205'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/ide使用技巧/各种快捷键',
        component: ComponentCreator('/docs/java/ide使用技巧/各种快捷键', '5e0'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/ide使用技巧/idea',
        component: ComponentCreator('/docs/java/ide使用技巧/idea', '923'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/intro',
        component: ComponentCreator('/docs/java/intro', 'f5f'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/常用操作总结/基本类型-int/数组的遍历',
        component: ComponentCreator('/docs/java/java-se/常用操作总结/基本类型-int/数组的遍历', 'bbe'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/常用操作总结/数组操作/数组的遍历',
        component: ComponentCreator('/docs/java/java-se/常用操作总结/数组操作/数组的遍历', 'e75'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/常用操作总结/正则/数组的遍历',
        component: ComponentCreator('/docs/java/java-se/常用操作总结/正则/数组的遍历', 'bfe'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/常用操作总结/字符串/字符串对象',
        component: ComponentCreator('/docs/java/java-se/常用操作总结/字符串/字符串对象', '3d3'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/泛型程序设计/泛型升序设计',
        component: ComponentCreator('/docs/java/java-se/泛型程序设计/泛型升序设计', '3b1'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/基础类库/时间和日期',
        component: ComponentCreator('/docs/java/java-se/基础类库/时间和日期', '915'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/基础类库/时间和日期/jdk8',
        component: ComponentCreator('/docs/java/java-se/基础类库/时间和日期/jdk8', '5c8'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/基础类库/时间和日期/Time类库',
        component: ComponentCreator('/docs/java/java-se/基础类库/时间和日期/Time类库', 'c27'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/基础类库/ArrayList',
        component: ComponentCreator('/docs/java/java-se/基础类库/ArrayList', '786'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/基础类库/system类库',
        component: ComponentCreator('/docs/java/java-se/基础类库/system类库', '2cb'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/基础类库/utils/arrays',
        component: ComponentCreator('/docs/java/java-se/基础类库/utils/arrays', '939'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/可变参数细节',
        component: ComponentCreator('/docs/java/java-se/集合/可变参数细节', 'add'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/ArrayList',
        component: ComponentCreator('/docs/java/java-se/集合/ArrayList', '3ee'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/collection',
        component: ComponentCreator('/docs/java/java-se/集合/collection', 'e97'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/collections',
        component: ComponentCreator('/docs/java/java-se/集合/collections', '4d9'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/intro',
        component: ComponentCreator('/docs/java/java-se/集合/intro', 'aa8'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/map',
        component: ComponentCreator('/docs/java/java-se/集合/map', '7a3'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/set系列集合',
        component: ComponentCreator('/docs/java/java-se/集合/set系列集合', 'b0d'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/WeakHashMap',
        component: ComponentCreator('/docs/java/java-se/集合/WeakHashMap', '546'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/泛型数组',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/泛型数组', 'd96'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/继承',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/继承', 'ac3'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/接口',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/接口', '1df'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/内部类',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/内部类', '303'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/intro',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/intro', '7d7'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/java生成随机数的方法',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/java生成随机数的方法', 'dbf'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/Object类',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/Object类', '888'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/static关键字',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/static关键字', '4cc'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象高级/this与super',
        component: ComponentCreator('/docs/java/java-se/面向对象高级/this与super', 'fa2'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象基础/访问权限控制',
        component: ComponentCreator('/docs/java/java-se/面向对象基础/访问权限控制', 'e62'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象基础/新建 文本文档',
        component: ComponentCreator('/docs/java/java-se/面向对象基础/新建 文本文档', '88f'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/面向对象基础/java面向对象',
        component: ComponentCreator('/docs/java/java-se/面向对象基础/java面向对象', '660'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/如何求平均数',
        component: ComponentCreator('/docs/java/java-se/如何求平均数', 'c39'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/数组/数组的遍历',
        component: ComponentCreator('/docs/java/java-se/数组/数组的遍历', 'a80'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/异常，断言和日志/处理错误',
        component: ComponentCreator('/docs/java/java-se/异常，断言和日志/处理错误', '794'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/正则表达式/正则入门',
        component: ComponentCreator('/docs/java/java-se/正则表达式/正则入门', '5e8'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/正则表达式/字符串函数',
        component: ComponentCreator('/docs/java/java-se/正则表达式/字符串函数', 'cfb'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/总结/生成随机数',
        component: ComponentCreator('/docs/java/java-se/总结/生成随机数', 'eb5'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/java面向对象',
        component: ComponentCreator('/docs/java/java-se/java面向对象', 'd38'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/lambda',
        component: ComponentCreator('/docs/java/java-se/lambda', 'cf0'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/linux/解惑迷经/巧计易混淆点',
        component: ComponentCreator('/docs/linux/解惑迷经/巧计易混淆点', '72c'),
        exact: true,
        sidebar: "linux"
      },
      {
        path: '/docs/linux/刷题必备',
        component: ComponentCreator('/docs/linux/刷题必备', 'dc3'),
        exact: true,
        sidebar: "linux"
      },
      {
        path: '/docs/linux/intro',
        component: ComponentCreator('/docs/linux/intro', '2fa'),
        exact: true,
        sidebar: "linux"
      },
      {
        path: '/docs/linux/nginx/刷题必备',
        component: ComponentCreator('/docs/linux/nginx/刷题必备', '201'),
        exact: true,
        sidebar: "linux"
      },
      {
        path: '/docs/linux/nginx/intro',
        component: ComponentCreator('/docs/linux/nginx/intro', 'bbc'),
        exact: true,
        sidebar: "linux"
      },
      {
        path: '/docs/tutorial-basics/congratulations',
        component: ComponentCreator('/docs/tutorial-basics/congratulations', '7ef'),
        exact: true
      },
      {
        path: '/docs/tutorial-basics/create-a-blog-post',
        component: ComponentCreator('/docs/tutorial-basics/create-a-blog-post', '2c8'),
        exact: true
      },
      {
        path: '/docs/tutorial-basics/create-a-document',
        component: ComponentCreator('/docs/tutorial-basics/create-a-document', 'f0d'),
        exact: true
      },
      {
        path: '/docs/tutorial-basics/create-a-page',
        component: ComponentCreator('/docs/tutorial-basics/create-a-page', 'ca5'),
        exact: true
      },
      {
        path: '/docs/tutorial-basics/deploy-your-site',
        component: ComponentCreator('/docs/tutorial-basics/deploy-your-site', '508'),
        exact: true
      },
      {
        path: '/docs/tutorial-basics/markdown-features',
        component: ComponentCreator('/docs/tutorial-basics/markdown-features', 'f90'),
        exact: true
      },
      {
        path: '/docs/tutorial-extras/manage-docs-versions',
        component: ComponentCreator('/docs/tutorial-extras/manage-docs-versions', 'd64'),
        exact: true
      },
      {
        path: '/docs/tutorial-extras/translate-your-site',
        component: ComponentCreator('/docs/tutorial-extras/translate-your-site', '16a'),
        exact: true
      },
      {
        path: '/docs/web/前端错误集锦/如何开发npm包',
        component: ComponentCreator('/docs/web/前端错误集锦/如何开发npm包', '667'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端错误集锦/研究库',
        component: ComponentCreator('/docs/web/前端错误集锦/研究库', 'dc2'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端错误集锦/js精度丢失',
        component: ComponentCreator('/docs/web/前端错误集锦/js精度丢失', 'bd8'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/阮一峰es6入门标准/01',
        component: ComponentCreator('/docs/web/前端圣经书籍/阮一峰es6入门标准/01', '0cf'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/阮一峰es6入门标准/02.',
        component: ComponentCreator('/docs/web/前端圣经书籍/阮一峰es6入门标准/02.', '104'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/阮一峰es6入门标准/迭代器与生成器',
        component: ComponentCreator('/docs/web/前端圣经书籍/阮一峰es6入门标准/迭代器与生成器', 'd35'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/阮一峰es6入门标准/面向对象程序编程',
        component: ComponentCreator('/docs/web/前端圣经书籍/阮一峰es6入门标准/面向对象程序编程', '16f'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/阮一峰es6入门标准/疑惑',
        component: ComponentCreator('/docs/web/前端圣经书籍/阮一峰es6入门标准/疑惑', '79a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/迭代器与生成器',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/迭代器与生成器', 'fd7'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/面向对象程序编程',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/面向对象程序编程', 'c41'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/内置单例对象',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/内置单例对象', 'bf1'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/原始值包装类型',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/原始值包装类型', 'e89'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/date对象',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/date对象', '79e'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/RegExp',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap04.变量及作用域/RegExp', '1e9'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/内置单例对象',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/内置单例对象', 'e50'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/原始值包装类型',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/原始值包装类型', '595'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/date对象',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/date对象', '786'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/RegExp',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap05.基本引用类型/RegExp', '989'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/内置单例对象',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/内置单例对象', 'e3a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/原始值包装类型',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/原始值包装类型', '0fc'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/date对象',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/date对象', '725'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/RegExp',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/chap06.集合引用类型/RegExp', 'c4e'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js高级程序设计-第四版/intro',
        component: ComponentCreator('/docs/web/前端圣经书籍/js高级程序设计-第四版/intro', '1b1'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js数据结构与算法/查找',
        component: ComponentCreator('/docs/web/前端圣经书籍/js数据结构与算法/查找', '339'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js数据结构与算法/基础准备',
        component: ComponentCreator('/docs/web/前端圣经书籍/js数据结构与算法/基础准备', '5b2'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js数据结构与算法/快速排序',
        component: ComponentCreator('/docs/web/前端圣经书籍/js数据结构与算法/快速排序', 'c55'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js数据结构与算法/排序',
        component: ComponentCreator('/docs/web/前端圣经书籍/js数据结构与算法/排序', 'd39'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js数据结构与算法/线性结构',
        component: ComponentCreator('/docs/web/前端圣经书籍/js数据结构与算法/线性结构', '8ef'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端圣经书籍/js数据结构与算法/intro',
        component: ComponentCreator('/docs/web/前端圣经书籍/js数据结构与算法/intro', 'eb3'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端优秀库集锦/如何开发npm包',
        component: ComponentCreator('/docs/web/前端优秀库集锦/如何开发npm包', '681'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端优秀库集锦/研究库',
        component: ComponentCreator('/docs/web/前端优秀库集锦/研究库', '96d'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/前端优秀库集锦/js精度丢失',
        component: ComponentCreator('/docs/web/前端优秀库集锦/js精度丢失', '7e2'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/实践经验/前端常见问题汇总/如何开发npm包',
        component: ComponentCreator('/docs/web/实践经验/前端常见问题汇总/如何开发npm包', '434'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/实践经验/前端常见问题汇总/js精度丢失',
        component: ComponentCreator('/docs/web/实践经验/前端常见问题汇总/js精度丢失', '189'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/实践经验/前端常见问题汇总/one',
        component: ComponentCreator('/docs/web/实践经验/前端常见问题汇总/one', '52f'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/实践经验/前端开发',
        component: ComponentCreator('/docs/web/实践经验/前端开发', 'e35'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/实践经验/用户',
        component: ComponentCreator('/docs/web/实践经验/用户', '2af'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/小程序开发/常见问题',
        component: ComponentCreator('/docs/web/小程序开发/常见问题', '7b4'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/小程序开发/地图',
        component: ComponentCreator('/docs/web/小程序开发/地图', '41f'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/小程序开发/如何查看小程序管理员',
        component: ComponentCreator('/docs/web/小程序开发/如何查看小程序管理员', '482'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/es5入门到起飞/intro',
        component: ComponentCreator('/docs/web/es5入门到起飞/intro', '600'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/es6入门到起飞/intro',
        component: ComponentCreator('/docs/web/es6入门到起飞/intro', '074'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/html5&css3/intro',
        component: ComponentCreator('/docs/web/html5&css3/intro', 'c8e'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/intro',
        component: ComponentCreator('/docs/web/intro', '0e7'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/react学习手册/intro',
        component: ComponentCreator('/docs/web/react学习手册/intro', '62a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/ts入门到起飞/intro',
        component: ComponentCreator('/docs/web/ts入门到起飞/intro', '9d3'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/02-27',
        component: ComponentCreator('/docs/web/uniapp学习文档/02-27', '467'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/0728',
        component: ComponentCreator('/docs/web/uniapp学习文档/0728', '2c4'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/常见问题',
        component: ComponentCreator('/docs/web/uniapp学习文档/常见问题', '4c1'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/地图',
        component: ComponentCreator('/docs/web/uniapp学习文档/地图', 'edf'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/聊天记录/发送语音',
        component: ComponentCreator('/docs/web/uniapp学习文档/聊天记录/发送语音', 'd7d'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/如何实现导出excel',
        component: ComponentCreator('/docs/web/uniapp学习文档/如何实现导出excel', '803'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/下拉加载更多',
        component: ComponentCreator('/docs/web/uniapp学习文档/下拉加载更多', '237'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/uniapp学习文档/wifi调试',
        component: ComponentCreator('/docs/web/uniapp学习文档/wifi调试', 'c17'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/web/vue3学习手册/intro',
        component: ComponentCreator('/docs/web/vue3学习手册/intro', '945'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/win10系统/关于全角半角切换',
        component: ComponentCreator('/docs/win10系统/关于全角半角切换', '8d9'),
        exact: true
      }
    ]
  },
  {
    path: '/',
    component: ComponentCreator('/', '4a0'),
    exact: true
  },
  {
    path: '*',
    component: ComponentCreator('*'),
  },
];
