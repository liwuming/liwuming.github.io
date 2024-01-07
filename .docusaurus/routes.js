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
    component: ComponentCreator('/docs', 'bac'),
    routes: [
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
        path: '/docs/category/tutorial---basics',
        component: ComponentCreator('/docs/category/tutorial---basics', 'd44'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/category/tutorial---extras',
        component: ComponentCreator('/docs/category/tutorial---extras', 'f09'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/database/intro',
        component: ComponentCreator('/docs/database/intro', '3c4'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/database/redis/intro',
        component: ComponentCreator('/docs/database/redis/intro', 'e77'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/docker/刷题必备',
        component: ComponentCreator('/docs/docker/刷题必备', '3f7'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/docker/intro',
        component: ComponentCreator('/docs/docker/intro', 'ce6'),
        exact: true,
        sidebar: "tutorialSidebar"
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
        component: ComponentCreator('/docs/git/忽略文件', '0fa'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/go/intro',
        component: ComponentCreator('/docs/go/intro', 'd8a'),
        exact: true,
        sidebar: "go"
      },
      {
        path: '/docs/intro',
        component: ComponentCreator('/docs/intro', 'aed'),
        exact: true,
        sidebar: "tutorialSidebar"
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
        path: '/docs/java/java-se/集合/ArrayList',
        component: ComponentCreator('/docs/java/java-se/集合/ArrayList', '235'),
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
        path: '/docs/java/java-se/集合/intro',
        component: ComponentCreator('/docs/java/java-se/集合/intro', '566'),
        exact: true,
        sidebar: "java"
      },
      {
        path: '/docs/java/java-se/集合/map',
        component: ComponentCreator('/docs/java/java-se/集合/map', '7d0'),
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
        path: '/docs/js&ts/2303/如何开发npm包',
        component: ComponentCreator('/docs/js&ts/2303/如何开发npm包', '74a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/2303/研究库',
        component: ComponentCreator('/docs/js&ts/2303/研究库', '23a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/2303/js精度丢失',
        component: ComponentCreator('/docs/js&ts/2303/js精度丢失', '222'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/标准阮一峰es6入门/01',
        component: ComponentCreator('/docs/js&ts/标准阮一峰es6入门/01', '060'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/标准阮一峰es6入门/02.',
        component: ComponentCreator('/docs/js&ts/标准阮一峰es6入门/02.', '0e8'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/标准阮一峰es6入门/迭代器与生成器',
        component: ComponentCreator('/docs/js&ts/标准阮一峰es6入门/迭代器与生成器', 'cfb'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/标准阮一峰es6入门/面向对象程序编程',
        component: ComponentCreator('/docs/js&ts/标准阮一峰es6入门/面向对象程序编程', 'f97'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/标准阮一峰es6入门/疑惑',
        component: ComponentCreator('/docs/js&ts/标准阮一峰es6入门/疑惑', 'bf2'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/前端开发',
        component: ComponentCreator('/docs/js&ts/前端开发', 'ea2'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/实践经验/前端常见问题汇总/如何开发npm包',
        component: ComponentCreator('/docs/js&ts/实践经验/前端常见问题汇总/如何开发npm包', '898'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/实践经验/前端常见问题汇总/js精度丢失',
        component: ComponentCreator('/docs/js&ts/实践经验/前端常见问题汇总/js精度丢失', 'e59'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/实践经验/前端常见问题汇总/one',
        component: ComponentCreator('/docs/js&ts/实践经验/前端常见问题汇总/one', '781'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/小程序开发/常见问题',
        component: ComponentCreator('/docs/js&ts/小程序开发/常见问题', '357'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/小程序开发/地图',
        component: ComponentCreator('/docs/js&ts/小程序开发/地图', 'c64'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/小程序开发/如何查看小程序管理员',
        component: ComponentCreator('/docs/js&ts/小程序开发/如何查看小程序管理员', '67a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/用户',
        component: ComponentCreator('/docs/js&ts/用户', '186'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/intro',
        component: ComponentCreator('/docs/js&ts/intro', '4fb'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/迭代器与生成器',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/迭代器与生成器', '7dc'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/面向对象程序编程',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/面向对象程序编程', '994'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/内置单例对象',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/内置单例对象', '68c'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/原始值包装类型',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/原始值包装类型', '542'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/date对象',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/date对象', '00a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/RegExp',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap04.变量及作用域/RegExp', 'af0'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/内置单例对象',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/内置单例对象', 'ad4'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/原始值包装类型',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/原始值包装类型', '30f'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/date对象',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/date对象', '89e'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/RegExp',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap05.基本引用类型/RegExp', 'c87'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/内置单例对象',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/内置单例对象', '870'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/原始值包装类型',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/原始值包装类型', 'bcf'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/date对象',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/date对象', '438'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/RegExp',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/chap06.集合引用类型/RegExp', '13f'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js高级程序设计-第四版/intro',
        component: ComponentCreator('/docs/js&ts/js高级程序设计-第四版/intro', '785'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js数据结构与算法/查找',
        component: ComponentCreator('/docs/js&ts/js数据结构与算法/查找', 'ca7'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js数据结构与算法/基础准备',
        component: ComponentCreator('/docs/js&ts/js数据结构与算法/基础准备', 'b13'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js数据结构与算法/快速排序',
        component: ComponentCreator('/docs/js&ts/js数据结构与算法/快速排序', 'e68'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js数据结构与算法/排序',
        component: ComponentCreator('/docs/js&ts/js数据结构与算法/排序', '572'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js数据结构与算法/线性结构',
        component: ComponentCreator('/docs/js&ts/js数据结构与算法/线性结构', '5d2'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js数据结构与算法/intro',
        component: ComponentCreator('/docs/js&ts/js数据结构与算法/intro', '867'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js学习经/本地存储',
        component: ComponentCreator('/docs/js&ts/js学习经/本地存储', '25a'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js学习经/函数',
        component: ComponentCreator('/docs/js&ts/js学习经/函数', '53c'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js学习经/精度丢失',
        component: ComponentCreator('/docs/js&ts/js学习经/精度丢失', '50c'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js学习经/日期格式化',
        component: ComponentCreator('/docs/js&ts/js学习经/日期格式化', '7c4'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js学习经/事件',
        component: ComponentCreator('/docs/js&ts/js学习经/事件', '5ab'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/js学习经/xhr',
        component: ComponentCreator('/docs/js&ts/js学习经/xhr', '98f'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/react/新要求',
        component: ComponentCreator('/docs/js&ts/react/新要求', '438'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/ts/ts是什么',
        component: ComponentCreator('/docs/js&ts/ts/ts是什么', '019'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/02-27',
        component: ComponentCreator('/docs/js&ts/uniapp/02-27', '0fc'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/0728',
        component: ComponentCreator('/docs/js&ts/uniapp/0728', 'dba'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/常见问题',
        component: ComponentCreator('/docs/js&ts/uniapp/常见问题', '08f'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/地图',
        component: ComponentCreator('/docs/js&ts/uniapp/地图', '1da'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/聊天记录/发送语音',
        component: ComponentCreator('/docs/js&ts/uniapp/聊天记录/发送语音', '039'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/如何实现导出excel',
        component: ComponentCreator('/docs/js&ts/uniapp/如何实现导出excel', '337'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/下拉加载更多',
        component: ComponentCreator('/docs/js&ts/uniapp/下拉加载更多', '8d8'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/uniapp/wifi调试',
        component: ComponentCreator('/docs/js&ts/uniapp/wifi调试', '4bd'),
        exact: true,
        sidebar: "ecma"
      },
      {
        path: '/docs/js&ts/vue3/新要求',
        component: ComponentCreator('/docs/js&ts/vue3/新要求', 'f12'),
        exact: true,
        sidebar: "ecma"
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
        component: ComponentCreator('/docs/tutorial-basics/congratulations', '793'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/tutorial-basics/create-a-blog-post',
        component: ComponentCreator('/docs/tutorial-basics/create-a-blog-post', '68e'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/tutorial-basics/create-a-document',
        component: ComponentCreator('/docs/tutorial-basics/create-a-document', 'c2d'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/tutorial-basics/create-a-page',
        component: ComponentCreator('/docs/tutorial-basics/create-a-page', 'f44'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/tutorial-basics/deploy-your-site',
        component: ComponentCreator('/docs/tutorial-basics/deploy-your-site', 'e46'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/tutorial-basics/markdown-features',
        component: ComponentCreator('/docs/tutorial-basics/markdown-features', '4b7'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/tutorial-extras/manage-docs-versions',
        component: ComponentCreator('/docs/tutorial-extras/manage-docs-versions', 'fdd'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/tutorial-extras/translate-your-site',
        component: ComponentCreator('/docs/tutorial-extras/translate-your-site', '2d7'),
        exact: true,
        sidebar: "tutorialSidebar"
      },
      {
        path: '/docs/win10系统/关于全角半角切换',
        component: ComponentCreator('/docs/win10系统/关于全角半角切换', 'bad'),
        exact: true,
        sidebar: "tutorialSidebar"
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
