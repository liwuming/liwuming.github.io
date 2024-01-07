// @ts-check
// Note: type annotations allow type checking and IDEs autocompletion


/*
D:\ONE\NODE_MODULES\PRISM-REACT-RENDERER\THEMES
├─dracula
├─duotoneDark
├─duotoneLight
├─github
├─nightOwl
├─nightOwlLight
├─oceanicNext
├─okaidia
├─palenight
├─shadesOfPurple
├─synthwave84
├─ultramin
├─vsDark
└─vsLight
*/
const lightCodeTheme = require('prism-react-renderer/themes/github');
const darkCodeTheme = require('prism-react-renderer/themes/dracula');
/** @type {import('@docusaurus/types').Config} */
const config = {
  title: "liwuming",
  tagline: 'Dinosaurs are cool',
  favicon: 'img/favicon.ico',
  // Set the production url of your site here
  url: 'https://liwuming.github.io',
  // Set the /<baseUrl>/ pathname under which your site is served
  // For GitHub pages deployment, it is often '/<projectName>/'
  baseUrl: '/',
  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',
  
  // GitHub pages deployment config.
  // If you aren't using GitHub pages, you don't need these.
  organizationName: 'liwuming', // Usually your GitHub org/user name.
  projectName: 'liwuming.github.io', // Usually your repo name.
  deploymentBranch:'gh-pages',
  trailingSlash:false,
  
  // Even if you don't use internalization, you can use this field to set useful
  // metadata like html lang. For example, if your site is Chinese, you may want
  // to replace "en" with "zh-Hans".
  /*i18n: {
    defaultLocale: 'en',
    locales: ['en'],
  },
  */
  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: require.resolve('./sidebars.js'),
          // Please change this to your repo.
          // Remove this to remove the "edit this page" links.
          editUrl:
            'https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/',
        },
        blog: {
          showReadingTime: true,
          // Please change this to your repo.
          // Remove this to remove the "edit this page" links.
          editUrl:
            'https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/',
        },
        theme: {
          customCss: require.resolve('./src/css/custom.css'),
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      // Replace with your project's social card
      image: 'img/docusaurus-social-card.jpg',
	  docs:{
		 sidebar:{
			hideable: true,
			autoCollapseCategories: true,
		 }
	  },
      navbar: {
        title: "爱编程",
        logo: {
          alt: 'My Site Logo',
          src: 'img/logo.svg',
        },
        items: [
		  {
            type: 'doc',
            docId: 'web/intro',
            position: 'left',
            label: 'ecma',
          },
		  {
            type: 'doc',
            docId: 'java/intro',
            position: 'left',
            label: 'java',
          },
		  
		  {
            type: 'doc',
            docId: 'database/intro',
            position: 'left',
            label: '数据库',
          },
		  {
            type: 'doc',
            docId: 'algorithms/intro',
            position: 'left',
            label: '数据结构与算法',
          },
		  {
            type: 'doc',
            docId: 'economist/intro',
            position: 'left',
            label: '英语学习',
          },
          {to: '/blog', label: 'Blog', position: 'left'},
		  
		  
		   {
			to: '/',
            label: "💼 首页",
            position: "right",
          },
		  {
            position: "right",
            label: "💼 web前端",
            items: [
              {
                label: "es6",
				to: "/docs/web/es6入门到起飞/intro",
              },
              {
                label: "vue3",
                to: "/docs/web/vue3学习手册/intro",
              },
              {
                label: "react",
                to: "/docs/web/react学习手册/intro",
              }
            ]
          },
		  {
            to: '/docs/books/intro',
            label: "💼 读过的书",
			items: [
              {
                label: "被讨厌的勇气",
                to: "/docs/books/被讨厌的勇气/intro",
              },
              {
                label: "金字塔原理",
                to: "/docs/books/金字塔原理/intro",
              }
            ],
            position: "right",
          },
		  {
            href: 'https://github.com/facebook/docusaurus',
            label: 'GitHub',
            position: 'right',
          },
        ],
      },
      prism: {
        theme: lightCodeTheme,
        darkTheme: darkCodeTheme,
		additionalLanguages: ['java','nginx','php','javascript','go','markdown'],
      },
    }),
};

module.exports = config;
