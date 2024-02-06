

# 改变url但希望页面不需要刷新

```js
this.formdata0.startime = this.$refs.startime.value;
this.formdata0.endtime = this.$refs.endtime.value;

const url= new URL(window.location);
if(Object.keys(this.query).length==0){
  console.log(url,url.pathname);
  console.log(url.searchParams.get('token'),url.searchParams.get('route'));
  this.query.route=url.searchParams.get('route');
  this.query.token=url.searchParams.get('token');

}
Object.assign(this.query,this.formdata0);
const params = new URLSearchParams(this.query);
history.pushState('','',url.pathname+"?"+decodeURIComponent(params.toString()));
```


history.pushState接收三个参数，

pushState(state, unused)
pushState(state, unused, url)

