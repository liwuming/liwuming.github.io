"use strict";(self.webpackChunkme=self.webpackChunkme||[]).push([[9280],{3905:(e,t,r)=>{r.d(t,{Zo:()=>s,kt:()=>d});var n=r(7294);function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function a(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function l(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?a(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):a(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function i(e,t){if(null==e)return{};var r,n,o=function(e,t){if(null==e)return{};var r,n,o={},a=Object.keys(e);for(n=0;n<a.length;n++)r=a[n],t.indexOf(r)>=0||(o[r]=e[r]);return o}(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(n=0;n<a.length;n++)r=a[n],t.indexOf(r)>=0||Object.prototype.propertyIsEnumerable.call(e,r)&&(o[r]=e[r])}return o}var c=n.createContext({}),p=function(e){var t=n.useContext(c),r=t;return e&&(r="function"==typeof e?e(t):l(l({},t),e)),r},s=function(e){var t=p(e.components);return n.createElement(c.Provider,{value:t},e.children)},u="mdxType",m={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},f=n.forwardRef((function(e,t){var r=e.components,o=e.mdxType,a=e.originalType,c=e.parentName,s=i(e,["components","mdxType","originalType","parentName"]),u=p(r),f=o,d=u["".concat(c,".").concat(f)]||u[f]||m[f]||a;return r?n.createElement(d,l(l({ref:t},s),{},{components:r})):n.createElement(d,l({ref:t},s))}));function d(e,t){var r=arguments,o=t&&t.mdxType;if("string"==typeof e||o){var a=r.length,l=new Array(a);l[0]=f;var i={};for(var c in t)hasOwnProperty.call(t,c)&&(i[c]=t[c]);i.originalType=e,i[u]="string"==typeof e?e:o,l[1]=i;for(var p=2;p<a;p++)l[p]=r[p];return n.createElement.apply(null,l)}return n.createElement.apply(null,r)}f.displayName="MDXCreateElement"},2946:(e,t,r)=>{r.r(t),r.d(t,{assets:()=>c,contentTitle:()=>l,default:()=>m,frontMatter:()=>a,metadata:()=>i,toc:()=>p});var n=r(7462),o=(r(7294),r(3905));const a={},l=void 0,i={unversionedId:"algorithms/\u5237\u9898\u5fc5\u5907",id:"algorithms/\u5237\u9898\u5fc5\u5907",title:"\u5237\u9898\u5fc5\u5907",description:"\u5237\u9898\u5fc5\u5907",source:"@site/docs/31.algorithms/\u5237\u9898\u5fc5\u5907.md",sourceDirName:"31.algorithms",slug:"/algorithms/\u5237\u9898\u5fc5\u5907",permalink:"/docs/algorithms/\u5237\u9898\u5fc5\u5907",draft:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/31.algorithms/\u5237\u9898\u5fc5\u5907.md",tags:[],version:"current",frontMatter:{},sidebar:"\u7b97\u6cd5\u4e0e\u6570\u636e\u7ed3\u6784",previous:{title:"intro",permalink:"/docs/algorithms/intro"},next:{title:"\u7ea2\u9ed1\u6811",permalink:"/docs/algorithms/\u7ea2\u9ed1\u6811"}},c={},p=[],s={toc:p},u="wrapper";function m(e){let{components:t,...r}=e;return(0,o.kt)(u,(0,n.Z)({},s,r,{components:t,mdxType:"MDXLayout"}),(0,o.kt)("p",null,"\u5237\u9898\u5fc5\u5907"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"\u300a\u5251\u6307offer\u300b\n\u300a\u7f16\u7a0b\u4e4b\u7f8e\u300b\n\u300a\u7f16\u7a0b\u4e4b\u6cd5:\u9762\u8bd5\u548c\u7b97\u6cd5\u5fc3\u5f97\u300b\n\u300a\u7b97\u6cd5\u8c1c\u9898\u300b \u90fd\u662f\u601d\u7ef4\u9898\n")),(0,o.kt)("p",null,"\u57fa\u7840"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"\u300a\u7f16\u7a0b\u73e0\u7391\u300bProgramming Pearls\n\u300a\u7f16\u7a0b\u73e0\u7391(\u7eed)\u300b\n\u300a\u6570\u636e\u7ed3\u6784\u4e0e\u7b97\u6cd5\u5206\u6790\u300b\n\u300aAlgorithms\u300b \u8fd9\u672c\u8fd1\u5343\u9875\u7684\u4e66\u53ea\u67096\u7ae0,\u5176\u4e2d\u56db\u7ae0\u5206\u522b\u662f\u6392\u5e8f\uff0c\u67e5\u627e\uff0c\u56fe\uff0c\u5b57\u7b26\u4e32\uff0c\u8db3\u89c1\u4ecb\u7ecd\u7ec6\u81f4\n")),(0,o.kt)("p",null,"\u7b97\u6cd5\u8bbe\u8ba1"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},"\u300a\u7b97\u6cd5\u8bbe\u8ba1\u4e0e\u5206\u6790\u57fa\u7840\u300b\n\u300a\u7b97\u6cd5\u5f15\u8bba\u300b \u544a\u8bc9\u4f60\u5982\u4f55\u521b\u9020\u7b97\u6cd5\n\u300aAlgorithm Design Manual\u300b\u7b97\u6cd5\u8bbe\u8ba1\u624b\u518c \u7ea2\u76ae\u4e66\n\u300a\u7b97\u6cd5\u5bfc\u8bba\u300b \u662f\u4e00\u672c\u5bf9\u7b97\u6cd5\u4ecb\u7ecd\u6bd4\u8f83\u5168\u9762\u7684\u7ecf\u5178\u4e66\u7c4d\n")),(0,o.kt)("p",null,"\u7b97\u6cd5\u56fe\u89e3\n\u7b97\u6cd5\u5bfc\u8bba"),(0,o.kt)("p",null,"\u7b97\u6cd5\u8c1c\u9898\n\u5251\u6307offer\n\u7f16\u7a0b\u4e4b\u6cd5"))}m.isMDXComponent=!0}}]);