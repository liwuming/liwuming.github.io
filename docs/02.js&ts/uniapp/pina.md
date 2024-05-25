

```js
import App from './App'
import * as Pinia from 'pinia';
import { createSSRApp } from 'vue'
import 'vant/lib/index.css';
import { Button,Picker,Popup } from 'vant';

export function createApp() {
 const app = createSSRApp(App)
 app
  .use(Button)
  .use(Picker)
  .use(Popup)
  .use(Pinia.createPinia());
  return {
   app,
   Pinia 
  }
}
```

