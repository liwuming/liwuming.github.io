"use strict";(self.webpackChunkmy_website=self.webpackChunkmy_website||[]).push([[6206],{7829:(e,n,r)=>{r.r(n),r.d(n,{assets:()=>o,contentTitle:()=>i,default:()=>h,frontMatter:()=>t,metadata:()=>a,toc:()=>l});var c=r(4848),s=r(8453);const t={},i=void 0,a={id:"mysql/\u7f51\u7ad9\u7ba1\u7406/ssl\u6574\u6570\u751f\u6210",title:"ssl\u6574\u6570\u751f\u6210",description:"\u5b89\u88c5acme.sh\u811a\u672c",source:"@site/docs/22.mysql/\u7f51\u7ad9\u7ba1\u7406/01.ssl\u6574\u6570\u751f\u6210.md",sourceDirName:"22.mysql/\u7f51\u7ad9\u7ba1\u7406",slug:"/mysql/\u7f51\u7ad9\u7ba1\u7406/ssl\u6574\u6570\u751f\u6210",permalink:"/docs/mysql/\u7f51\u7ad9\u7ba1\u7406/ssl\u6574\u6570\u751f\u6210",draft:!1,unlisted:!1,editUrl:"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/22.mysql/\u7f51\u7ad9\u7ba1\u7406/01.ssl\u6574\u6570\u751f\u6210.md",tags:[],version:"current",sidebarPosition:1,frontMatter:{},sidebar:"mysql",previous:{title:"\u7ecf\u9a8c",permalink:"/docs/mysql/\u7ecf\u9a8c"}},o={},l=[];function d(e){const n={a:"a",br:"br",code:"code",p:"p",pre:"pre",...(0,s.R)(),...e.components};return(0,c.jsxs)(c.Fragment,{children:[(0,c.jsx)(n.p,{children:"\u5b89\u88c5acme.sh\u811a\u672c"}),"\n",(0,c.jsxs)(n.p,{children:["\u53c2\u8003\u6587\u6863:",(0,c.jsx)(n.a,{href:"https://docs.dnspod.cn/dns/acme-sh/",children:"https://docs.dnspod.cn/dns/acme-sh/"})]}),"\n",(0,c.jsx)(n.p,{children:"acme.sh\u5230\u671f\u81ea\u52a8\u66f4\u65b0"}),"\n",(0,c.jsx)(n.pre,{children:(0,c.jsx)(n.code,{className:"language-bash",children:"[Thu May  2 21:30:51 CST 2024] invalid domain\r\n[Thu May  2 21:30:51 CST 2024] Error add txt for domain:_acme-challenge.ibiancheng.net\r\n[Thu May  2 21:30:51 CST 2024] Please add '--debug' or '--log' to check more details.\r\n[Thu May  2 21:30:51 CST 2024] See: https://github.com/acmesh-official/acme.sh/wiki/How-to-debug-acme.sh\r\n[Thu May  2 21:30:51 CST 2024] Please refer to https://curl.haxx.se/libcurl/c/libcurl-errors.html for error code: 3\n"})}),"\n",(0,c.jsx)(n.p,{children:"\u66f4\u65b0\u4e4b\u524d\u7684\u811a\u672c\r\nacme.sh  --issue --dns dns_dp -d ibiancheng.net  -d *.ibiancheng.net\r\n\u66f4\u65b0\u4e4b\u540e\u7684\u811a\u672c\r\nacme.sh  --issue --dns dns_tencent -d ibiancheng.net  -d *.ibiancheng.net"}),"\n",(0,c.jsx)(n.p,{children:"-----BEGIN CERTIFICATE-----\r\nMIIEEDCCA5WgAwIBAgIQcWrdj668j+l6oEx0NGH8BzAKBggqhkjOPQQDAzBLMQsw\r\nCQYDVQQGEwJBVDEQMA4GA1UEChMHWmVyb1NTTDEqMCgGA1UEAxMhWmVyb1NTTCBF\r\nQ0MgRG9tYWluIFNlY3VyZSBTaXRlIENBMB4XDTI0MDUwMjAwMDAwMFoXDTI0MDcz\r\nMTIzNTk1OVowGTEXMBUGA1UEAxMOaWJpYW5jaGVuZy5uZXQwWTATBgcqhkjOPQIB\r\nBggqhkjOPQMBBwNCAARcjLr1iybP2QzdfpJWUxTymKAXQgXaTr9q9drpCb7zjkoz\r\nGxzaIXTzeISGASfyDckVUwmYYmtAL0SSJFx1SJyTo4ICizCCAocwHwYDVR0jBBgw\r\nFoAUD2vmS845R672fpAeefAwkZLIX6MwHQYDVR0OBBYEFMvEiyF6VstS4HPLja33\r\nanfhgT3vMA4GA1UdDwEB/wQEAwIHgDAMBgNVHRMBAf8EAjAAMB0GA1UdJQQWMBQG\r\nCCsGAQUFBwMBBggrBgEFBQcDAjBJBgNVHSAEQjBAMDQGCysGAQQBsjEBAgJOMCUw\r\nIwYIKwYBBQUHAgEWF2h0dHBzOi8vc2VjdGlnby5jb20vQ1BTMAgGBmeBDAECATCB\r\niAYIKwYBBQUHAQEEfDB6MEsGCCsGAQUFBzAChj9odHRwOi8vemVyb3NzbC5jcnQu\r\nc2VjdGlnby5jb20vWmVyb1NTTEVDQ0RvbWFpblNlY3VyZVNpdGVDQS5jcnQwKwYI\r\nKwYBBQUHMAGGH2h0dHA6Ly96ZXJvc3NsLm9jc3Auc2VjdGlnby5jb20wggEDBgor\r\nBgEEAdZ5AgQCBIH0BIHxAO8AdQB2/4g/Crb7lVHCYcz1h7o0tKTNuyncaEIKn+Zn\r\nTFo6dAAAAY85kKX7AAAEAwBGMEQCIDLjs4vKiHd8dZY6SE2rE058kZnFfBod7Kg6\r\nxmyC5ltPAiAVaraSl2LoioqC6qeE0zeMnst8pP1IEOPRLLiekgQD1gB2AD8XS0/X\r\nIkdYlB1lHIS+DRLtkDd/H4Vq68G/KIXs+GRuAAABjzmQpacAAAQDAEcwRQIhALFk\r\nxyveUGsyaIwU55UhxbfN4vC0t2tQgGe8be0g46hnAiBzome05Vqvm6Y2bF86DjdC\r\nOoa1QtYsiBH2lnnHdMUsQzArBgNVHREEJDAigg5pYmlhbmNoZW5nLm5ldIIQKi5p\r\nYmlhbmNoZW5nLm5ldDAKBggqhkjOPQQDAwNpADBmAjEAklpIj2NFtEBE88f2u9O/\r\nNMDpIMsMeiTqS7kU4+MWWjD2PXmSY8RhPvcsykoio+rtAjEAsRkr30KOrR+SWMou\r\nfQlWQPHYjuj1E5Sz2EmbxhxPVOZpsbisudLiEQFBcZObLnVN\r\n-----END CERTIFICATE-----\r\n[Thu May  2 21:49:09 CST 2024] Your cert is in: /root/.acme.sh/ibiancheng.net_ecc/ibiancheng.net.cer\r\n[Thu May  2 21:49:09 CST 2024] Your cert key is in: /root/.acme.sh/ibiancheng.net_ecc/ibiancheng.net.key\r\n[Thu May  2 21:49:09 CST 2024] The intermediate CA cert is in: /root/.acme.sh/ibiancheng.net_ecc/ca.cer\r\n[Thu May  2 21:49:09 CST 2024] And the full chain certs is there: /root/.acme.sh/ibiancheng.net_ecc/fullchain.cer"}),"\n",(0,c.jsx)(n.p,{children:"\u76f4\u63a5\u590d\u5236cert\u6587\u4ef6\u5939\u5230/etc/nginx/cert"}),"\n",(0,c.jsx)(n.p,{children:"nginx\u4e4b\u865a\u62df\u57df\u540d\u914d\u7f6e\u6587\u4ef6"}),"\n",(0,c.jsx)(n.pre,{children:(0,c.jsx)(n.code,{className:"language-nginx",children:"ssl_certificate /etc/nginx/cert/fullchain.cer;\r\nssl_certificate_key /etc/nginx/cert/ibiancheng.net.key;\n"})}),"\n",(0,c.jsx)(n.p,{children:'43 0 * * * "/root/.acme.sh"/acme.sh --cron --home "/root/.acme.sh" > /dev/null'}),"\n",(0,c.jsxs)(n.p,{children:["acme.sh --installcert -d ibiancheng.net ",(0,c.jsx)(n.br,{}),"\n","--key-file       /path/to/keyfile/in/nginx/key.pem  ",(0,c.jsx)(n.br,{}),"\n","--fullchain-file /path/to/fullchain/nginx/cert.pem ",(0,c.jsx)(n.br,{}),"\n",'--reloadcmd     "service nginx force-reload"']})]})}function h(e={}){const{wrapper:n}={...(0,s.R)(),...e.components};return n?(0,c.jsx)(n,{...e,children:(0,c.jsx)(d,{...e})}):d(e)}},8453:(e,n,r)=>{r.d(n,{R:()=>i,x:()=>a});var c=r(6540);const s={},t=c.createContext(s);function i(e){const n=c.useContext(t);return c.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function a(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(s):e.components||s:i(e.components),c.createElement(t.Provider,{value:n},e.children)}}}]);