<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<!DOCTYPE HTML>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
	<link rel="stylesheet/less" href="<?php $this->options->themeUrl('css/w.less'); ?>">
	<script src="<?php $this->options->themeUrl('js/less.min.js'); ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php $this->options->themeUrl('js/pjax.js'); ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php $this->options->themeUrl('js/o.js'); ?>" type="text/javascript" charset="utf-8"></script>
	<script src="https://cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
	<link href="https://cdn.bootcss.com/highlight.js/9.12.0/styles/vs2015.min.css" rel="stylesheet">
	<link href="https://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
	<script>
	    hljs.initHighlightingOnLoad();
	    new Pjax({ selectors: [".article-list"] });
	</script> 
	<link href="<?php $this->options->themeUrl('css/materialdesignicons.min.css'); ?>" media="all" rel="stylesheet" type="text/css" />
</head>
<?php if(!$this->is('index')): ?>
<style>
    .cover{
        height:200px;
        padding-top:20px;
    }
    .cover-filter{
        height:200px;
    }
</style>
<?php endif; ?>
<body>
    <div class="cover-filter"></div>
    <div class="cover">
        <div class="middle animated fadeInUp">
            <div class="info">
                <div class="avatar"><img src="https://gravatar.cat.net/avatar/93f5d0e297fe1c30eb4cf540e214523a?s=100&r=X&d=mm"></div>
                <div class="texts">
                    <div class="title"><?php $this->options->title(); ?></div>
                    <div class="description"><?php $this->options->description(); ?></div>
                </div>
            </div>
            <div class="nav">
                <a class="item" href="<?php $this->options->siteUrl(); ?>">主页</a>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                <div class="dot">&nbsp;·&nbsp;</div><a class="item" href="<?php $pages->permalink(); ?>">
                    <?php $pages->title(); ?></a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>