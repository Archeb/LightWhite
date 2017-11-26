<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="side_nav">

<div class="widgets" id="secondary" role="complementary">
    <div class="widget">
		<div class="widget-title"><div class="_text_left"><?php _e('最新文章'); ?></div></div>
        <div class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Recent')
            ->parse('<div class="list-item"><a href="{permalink}">{title}</a></div>'); ?>
        </div>
    </div>
    <div class="widget">
		<div class="widget-title"><div class="_text_left"><?php _e('最近回复'); ?></div></div>
        <div class="widget-list">
        <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
        <?php while($comments->next()): ?>
            <div class="list-item"><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></div>
        <?php endwhile; ?>
        </div>
    </div>

    <div class="widget">
		<div class="widget-title"><div class="_text_left"><?php _e('分类'); ?></div></div>
        <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
	</div>

    <div class="widget">
		<div class="widget-title"><div class="_text_left"><?php _e('归档'); ?></div></div>
        <div class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
            ->parse('<div class="list-item"><a href="{permalink}">{date}</a></div>'); ?>
        </div>
	</div>

	<div class="widget">
		<div class="widget-title"><div class="_text_left"><?php _e('其它'); ?></div></div>
        <div class="widget-list">
            <?php if($this->user->hasLogin()): ?>
				<div class="list-item"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></div>
                <div class="list-item"><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></div>
            <?php else: ?>
                <div class="list-item"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></div>
            <?php endif; ?>
            <div class="list-item"><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></div>
            <div class="list-item"><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></div>
            <div class="list-item"><a href="http://www.typecho.org">Typecho</a></div>
        </div>
	</div>

</div><!-- end #sidebar -->
</div>