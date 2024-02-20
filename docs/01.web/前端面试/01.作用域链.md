

```json
{
  "editor.fontSize": 20,
  "editor.suggestSelection": "first",
  "vsintellicode.modify.editor.suggestSelection": "automaticallyOverrodeDefaultValue",
  "editor.mouseWheelZoom": true,
  "git.enableSmartCommit": true,
  "editor.hover.delay": 0,
  "editor.tabSize": 2,
  "bracketSameLine": true, // 头标签的 > 和属性保持同一行
  "minapp-vscode.disableAutoConfig": true,
  // vscode默认启用了根据文件类型自动设置tabsize的选项
  "editor.detectIndentation": false,
  "editor.formatOnSave": true,
  // 自动修复
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": "explicit"
  },
  // #让函数(名)和后面的括号之间加个空格
  "javascript.format.insertSpaceBeforeFunctionParenthesis": true,
  // #这个按用户自身习惯选择
  // "vetur.format.defaultFormatter.html": "js-beautify-html",
  "vetur.format.defaultFormatter.html": "prettier",
  // #让vue中的js按编辑器自带的ts格式进行格式化
  "vetur.format.defaultFormatter.js": "vscode-typescript",
  "vetur.format.defaultFormatterOptions": {
    "js-beautify-html": {
      "wrap_attributes": "force-aligned"
      // #vue组件中html代码格式化样式
    }
  },
  // 格式化stylus, 需安装Manta's Stylus Supremacy插件
  "stylusSupremacy.insertColons": false, // 是否插入冒号
  "stylusSupremacy.insertSemicolons": false, // 是否插入分好
  "stylusSupremacy.insertBraces": false, // 是否插入大括号
  "stylusSupremacy.insertNewLineAroundImports": false, // import之后是否换行
  "stylusSupremacy.insertNewLineAroundBlocks": false,
  "vsicons.dontShowNewVersionMessage": true,
  "launch": {
    "configurations": [],
    "compounds": []
  }, // 两个选择器中是否换行
  "editor.formatOnType": true,
  "files.autoSave": "onFocusChange",
  // 使能每一种语言默认格式化规则
  "[html]": {
    "editor.defaultFormatter": "numso.prettier-standard-vscode"
  },
  "[css]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  },
  "[less]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  },
  "[javascript]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  },
  /*  prettier的配置 */
  "prettier.printWidth": 80, // 超过最大值换行
  "prettier.tabWidth": 2, // 缩进字节数
  "prettier.useTabs": false, // 缩进不使用tab，使用空格
  "prettier.semi": true, // 句尾添加分号
  "prettier.singleQuote": true, // 使用单引号代替双引号
  "prettier.proseWrap": "always", // 默认值。因为使用了一些折行敏感型的渲染器（如GitHub comment）而按照markdown文本样式进行折行
  "prettier.arrowParens": "avoid", //  (x) => {} 箭头函数参数只有一个时是否要有小括号。avoid：省略括号
  "prettier.bracketSpacing": true, // 在对象，数组括号与文字之间加空格 "{ foo: bar }"
  "prettier.endOfLine": "auto", // 结尾是 \n \r \n\r auto
  "prettier.eslintIntegration": true, // 让prettier使用eslint的代码格式进行校验
  "prettier.htmlWhitespaceSensitivity": "ignore",
  "prettier.ignorePath": ".prettierignore", // 不使用prettier格式化的文件填写在项目的.prettierignore文件中
  "prettier.bracketSameLine": false, // 在jsx中把'>' 是否单独放一行
  "prettier.jsxSingleQuote": false, // 在jsx中使用单引号代替双引号
  "prettier.parser": "babylon", // 格式化的解析器，默认是babylon
  "prettier.requireConfig": false, // Require a 'prettierconfig' to format prettier
  "prettier.stylelintIntegration": true, // 让prettier使用stylelint的代码格式进行校验
  "prettier.trailingComma": "none", // 在对象或数组最后一个元素后面是否加逗号（在ES5中加尾逗号） none/es5/all
  "prettier.tslintIntegration": true, // 让prettier使用tslint的代码格式进行校验

  "workbench.startupEditor": "none",
  "terminal.integrated.allowMnemonics": true,
  "terminal.integrated.defaultProfile.windows": "Command Prompt",
  "php.format.rules.indentBraces": false,
  "php.format.rules.spaceWithinForParens": true,
  "php.format.rules.whileStatementNewLineBeforeRightParen": true,
  "php.format.rules.spaceWithinForeachParens": true,
  "php.format.rules.spaceWithinIfParens": true,
  "php.format.rules.spaceWithinWhileParens": true,
  "php.format.rules.switchStatementNewLineAfterLeftParen": true,
  "php.format.rules.switchStatementNewLineBeforeRightParen": true,
  "php.format.rules.whileStatementNewLineAfterLeftParen": true,
  "php.format.rules.spaceWithinDeclParens": true,
  "php.format.rules.spaceWithinExpressionParens": true,
  "php.format.rules.spaceWithinCatchParens": true,
  "files.autoSave": "onFocusChange",
  "prettier.singleQuote": true,

  //配置新建文件注释和方法注释
  "fileheader.configObj": {
    "createFileTime": true, //设置为true则为文件新建时候作为date，否则注释生成时间为date
    "autoAdd": true, //自动生成注释，老是忘记的同学可以设置
    "annotationStr": {
      "head": "/*",
      "middle": " * @",
      "end": " */",
      "use": true //设置自定义注释可用
    },
    "headInsertLine": {
      "php": 2
    }
  },
  "fileheader.cursorMode": {
    "description": "",
    "param ": "",
    "return": ""
  },
  "fileheader.customMade": {
    "Description": "", //文件内容描述
    "Author": "zhuangguobiao", //编辑人
    "Date": "Do not edit", //时间
    "LastEditTime": "Do not edit",
    "LastEditors": "zhuangguobiao",
    "LastModifiedBy": "zhuangguobiao"
  },
  "[markdown]": {
    "editor.wordWrap": "on"
  },
  "[vue]": {
    "editor.tabSize": 2,
    "editor.insertSpaces": true,
    "editor.defaultFormatter": "octref.vetur"
  },
  "[js]": {
    "editor.tabSize": 2,
    "editor.insertSpaces": true
  },
  // Enable/disable default JavaScript formatter (For Prettier)
  "javascript.format.enable": true,
  "terminal.integrated.defaultProfile.windows": "Command Prompt",
  "remote.SSH.remotePlatform": {
    "192.168.1.10": "linux",
    "腾讯云": "linux",
    "124.220.203.112": "linux",
    "119.29.251.192": "linux"
  },
  "workbench.colorTheme": "Default Dark+",
  "workbench.iconTheme": "vscode-icons",
  "window.zoomLevel": 1,
  "git.openRepositoryInParentFolders": "never",
  "[php]": {
    "editor.defaultFormatter": "chuaple.php-formatter"
  },
  "css.format.braceStyle": "expand",
  "php.format.rules.openBraceOnNewLineForBlocks": false,
  "php.format.rules.openBraceOnNewLineForLambdas": true,
  "php.format.rules.openBraceOnNewLineForFunctions": false,
  "php.format.rules.openBraceOnNewLineForNamespaces": false,
  "php.format.rules.openBraceOnNewLineForTypes": false,
  "php.format.rules.openBraceOnNewLineForAnonymousClasses": true,
  "php.format.rules.declKeepRightParenAndOpenBraceOnOneLine": false,
  "security.workspace.trust.untrustedFiles": "open",
  "remote.SSH.path": "D:\\Program Files\\Git\\usr\\bin\\ssh.exe",
  "remote.SSH.configFile": "C:\\Users\\Administrator\\.ssh\\config",
  "remote.SSH.defaultForwardedPorts": [],
  "[json]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  },
  "git.ignoreLegacyWarning": true,
  "[scss]": {
    "editor.defaultFormatter": "sasa.vscode-sass-format"
  },
  "php.format.rules.arrayInitializersWrap": "off",
  "javascript.suggest.completeFunctionCalls": true,
  "editor.wordWrap": "on",
  "vue.inlayHints.optionsWrapper": true,
  "html.format.wrapLineLength": 1,
  "editor.formatOnPaste": true
}
```

ssh配置
```SSH

```