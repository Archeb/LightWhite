<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
	exit ;

if (isset($_GET['ajaxload'])){
    $this->content('继续阅读');
    $this->need('comments.php');
    die();
}

$this -> need('header.php');
?>
<div class="article-list">
    <?php while($this->next()): ?>
    <div class="article singlepage">
        <div class="tooltip">
            <div class="date">
                <div class="day"><?php echo $this->date->format('d'); ?></div>
                <div class="month"><?php echo substr($this->date->format('F'),0,3); ?></div>
            </div>
            
            <div class="article-mobile-title">
                <a href="<?php $this->permalink() ?>">
            <?php $this->title(); ?></a>
            </div>
            <div class="font-control" onclick="biggerFont('tr-<?php echo $this->cid ?>')">
                <span class="mdi mdi-format-annotation-plus"></span>
            </div>
            <a href="#comments"><div class="go-comment">
                <span class="mdi mdi-comment-outline"></span>
            </div></a>
            <div class="go-share">
                <span class="mdi mdi-share-variant"></span>
            </div>
        </div>
        <div class="article-main">
           <?php if (isset($this->fields->previewImage)): ?>
    		<a pjax href="<?php $this->permalink() ?>">
    		    <div class="preview-image-container">
    		        <div class="preview-image" style="background-image:url(<?php $this->fields->previewImage(); ?>)"></div>
    		        <div class="preview-image-title">
    		            <div class="preview-image-title-content"><?php $this->title(); ?></div>
        		        <div class="preview-image-meta">
                            <span class="mdi mdi-account-edit"></span> <?php $this->author(); ?>
                            &nbsp;<span class="mdi mdi-tag"></span> <?php echo implode(", ",array_map(function($v){return $v['name'];},$this->categories)) ?>
                        </div>
                    </div>
    		        
                </div>
            </a>
    		<?php else: ?>
            <div class="article-title">
                <a pjax href="<?php $this->permalink() ?>">
            <?php $this->title(); ?></a>
                <div class="article-meta">
                    <span class="mdi mdi-account-edit"></span> <?php $this->author(); ?>
                    &nbsp;<span class="mdi mdi-tag"></span> <?php echo implode(", ",array_map(function($v){return $v['name'];},$this->categories)) ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="article-content" id="tr-<?php echo $this->cid ?>">
                            <?php $this->content('继续阅读'); ?>
            </div>
            <div class="article-comment">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>
	<?php $this->need('footer.php'); ?>