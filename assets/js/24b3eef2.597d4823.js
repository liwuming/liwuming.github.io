"use strict";(self.webpackChunkme=self.webpackChunkme||[]).push([[2671],{3905:(e,t,n)=>{n.d(t,{Zo:()=>u,kt:()=>f});var r=n(7294);function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function i(e,t){if(null==e)return{};var n,r,a=function(e,t){if(null==e)return{};var n,r,a={},l=Object.keys(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}var s=r.createContext({}),c=function(e){var t=r.useContext(s),n=t;return e&&(n="function"==typeof e?e(t):o(o({},t),e)),n},u=function(e){var t=c(e.components);return r.createElement(s.Provider,{value:t},e.children)},p="mdxType",d={inlineCode:"code",wrapper:function(e){var t=e.children;return r.createElement(r.Fragment,{},t)}},m=r.forwardRef((function(e,t){var n=e.components,a=e.mdxType,l=e.originalType,s=e.parentName,u=i(e,["components","mdxType","originalType","parentName"]),p=c(n),m=a,f=p["".concat(s,".").concat(m)]||p[m]||d[m]||l;return n?r.createElement(f,o(o({ref:t},u),{},{components:n})):r.createElement(f,o({ref:t},u))}));function f(e,t){var n=arguments,a=t&&t.mdxType;if("string"==typeof e||a){var l=n.length,o=new Array(l);o[0]=m;var i={};for(var s in t)hasOwnProperty.call(t,s)&&(i[s]=t[s]);i.originalType=e,i[p]="string"==typeof e?e:a,o[1]=i;for(var c=2;c<l;c++)o[c]=n[c];return r.createElement.apply(null,o)}return r.createElement.apply(null,n)}m.displayName="MDXCreateElement"},3838:(e,t,n)=>{n.r(t),n.d(t,{assets:()=>s,contentTitle:()=>o,default:()=>d,frontMatter:()=>l,metadata:()=>i,toc:()=>c});var r=n(7462),a=(n(7294),n(3905));const l={},o="collections\u5de5\u5177\u7c7b",i={unversionedId:"java/java-se/\u96c6\u5408/collections",id:"java/java-se/\u96c6\u5408/collections",title:"collections\u5de5\u5177\u7c7b",description:"addAll\uff0c\u6279\u91cf\u6dfb\u52a0\u5143\u7d20",source:"@site/docs/11.java/01.java-se/09.\u96c6\u5408/02.collections.md",sourceDirName:"11.java/01.java-se/09.\u96c6\u5408",slug:"/java/java-se/\u96c6\u5408/collections",permalink:"/docs/java/java-se/\u96c6\u5408/collections",draft:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/11.java/01.java-se/09.\u96c6\u5408/02.collections.md",tags:[],version:"current",sidebarPosition:2,frontMatter:{},sidebar:"java",previous:{title:"collection\u7cfb\u5217\u5355\u5217\u96c6\u5408",permalink:"/docs/java/java-se/\u96c6\u5408/collection"},next:{title:"ArrayList",permalink:"/docs/java/java-se/\u96c6\u5408/ArrayList"}},s={},c=[{value:"addAll\uff0c\u6279\u91cf\u6dfb\u52a0\u5143\u7d20",id:"addall\u6279\u91cf\u6dfb\u52a0\u5143\u7d20",level:2},{value:"shuffle",id:"shuffle",level:2},{value:"sort\uff0c\u6392\u5e8f",id:"sort\u6392\u5e8f",level:2},{value:"max/min,\u6c42\u96c6\u5408\u6700\u503c",id:"maxmin\u6c42\u96c6\u5408\u6700\u503c",level:2},{value:"swap",id:"swap",level:2},{value:"reverse\uff0c\u53cd\u8f6c\u96c6\u5408\u4e2d\u7684\u5143\u7d20",id:"reverse\u53cd\u8f6c\u96c6\u5408\u4e2d\u7684\u5143\u7d20",level:2}],u={toc:c},p="wrapper";function d(e){let{components:t,...n}=e;return(0,a.kt)(p,(0,r.Z)({},u,n,{components:t,mdxType:"MDXLayout"}),(0,a.kt)("h1",{id:"collections\u5de5\u5177\u7c7b"},"collections\u5de5\u5177\u7c7b"),(0,a.kt)("h2",{id:"addall\u6279\u91cf\u6dfb\u52a0\u5143\u7d20"},"addAll\uff0c\u6279\u91cf\u6dfb\u52a0\u5143\u7d20"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},"public static <T> boolean addAll(Collection<? super T> c, T... elements) {\n    boolean result = false;\n    for (T element : elements)\n        result |= c.add(element);\n    return result;\n}\n")),(0,a.kt)("p",null,(0,a.kt)("inlineCode",{parentName:"p"},"result |= c.add(element)"),"\u662f\u4ec0\u4e48\u542b\u4e49?"),(0,a.kt)("h2",{id:"shuffle"},"shuffle"),(0,a.kt)("h2",{id:"sort\u6392\u5e8f"},"sort\uff0c\u6392\u5e8f"),(0,a.kt)("h2",{id:"maxmin\u6c42\u96c6\u5408\u6700\u503c"},"max/min,\u6c42\u96c6\u5408\u6700\u503c"),(0,a.kt)("h2",{id:"swap"},"swap"),(0,a.kt)("p",null,"swap,\u6839\u636e\u7d22\u5f15\uff0c\u4ea4\u6362\u96c6\u5408\u4e2d\u7684\u4e24\u5143\u7d20\u7684\u503c\n\u6709\u4e86swap\uff0c\u81ea\u5df1\u662f\u4e0d\u662f\u4e5f\u53ef\u4ee5\u5b9e\u73b0shuffle\uff0c\u6253\u4e71\u96c6\u5408\u5143\u7d20\u7684\u65b9\u6cd5\u4e86\uff1f"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},'var length = nums.size();\nvar random  = new Random();\nfor (int i = 0; i < length; i++) {\n    var num = random.nextInt(length);\n    if(num!=i){\n        Collections.swap(nums,i,num);\n    }\n}\n\nSystem.out.println("\u81ea\u5b9a\u4e49shuffle\u7684\u904d\u5386\u7ed3\u679c");\nfor (var num : nums) {\n    System.out.println(num);\n}\n')),(0,a.kt)("p",null,"\u5176\u5b9e\u5982\u679c\u67e5\u770bjdk\u6e90\u7801\u4f1a\u53d1\u73b0\uff0cshuffle\u672c\u8eab\u4e5f\u662f\u501f\u52a9swap\u65b9\u6cd5\u6765\u5b9e\u73b0\u7684,\u53ea\u662f\u5b98\u65b9\u7684\u5b9e\u73b0\uff0c\u8003\u8651\u66f4\u52a0\u5468\u5168\u3002"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},"public static void shuffle(List<?> list, Random rnd) {\n    int size = list.size();\n    //\u8fd9\u91cc\u662f\u4ec0\u4e48\u542b\u4e49?\n    if (size < SHUFFLE_THRESHOLD || list instanceof RandomAccess) {\n        for (int i=size; i>1; i--)\n            swap(list, i-1, rnd.nextInt(i));\n    } else {\n        Object[] arr = list.toArray();\n\n        // Shuffle array\n        for (int i=size; i>1; i--)\n            swap(arr, i-1, rnd.nextInt(i));\n\n        // Dump array back into list\n        // instead of using a raw type here, it's possible to capture\n        // the wildcard but it will require a call to a supplementary\n        // private method\n        ListIterator it = list.listIterator();\n        for (Object e : arr) {\n            it.next();\n            it.set(e);\n        }\n    }\n}\n")),(0,a.kt)("p",null,"THRESHOLD,\u7ffb\u8bd1\u4e3a\u95e8\u69db\uff0c\nRandomAccess\u662f\u4e00\u4e2a\u6807\u8bb0\u63a5\u53e3\uff0c\u5b98\u65b9\u89e3\u91ca\u662f\u53ea\u8981List\u5b9e\u73b0\u8fd9\u4e2a\u63a5\u53e3\uff0c\u5c31\u80fd\u652f\u6301\u5feb\u901f\u968f\u673a\u8bbf\u95ee\u3002\u800c\u4ec0\u4e48\u662f\u968f\u673a\u8bbf\u95ee\u5462\uff1f\u63a5\u4e0b\u6765\u6211\u4eec\u6765\u4e3e\u4f8b\u8bf4\u660e\u3002"),(0,a.kt)("blockquote",null,(0,a.kt)("p",{parentName:"blockquote"},"\u5b9e\u73b0RandomAccess\u63a5\u53e3\u7684List\u53ef\u4ee5\u901a\u8fc7for\u5faa\u73af\u6765\u904d\u5386\u6570\u636e\u6bd4\u4f7f\u7528iterator\u904d\u5386\u6570\u636e\u66f4\u9ad8\u6548\uff0c\u672a\u5b9e\u73b0RandomAccess\u63a5\u53e3\u7684List\u53ef\u4ee5\u901a\u8fc7iterator\u904d\u5386\u6570\u636e\u6bd4\u4f7f\u7528for\u5faa\u73af\u6765\u904d\u5386\u6570\u636e\u66f4\u9ad8\u6548\u3002")),(0,a.kt)("h2",{id:"reverse\u53cd\u8f6c\u96c6\u5408\u4e2d\u7684\u5143\u7d20"},"reverse\uff0c\u53cd\u8f6c\u96c6\u5408\u4e2d\u7684\u5143\u7d20"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},"\n\noutput:\n")))}d.isMDXComponent=!0}}]);