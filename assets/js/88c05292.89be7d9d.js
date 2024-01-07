"use strict";(self.webpackChunkme=self.webpackChunkme||[]).push([[2601],{3905:(e,t,n)=>{n.d(t,{Zo:()=>p,kt:()=>k});var l=n(7294);function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);t&&(l=l.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,l)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function s(e,t){if(null==e)return{};var n,l,a=function(e,t){if(null==e)return{};var n,l,a={},r=Object.keys(e);for(l=0;l<r.length;l++)n=r[l],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);for(l=0;l<r.length;l++)n=r[l],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}var o=l.createContext({}),u=function(e){var t=l.useContext(o),n=t;return e&&(n="function"==typeof e?e(t):i(i({},t),e)),n},p=function(e){var t=u(e.components);return l.createElement(o.Provider,{value:t},e.children)},c="mdxType",d={inlineCode:"code",wrapper:function(e){var t=e.children;return l.createElement(l.Fragment,{},t)}},m=l.forwardRef((function(e,t){var n=e.components,a=e.mdxType,r=e.originalType,o=e.parentName,p=s(e,["components","mdxType","originalType","parentName"]),c=u(n),m=a,k=c["".concat(o,".").concat(m)]||c[m]||d[m]||r;return n?l.createElement(k,i(i({ref:t},p),{},{components:n})):l.createElement(k,i({ref:t},p))}));function k(e,t){var n=arguments,a=t&&t.mdxType;if("string"==typeof e||a){var r=n.length,i=new Array(r);i[0]=m;var s={};for(var o in t)hasOwnProperty.call(t,o)&&(s[o]=t[o]);s.originalType=e,s[c]="string"==typeof e?e:a,i[1]=s;for(var u=2;u<r;u++)i[u]=n[u];return l.createElement.apply(null,i)}return l.createElement.apply(null,n)}m.displayName="MDXCreateElement"},837:(e,t,n)=>{n.r(t),n.d(t,{assets:()=>o,contentTitle:()=>i,default:()=>d,frontMatter:()=>r,metadata:()=>s,toc:()=>u});var l=n(7462),a=(n(7294),n(3905));const r={},i="collection\u7cfb\u5217\u5355\u5217\u96c6\u5408",s={unversionedId:"java/java-se/\u96c6\u5408/collection",id:"java/java-se/\u96c6\u5408/collection",title:"collection\u7cfb\u5217\u5355\u5217\u96c6\u5408",description:"List\u96c6\u5408",source:"@site/docs/11.java/01.java-se/09.\u96c6\u5408/02.collection.md",sourceDirName:"11.java/01.java-se/09.\u96c6\u5408",slug:"/java/java-se/\u96c6\u5408/collection",permalink:"/docs/java/java-se/\u96c6\u5408/collection",draft:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/11.java/01.java-se/09.\u96c6\u5408/02.collection.md",tags:[],version:"current",sidebarPosition:2,frontMatter:{},sidebar:"java",previous:{title:"\u96c6\u5408\u6982\u8ff0",permalink:"/docs/java/java-se/\u96c6\u5408/intro"},next:{title:"collections\u5de5\u5177\u7c7b",permalink:"/docs/java/java-se/\u96c6\u5408/collections"}},o={},u=[{value:"List\u96c6\u5408",id:"list\u96c6\u5408",level:2},{value:"ArrayList\u96c6\u5408",id:"arraylist\u96c6\u5408",level:3},{value:"LinkedList\u96c6\u5408",id:"linkedlist\u96c6\u5408",level:3},{value:"\u961f\u5217\u6a21\u578b",id:"\u961f\u5217\u6a21\u578b",level:3},{value:"\u6808\u6a21\u578b",id:"\u6808\u6a21\u578b",level:3},{value:"\u6ce8\u610f\u4e8b\u9879\uff0c\u96c6\u5408\u7684\u5e76\u53d1\u4fee\u6539\u5f02\u5e38\u95ee\u9898",id:"\u6ce8\u610f\u4e8b\u9879\u96c6\u5408\u7684\u5e76\u53d1\u4fee\u6539\u5f02\u5e38\u95ee\u9898",level:2},{value:"\u53ef\u53d8\u53c2\u6570",id:"\u53ef\u53d8\u53c2\u6570",level:2},{value:"collections\u5de5\u5177\u7c7b",id:"collections\u5de5\u5177\u7c7b",level:2}],p={toc:u},c="wrapper";function d(e){let{components:t,...n}=e;return(0,a.kt)(c,(0,l.Z)({},p,n,{components:t,mdxType:"MDXLayout"}),(0,a.kt)("h1",{id:"collection\u7cfb\u5217\u5355\u5217\u96c6\u5408"},"collection\u7cfb\u5217\u5355\u5217\u96c6\u5408"),(0,a.kt)("h2",{id:"list\u96c6\u5408"},"List\u96c6\u5408"),(0,a.kt)("p",null,"list\u96c6\u5408\u7684\u7279\u70b9"),(0,a.kt)("p",null,"\u4e3b\u8981\u6709\u4e24\u4e2a\u5177\u4f53\u7684\u5b9e\u73b0\u7c7b\uff0c\u5206\u522b\u662fArrayList\u548cLinkedList"),(0,a.kt)("p",null,"\u5e38\u7528\u65b9\u6cd5\uff0c\u5e94\u7528\u573a\u666f\u7b49\u65b9\u9762\u8fdb\u884c\u5b66\u4e60"),(0,a.kt)("h3",{id:"arraylist\u96c6\u5408"},"ArrayList\u96c6\u5408"),(0,a.kt)("p",null,"ArraydList\u96c6\u5408\u5e95\u5c42\u57fa\u4e8e\u6570\u7ec4\u5b9e\u73b0\uff0c\u7531\u4e8e\u6570\u7ec4\u662f\u8fde\u7eed\u7684\u7a7a\u95f4\uff0c\u56e0\u6b64\u901a\u8fc7\u7d22\u5f15\u8bbf\u95ee\u5143\u7d20\u6548\u7387\u6781\u9ad8\uff0c\u4f46\u589e\u5220\u64cd\u4f5c\u6548\u7387\u4e0d\u9ad8\uff0c\u5c24\u5176\u662f\u5f53\u6570\u636e\u91cf\u8f83\u5927\u65f6\uff0c\u7b80\u76f4\u5c31\u662f\u5669\u68a6\uff0c"),(0,a.kt)("blockquote",null,(0,a.kt)("p",{parentName:"blockquote"},"ArrayList\u96c6\u5408\u9002\u7528\u4e8e\u6570\u636e\u91cf\u4e0d\u5927\uff0c\u4e14\u4ee5\u67e5\u8be2\u4e3a\u4e3b\uff0c\u589e\u5220\u64cd\u4f5c\u4e0d\u591a\uff0c\u5c24\u5176\u662f\u6539\u53d8\u6570\u7ec4\u7ed3\u6784\u7684\u64cd\u4f5c\u4e0d\u591a\u3002")),(0,a.kt)("p",null,"\u5728\u521d\u59cb\u5316\u662f\u96c6\u5408\u957f\u5ea6\u4e3a0\uff0c\n\u5f53\u9996\u6b21\u5bf9\u96c6\u5408\u8fdb\u884cadd\u64cd\u4f5c\u65f6\uff0c\u4f1a\u4e00\u6b21\u6027\u5206\u914d10\u4e2a\u7a7a\u95f4\uff0c\n\u5982\u679c\u96c6\u5408\u5927\u5c0f\u8d85\u51fa10\u4e2a\uff0c\u4f1a\u91cd\u65b0\u590d\u5236\u5e76\u6309\u71671.5\u7a7a\u95f4\u8fdb\u884c\u5206\u914d\uff0c"),(0,a.kt)("ul",null,(0,a.kt)("li",{parentName:"ul"},"sort,\u5bf9\u96c6\u5408\u8fdb\u884c\u6392\u5e8f"),(0,a.kt)("li",{parentName:"ul"},"toArray,\u5c06\u96c6\u5408\u8f6c\u5316\u4e3a\u6570\u7ec4"),(0,a.kt)("li",{parentName:"ul"},"lastIndexof,\u8fd4\u56de\u6307\u5b9a\u5143\u7d20\u5728\u96c6\u5408\u4e2d\u6700\u540e\u4e00\u6b21\u51fa\u73b0\u7684\u4f4d\u7f6e\uff0c"),(0,a.kt)("li",{parentName:"ul"},"subList\uff0c\u622a\u53d6\u96c6\u5408\u7684\u4e00\u90e8\u5206"),(0,a.kt)("li",{parentName:"ul"},"trimToSize,\u5c06arrayList\u96c6\u5408\u8c03\u6574\u4e3a\u6570\u7ec4\u4e2d\u7684\u5143\u7d20\u4e2a\u6570\u3002")),(0,a.kt)("h3",{id:"linkedlist\u96c6\u5408"},"LinkedList\u96c6\u5408"),(0,a.kt)("p",null,"LinkedList\u96c6\u5408\u5e95\u5c42\u57fa\u4e8e\u53cc\u5411\u94fe\u8868\u5b9e\u73b0\uff0c"),(0,a.kt)("p",null,"\u94fe\u8868\u7684\u7279\u70b9\uff1a\n\u67e5\u8be2\u6027\u80fd\u4e0d\u9ad8\uff0c\u4f46\u662f\u5bf9\u4e8e\u4e2d\u95f4\u8282\u70b9\u7684\u589e\u5220\u8f83\u5feb\uff0c\u5bf9\u4e8e\u9996\u5c3e\u8282\u70b9\u7684\u589e\u5220\u64cd\u4f5c\u6781\u5feb\u3002"),(0,a.kt)("p",null,"\u8fd9\u662f\u7531\u4e8e\u94fe\u8868\u8282\u70b9\u76f4\u63a5\u5e76\u4e0d\u8fde\u7eed\uff0c\u67e5\u8be2\u9700\u8981\u904d\u5386\u6574\u4e2a\u94fe\u8868\uff0c\u800c\u5bf9\u9996\u5c3e\u8282\u70b9\u7684\u589e\u5220\u64cd\u4f5c\uff0c\u53ef\u4ee5\u76f4\u63a5\u5b9a\u4f4d\uff0c\u56e0\u6b64\u6027\u80fd\u6781\u9ad8\uff0c\u56e0\u6b64jdk\u5bf9LinkedList\u96c6\u5408\u589e\u52a0\u4e86\u82e5\u5e72\u4e2a\u9488\u5bf9\u9996\u5c3e\u64cd\u4f5c\u7684\u65b9\u6cd5"),(0,a.kt)("ul",null,(0,a.kt)("li",{parentName:"ul"},"addFirst,"),(0,a.kt)("li",{parentName:"ul"},"addLast,"),(0,a.kt)("li",{parentName:"ul"},"getFirst,"),(0,a.kt)("li",{parentName:"ul"},"getLast,"),(0,a.kt)("li",{parentName:"ul"},"removeFirst,"),(0,a.kt)("li",{parentName:"ul"},"removeLast,")),(0,a.kt)("p",null,"\u5e94\u7528\u573a\u666f"),(0,a.kt)("h3",{id:"\u961f\u5217\u6a21\u578b"},"\u961f\u5217\u6a21\u578b"),(0,a.kt)("p",null,"\u961f\u5217\u7684\u7279\u70b9\uff0c\u5148\u8fdb\u5148\u51fa\uff0c"),(0,a.kt)("h3",{id:"\u6808\u6a21\u578b"},"\u6808\u6a21\u578b"),(0,a.kt)("p",null,"\u6808\u7684\u7279\u70b9\uff0c\u540e\u8fdb\u5148\u51fa\uff0c\u5148\u8fdb\u540e\u51fa"),(0,a.kt)("p",null,"\u6570\u636e\u8fdb\u5165\u6808\u6a21\u578b\u7684\u8fc7\u7a0b\u79f0\u4e4b\u4e3a\u538b/\u8fdb\u6808--push"),(0,a.kt)("p",null,"\u6570\u636e\u8fdb\u5165\u6808\u6a21\u578b\u7684\u8fc7\u7a0b\u79f0\u4e4b\u4e3a\u5f39/\u51fa\u6808--pop"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},"public class demo02 {\n    public static void main(String[] args) {\n        var nums = new LinkedList<>();\n\n        //\u538b\u6808\u64cd\u4f5c\n        nums.addFirst(10);\n        nums.addFirst(20);\n        nums.addFirst(30);\n        nums.addFirst(40);\n        nums.addFirst(50);\n        System.out.println(nums);\n\n        //\u83b7\u53d6\u7b2c\u4e00\u4e2a\u6808\u5143\u7d20--40\n        System.out.println(nums.get(1));\n\n        //\u51fa\u6808--50,40,30,20\n        nums.removeFirst();\n        System.out.println(nums);\n    }\n}\n")),(0,a.kt)("p",null,"\u538b\u6808\uff0c\u6709\u4e00\u4e2a\u66f4\u52a0\u4e13\u4e1a\u7684\u64cd\u4f5c\u540d\u79f0--push\uff0c\u5f53\u7136LinkedList\u4e5f\u5b9e\u73b0\u4e86\u8fd9\u6837\u7684\u65b9\u6cd5\uff0c\u4f46\u662f\u901a\u8fc7\u67e5\u770b\u6e90\u7801\u53d1\u73b0\uff0cpush\u64cd\u4f5c\u5176\u5b9e\u53ea\u662faddFirst\u7684\u522b\u540d\u64cd\u4f5c\u800c\u5df2\npush,--\x3eaddFirst\npop,--\x3eremoveFirst"),(0,a.kt)("h2",{id:"\u6ce8\u610f\u4e8b\u9879\u96c6\u5408\u7684\u5e76\u53d1\u4fee\u6539\u5f02\u5e38\u95ee\u9898"},"\u6ce8\u610f\u4e8b\u9879\uff0c\u96c6\u5408\u7684\u5e76\u53d1\u4fee\u6539\u5f02\u5e38\u95ee\u9898"),(0,a.kt)("p",null,"\u5728\u96c6\u5408\u904d\u5386\u8fc7\u7a0b\u4e2d\uff0c\u5220\u9664\u96c6\u5408\u5143\u7d20\uff0c\u4f1a\u51fa\u73b0\u5f02\u5e38\u3002"),(0,a.kt)("h2",{id:"\u53ef\u53d8\u53c2\u6570"},"\u53ef\u53d8\u53c2\u6570"),(0,a.kt)("p",null,"\u5728jdk5\u4e2d\u65b0\u589e\u4e86\u53d8\u957f\u53c2\u6570\uff0c\u5141\u8bb8\u5728\u8c03\u7528\u65b9\u6cd5\u65f6\u4f20\u5165\u4e0d\u5b9a\u957f\u957f\u5ea6\u7684\u53c2\u6570\uff0c\u5176\u8bed\u6cd5\u4e3a:\u6570\u636e\u7c7b\u578b...\u5f62\u53c2\u540d\u79f0"),(0,a.kt)("blockquote",null,(0,a.kt)("p",{parentName:"blockquote"},"\u53d8\u957f\u53c2\u6570\u662fjava\u7684\u8bed\u6cd5\u7cd6\uff0c\u5176\u672c\u8d28\u4e0a\u8fd8\u662f\u57fa\u4e8e\u6570\u7ec4\u7684\u5b9e\u73b0\uff0c\u5982",(0,a.kt)("inlineCode",{parentName:"p"},"void hello(int...nums)"),"\u5176\u5b9e\u5c31\u662f",(0,a.kt)("inlineCode",{parentName:"p"},"void hello(int[] nums)"),"\u7684\u8bed\u6cd5\u7cd6\u800c\u5df2\uff0c\u4e24\u8005\u672c\u8d28\u4e0a\u4e00\u6837\u7684\u3002")),(0,a.kt)("p",null,"\u5b9a\u4e49\u5728\u65b9\u6cd5\uff0c\u6784\u9020\u5668\u7684\u4e00\u79cd\u7279\u6b8a\u7684\u5f62\u53c2\uff0c\u6570\u636e\u7c7b\u578b...\u53c2\u6570\u540d\u79f0\n\u53ef\u4ee5\u4f20\u4efb\u610f\u4e2a\u53c2\u6570\uff0c\u53ef\u4f20\u53ef\u4e0d\u4f20\uff0c\u751a\u81f3\u53ef\u4ee5\u4f20\u4efb\u610f\u4e2a\u53c2\u6570"),(0,a.kt)("p",null,"\u5982\u679c\u4f20\u9012\u591a\u4e2a\u53c2\u6570\u65f6\uff0c\u5982\u4f55\u63a5\u6536\u5462\uff0c\u4ee5\u6570\u7ec4\u7684\u5f62\u5f0f\u63a5\u6536\uff1f"),(0,a.kt)("p",null,"\u6ce8\u610f\u4e8b\u9879\uff0c"),(0,a.kt)("p",null,"\u53ef\u53d8\u53c2\u6570\u53ea\u80fd\u4f5c\u4e3a\u51fd\u6570\u7684\u6700\u540e\u4e00\u4e2a\u53c2\u6570\uff0c\u8a00\u5916\u4e4b\u4e00\uff0c\u4e00\u4e2a\u51fd\u6570\u53ea\u80fd\u6709\u4e00\u4e2a\u53ef\u53d8\u53c2\u6570\u3002"),(0,a.kt)("ul",null,(0,a.kt)("li",{parentName:"ul"},(0,a.kt)("p",{parentName:"li"},"\u53ef\u53d8\u53c2\u6570\u5728\u7f16\u8bd1\u540e\u4ee5\u6570\u7ec4\u7684\u5f62\u6001\u51fa\u73b0\uff0c\u4e24\u4e2a\u65b9\u6cd5\u7684\u7b7e\u540d\u662f\u4e00\u81f4\u7684\uff0c\u4e0d\u80fd\u4f5c\u4e3a\u65b9\u6cd5\u91cd\u8f7d\uff0c")),(0,a.kt)("li",{parentName:"ul"},(0,a.kt)("p",{parentName:"li"},"\u5728\u65b9\u6cd5\u91cd\u5728\u65f6\uff0c\u4f18\u5148\u5339\u914d\u56fa\u5b9a\u53c2\u6570"))),(0,a.kt)("p",null,"\u867d\u7136\u53ef\u53d8\u53c2\u6570\u597d\u7528\uff0c\u4f46\u4e00\u4e2a\u5f62\u53c2\u5217\u8868\u4e2d\uff0c\u6700\u591a\u53ea\u80fd\u6709\u4e00\u4e2a\u53ef\u53d8\u53c2\u6570\uff0c"),(0,a.kt)("h2",{id:"collections\u5de5\u5177\u7c7b"},"collections\u5de5\u5177\u7c7b"),(0,a.kt)("p",null,"addAll\uff0c\u6279\u91cf\u63d2\u5165\u5143\u7d20"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},"public static <T> boolean addAll(Collection<? super T> c, T... elements) {\n    boolean result = false;\n    for (T element : elements)\n        result |= c.add(element);\n    return result;\n}\n")),(0,a.kt)("p",null,(0,a.kt)("inlineCode",{parentName:"p"},"result |= c.add(element)"),"\u662f\u4ec0\u4e48\u542b\u4e49?"),(0,a.kt)("p",null,"shuffle\uff0c\u6253\u4e71list\u96c6\u5408\u4e2d\u5143\u7d20\u7684\u987a\u5e8f"),(0,a.kt)("p",null,"sort,\u5bf9\u96c6\u5408\u4e2d\u7684\u5143\u7d20\u8fdb\u884c\u6392\u5e8f\uff0c\u9ed8\u8ba4\u6309\u7167\u5347\u5e8f\u8fdb\u884c\u6392\u5e8f\uff0c\u4e5f\u53ef\u4f20\u9012\u6bd4\u8f83\u5668\u5b9e\u73b0\u81ea\u5b9a\u4e49\u6392\u5e8f\u89c4\u5219\u3002"),(0,a.kt)("ul",null,(0,a.kt)("li",{parentName:"ul"},"reverse\uff0c\u53cd\u8f6c\u96c6\u5408\u4e2d\u7684\u5143\u7d20")),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},"\n\n\noutput:\n")),(0,a.kt)("p",null,"swap,\u6839\u636e\u7d22\u5f15\uff0c\u4ea4\u6362\u96c6\u5408\u4e2d\u7684\u4e24\u5143\u7d20\u7684\u503c\n\u6709\u4e86swap\uff0c\u81ea\u5df1\u662f\u4e0d\u662f\u4e5f\u53ef\u4ee5\u5b9e\u73b0shuffle\uff0c\u6253\u4e71\u96c6\u5408\u5143\u7d20\u7684\u65b9\u6cd5\u4e86\uff1f"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},'var length = nums.size();\nvar random  = new Random();\nfor (int i = 0; i < length; i++) {\n    var num = random.nextInt(length);\n    if(num!=i){\n        Collections.swap(nums,i,num);\n    }\n}\n\nSystem.out.println("\u81ea\u5b9a\u4e49shuffle\u7684\u904d\u5386\u7ed3\u679c");\nfor (var num : nums) {\n    System.out.println(num);\n}\n')),(0,a.kt)("p",null,"\u5176\u5b9e\u5982\u679c\u67e5\u770bjdk\u6e90\u7801\u4f1a\u53d1\u73b0\uff0cshuffle\u672c\u8eab\u4e5f\u662f\u501f\u52a9swap\u65b9\u6cd5\u6765\u5b9e\u73b0\u7684,\u53ea\u662f\u5b98\u65b9\u7684\u5b9e\u73b0\uff0c\u8003\u8651\u66f4\u52a0\u5468\u5168\u3002"),(0,a.kt)("pre",null,(0,a.kt)("code",{parentName:"pre",className:"language-java"},"public static void shuffle(List<?> list, Random rnd) {\n    int size = list.size();\n    //\u8fd9\u91cc\u662f\u4ec0\u4e48\u542b\u4e49?\n    if (size < SHUFFLE_THRESHOLD || list instanceof RandomAccess) {\n        for (int i=size; i>1; i--)\n            swap(list, i-1, rnd.nextInt(i));\n    } else {\n        Object[] arr = list.toArray();\n\n        // Shuffle array\n        for (int i=size; i>1; i--)\n            swap(arr, i-1, rnd.nextInt(i));\n\n        // Dump array back into list\n        // instead of using a raw type here, it's possible to capture\n        // the wildcard but it will require a call to a supplementary\n        // private method\n        ListIterator it = list.listIterator();\n        for (Object e : arr) {\n            it.next();\n            it.set(e);\n        }\n    }\n}\n")))}d.isMDXComponent=!0}}]);