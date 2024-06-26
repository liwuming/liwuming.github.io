// @ts-check
// `@type` JSDoc annotations allow editor autocompletion and type checking
// (when paired with `@ts-check`).
// There are various equivalent ways to declare your Docusaurus config.
// See: https://docusaurus.io/docs/api/docusaurus-config

import {themes as prismThemes} from 'prism-react-renderer';

/** @type {import('@docusaurus/types').Config} */
const config = {
  title:"liwuming'blog",
  tagline: 'Dinosaurs are cool',
  favicon: 'img/favicon.ico',

  // Set the production url of your site here
  url: 'https://liwuming.github.io',
  // Set the /<baseUrl>/ pathname under which your site is served
  // For GitHub pages deployment, it is often '/<projectName>/'
  baseUrl: '/',

  // GitHub pages deployment config.
  // If you aren't using GitHub pages, you don't need these.
  organizationName: 'liwuming', // Usually your GitHub org/user name.
  projectName: 'liwuming.github.io', // Usually your repo name.
  deploymentBranch:"gh-pages",
  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',

  // Even if you don't use internationalization, you can use this field to set
  // useful metadata like html lang. For example, if your site is Chinese, you
  // may want to replace "en" with "zh-Hans".
  i18n: {
    defaultLocale: 'en',
    locales: ['en'],
  },

  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: './sidebars.js',
		  sidebarCollapsed: true,
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
          customCss: './src/css/custom.css',
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      // Replace with your project's social card
      image: 'img/docusaurus-social-card.jpg',
	  
      navbar: {
        logo: {
          alt: "liwuming'blog",
          src: 'https://v7-wiki.apipost.cn/img/logo.svg',
        },
        items: [
			{type: 'doc',docId: 'js&ts/intro',position: 'left',label: 'ecma'},
			{type: 'doc',docId: 'go/intro',position: 'left',label: 'go'},
			{type: 'doc',docId: 'linux/intro',position: 'left',label: 'linux'},
			{type: 'doc',docId: 'mysql/intro',position: 'left',label: 'mysql'},
			{type: 'doc',docId: 'english/intro',position: 'left',label: 'english'},
			{to: '/blog', label: 'Blog', position: 'left'},
			{
				href: 'https://github.com/facebook/docusaurus',
				label: 'GitHub',
				position: 'right',
			},
        ],
      },
      footer: {
        style: 'dark',
        copyright: `Copyright © ${new Date().getFullYear()} ibiancheng.net, Inc. Built with Docusaurus.`,
      },
	  docs:{
		sidebar: {
		  hideable: true,
		  autoCollapseCategories: true,
		},  
	  },
      prism: {
        theme: prismThemes.github,
        darkTheme: prismThemes.dracula,
      },
    }),
};

export default config;
