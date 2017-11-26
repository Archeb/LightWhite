<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
	exit ;
$this -> need('header.php');
?>
<div class="article-list">
    <div class="archive-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'    =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></div>
    <?php if ($this->have()): ?>
    <?php while($this->next()): ?>
    <div class="article">
        <a href="<?php $this->permalink() ?>"><div class="title">
            <?php $this->title(); ?>
        </div></a>
        <?php if (isset($this->fields->previewImage)): ?>
		<a href="<?php $this->permalink() ?>"><div class="preview-image-container"><div class="preview-image" style="background-image:url(<?php $this->fields->previewImage(); ?>)"></div></div></a>
		<?php endif; ?>
		<div class="meta">
            <div class="group">
                <div class="text">
                <?php $this->author(); ?> / <?php $this->date(); ?> / <?php $this->commentsNum(); ?> Comments
                </div>
            </div>
            <div class="group group_action">
                <a href=""><div class="item">
                    <i class="material-icons">thumb_up</i>
                    <div class="tip_text">点赞</div>
                </div></a>
                <a href=""><div class="item">
                    <i class="material-icons">share</i>
                    <div class="tip_text">分享</div>
                </div></a>
                <a href="<?php $this->permalink() ?>"><div class="item">
                    <i class="material-icons">play_arrow</i>
                    <div class="tip_text">阅读</div>
                </div></a>
            </div>
        </div>
        <div class="content">
            <?php $this->content(); ?>
        </div>
        
    </div>
    <?php endwhile; ?>
    
    <div class="page_nav">
    <?php if($this->_currentPage > 1) {
	echo '<a class="page_prev" href="' .str_replace("{page}",$this->_currentPage - 1,Typecho_Router::url($this->parameter->type .
    (false === strpos($this->parameter->type, '_page') ? '_page' : NULL),
    $this->_pageRow, $this->options->index)). '"><i class="material-icons">chevron_left</i></a>';
	}?>
	
	<?php if($this->_currentPage < ceil($this->getTotal() / $this->parameter->pageSize)) {
	echo '<a class="page_next" href="' .str_replace("{page}",$this->_currentPage + 1,Typecho_Router::url($this->parameter->type .
    (false === strpos($this->parameter->type, '_page') ? '_page' : NULL),
    $this->_pageRow, $this->options->index)). '"><i class="material-icons">chevron_right</i></a>';
	}?>
	</div>
	
	<?php else: ?>
            
    <?php endif; ?>
</div>


	<?php $this -> need('footer.php'); ?>