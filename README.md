# XIN-BLOG V1.0

一个基于 WordPress 的动漫风格博客主题，具有响应式设计、樱花飘落动画、Live2D 看板娘等特色功能。

## 功能特点

- 🎨 **动漫风格设计** - 粉色渐变主题，温馨可爱的视觉效果
- 🌸 **樱花飘落动画** - 页面背景樱花飘落效果
- 🧍 **Live2D 看板娘** - 可交互的虚拟角色
- 📱 **响应式布局** - 完美适配桌面端和移动端
- 🔍 **搜索功能** - 支持文章搜索
- 💬 **留言板** - 便利贴风格的留言功能
- 📊 **阅读进度条** - 顶部显示阅读进度
- ⬆️ **返回顶部** - 一键返回页面顶部

## 技术栈

- **框架**: WordPress 6.x+
- **语言**: PHP, HTML5, CSS3, JavaScript
- **样式**: Flexbox, Grid Layout
- **图标**: Font Awesome 6
- **动画**: CSS Animations, JavaScript
- **Live2D**: Cubism SDK

## 快速开始

### 安装要求

- WordPress 6.0 或更高版本
- PHP 7.4 或更高版本
- MySQL 5.6 或更高版本

### 安装步骤

1. **下载主题**
   ```bash
   git clone https://github.com/your-username/XIN-BLOGV1.0.git
   ```

2. **上传主题**
   - 将 `XIN-BLOGV1.0` 文件夹上传到 WordPress 的 `wp-content/themes/` 目录
   - 或通过 WordPress 后台 → 外观 → 主题 → 添加新主题 → 上传主题

3. **激活主题**
   - 在 WordPress 后台 → 外观 → 主题
   - 找到 "XIN-BLOG" 主题并点击激活

4. **配置主题**
   - 在 WordPress 后台 → 外观 → 自定义
   - 根据需要配置网站标题、菜单、小工具等

## 目录结构

```
XIN-BLOGV1.0/
├── assets/              # 静态资源
│   ├── css/             # 样式文件
│   │   ├── archive.css  # 归档页面样式
│   │   ├── components.css # 组件样式
│   │   └── single.css   # 文章详情样式
│   └── js/              # JavaScript 文件
│       └── main.js      # 主脚本文件
├── live2d/              # Live2D 相关文件
│   ├── css/             # Live2D 样式
│   ├── js/              # Live2D 脚本
│   └── model/           # Live2D 模型
├── picture/             # 图片资源
│   ├── avator.png       # 头像图片
│   └── backdrop.jpg     # 背景图片
├── archive.php          # 归档页面模板
├── comments.php         # 评论模板
├── footer.php           # 页脚模板
├── front-page.php       # 首页模板
├── functions.php        # 主题函数
├── header.php           # 页头模板
├── index.php            # 默认模板
├── page-about.php       # 关于页面模板
├── page-message-board.php # 留言板页面模板
├── preview.html         # 主题预览页面
├── search.php           # 搜索页面模板
├── single.php           # 文章详情模板
├── style.css            # 主样式文件
└── HOW_TO_USE.md        # 使用说明
```

## 使用说明

### 预览主题

打开 `preview.html` 文件可以直接预览主题效果，无需安装 WordPress。

### 自定义菜单

1. 在 WordPress 后台 → 外观 → 菜单
2. 创建新菜单并添加菜单项
3. 将菜单分配到 "主菜单" 位置

### 添加小工具

1. 在 WordPress 后台 → 外观 → 小工具
2. 将小工具拖放到侧边栏区域

### Live2D 看板娘

主题已集成 Live2D 看板娘，默认显示在页面右下角。如需自定义，请修改 `live2d/` 目录下的相关文件。

## 主题特色

### 首页功能
- 全屏封面展示
- 波浪动画效果
- 文章卡片列表
- 分页导航

### 文章页面
- 目录导航
- 代码高亮
- 作者信息展示
- 相关文章推荐
- 文章导航（上一篇/下一篇）

### 留言板
- 便利贴风格设计
- 支持拖拽定位
- 点击展开/收起

## 浏览器支持

- Chrome (推荐)
- Firefox
- Safari
- Edge
- Opera

## 许可证

GNU General Public License v2 or later

## 作者

**随心3** - [GitHub](https://github.com/your-username)

## 贡献

欢迎提交 Issue 和 Pull Request！

## 更新日志

### v1.0.0
- 初始版本发布
- 实现基本博客功能
- 添加樱花动画效果
- 集成 Live2D 看板娘
- 响应式设计完成
