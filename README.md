# LightWhite
### 一个Typecho单栏主题

这个主题叫做LightWhite，还在继续完善中。

目前还有一些小组件待加入，希望有大佬移植到WordPress上让更多人能用到

预览站点：https://qwq.moe/

### 主题特点

- **响应式单栏主题** 反正响应式现在已经是标配了吧
- **预览图** GitHub版本暂未更新 后面会跟着音乐组件一起加
- **pjax** 标配，不多BB，而且还是不平衡不充分发展的(笑)，修复预定
- **代码高亮** 还是标配...唉都是标配我写出来干嘛（凑字数
- **友链样式模板** 反正我觉得做的还是可以的，用法直接参考 https://qwq.moe/links.html 的HTML结构就行
- **ajax加载继续阅读** 少女折寿中...可以让访客无需离开文章列表页就读完文章，也可以评论，我觉得挺方便

### 使用说明

- 修改博客已运行时间 请到o.js:4把1419043380000改为你开始时间的毫秒数 http://tool.chinaz.com/Tools/unixtime.aspx 记得选毫秒
- 请到img目录中修改你希望修改的顶部图片，按我原来的比例，分辨率建议不低于原图
- 友链有单独样式
    
      <div class="friends">
        <a class="a-friend" target="_blank" style="background-color:背景颜色;color:前景颜色" href="博客链接">
          <img class="blog-avatar" src="博客头像地址" />
          <div class="text-container">
            <div class="name">博客名字</div>
            <div class="description">博客描述</div></div>
        </a>
        <!-- 在此区域内重复上面的即可 -->
      </div>

### 自定义字段说明

| 字段名       | 字段值               | 输入示例             | 备注                                             |
|--------------|----------------------|----------------------|--------------------------------------------------|
| previewImage | 文章封面预览图的地址 | http://xxx.xxx/a.jpg |                                                  |
| icon         | MDI图标类名          | mdi-xxxx             | **仅适用于独立页面** 参考 https://cdn.materialdesignicons.com/2.0.46/ |

### 注意事项

- 请到js/o.js中修改或删除我的百度统计代码，并建议修改footer.php中的部分内容（我是说Powered By xxx那些 愿意支持我的请不要删掉版权）
- 请到 设置-评论 中关闭\[检查评论来源页URL\]和\[开启反垃圾保护\] 否则首页的继续阅读无法正常评论
- APlayer虽然引用了但是样式还没写好所以注释掉了 别盲目去除注释，不然很丑...到时候写好了会更新
- 截至v1.1暂未支持文章密码（懒+忘了），**有加密文章的慎用**

### 引用和感谢

- Pjax https://github.com/MoOx/pjax 非常强大的Pjax组件，无依赖，自动识别更改
- highlight.js https://highlightjs.org/ 代码高亮，大家都懂，主题用的是vs2015
- Animate.css https://daneden.github.io/animate.css/ 又是一个人尽皆知的css，挺好用的，虽然只用到了一个效果，后面release了主题会考虑压缩一下
- Material Design Icons https://materialdesignicons.com/ 用MDI图标的感觉，比用官方好多了！用了MDI个个都好看，数量又多，我超喜欢用MDI的！
