"use strict";(self.webpackChunkme=self.webpackChunkme||[]).push([[7089],{3905:(e,t,r)=>{r.d(t,{Zo:()=>i,kt:()=>d});var n=r(7294);function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function s(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function a(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?s(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):s(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function c(e,t){if(null==e)return{};var r,n,o=function(e,t){if(null==e)return{};var r,n,o={},s=Object.keys(e);for(n=0;n<s.length;n++)r=s[n],t.indexOf(r)>=0||(o[r]=e[r]);return o}(e,t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);for(n=0;n<s.length;n++)r=s[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(o[r]=e[r])}return o}var p=n.createContext({}),l=function(e){var t=n.useContext(p),r=t;return e&&(r="function"==typeof e?e(t):a(a({},t),e)),r},i=function(e){var t=l(e.components);return n.createElement(p.Provider,{value:t},e.children)},u="mdxType",f={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},m=n.forwardRef((function(e,t){var r=e.components,o=e.mdxType,s=e.originalType,p=e.parentName,i=c(e,["components","mdxType","originalType","parentName"]),u=l(r),m=o,d=u["".concat(p,".").concat(m)]||u[m]||f[m]||s;return r?n.createElement(d,a(a({ref:t},i),{},{components:r})):n.createElement(d,a({ref:t},i))}));function d(e,t){var r=arguments,o=t&&t.mdxType;if("string"==typeof e||o){var s=r.length,a=new Array(s);a[0]=m;var c={};for(var p in t)hasOwnProperty.call(t,p)&&(c[p]=t[p]);c.originalType=e,c[u]="string"==typeof e?e:o,a[1]=c;for(var l=2;l<s;l++)a[l]=r[l];return n.createElement.apply(null,a)}return n.createElement.apply(null,r)}m.displayName="MDXCreateElement"},1457:(e,t,r)=>{r.r(t),r.d(t,{assets:()=>p,contentTitle:()=>a,default:()=>f,frontMatter:()=>s,metadata:()=>c,toc:()=>l});var n=r(7462),o=(r(7294),r(3905));const s={},a=void 0,c={unversionedId:"js&ts/js\u5b66\u4e60\u7ecf/xhr",id:"js&ts/js\u5b66\u4e60\u7ecf/xhr",title:"xhr",description:"\u5982\u4f55\u63a5\u6536application/json",source:"@site/docs/02.js&ts/01.js\u5b66\u4e60\u7ecf/00.xhr.md",sourceDirName:"02.js&ts/01.js\u5b66\u4e60\u7ecf",slug:"/js&ts/js\u5b66\u4e60\u7ecf/xhr",permalink:"/docs/js&ts/js\u5b66\u4e60\u7ecf/xhr",draft:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/02.js&ts/01.js\u5b66\u4e60\u7ecf/00.xhr.md",tags:[],version:"current",sidebarPosition:0,frontMatter:{},sidebar:"ecma",next:{title:"js\u4e2d\u4e24\u4e2a\u5c0f\u6570\u76f8\u51cf\uff0c\u51fa\u73b0\u591a\u4f4d\u5c0f\u6570",permalink:"/docs/js&ts/js\u5b66\u4e60\u7ecf/\u7cbe\u5ea6\u4e22\u5931"}},p={},l=[],i={toc:l},u="wrapper";function f(e){let{components:t,...r}=e;return(0,o.kt)(u,(0,n.Z)({},i,r,{components:t,mdxType:"MDXLayout"}),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-js"},"\nconst xhr = new XMLHttpRequest();\nxhr.responseType='json';\nxhr.open('POST','url');\nxhr.send(data);\nxhr.onload = (res)=>{\n    console.log(res);\n}\n")),(0,o.kt)("p",null,"\u5982\u4f55\u63a5\u6536application/json"),(0,o.kt)("p",null,"\u65b9\u6cd51\n// \u8fd9\u6837php\u5c31\u63a5\u6536\u5230postman\u53d1\u9001\u8fc7\u6765\u7684json\u503c\u4e86\n$response = json_decode(file_get_contents('php://input'), true);"),(0,o.kt)("p",null,"\u65b9\u6cd52\n// \u8fd9\u6837php\u5c31\u63a5\u6536\u5230postman\u53d1\u9001\u8fc7\u6765\u7684json\u503c\u4e86\n$response = $GLOBALS","['HTTP_RAW_POST_DATA']",";"),(0,o.kt)("p",null,"\u95ee\u9898\u6c47\u603b\uff0c\n\u76f8\u673a\u65b9\u5411--\uff0c\u4e0e\u7cfb\u7edf\u65b9\u5411\u4e00\u81f4"))}f.isMDXComponent=!0}}]);