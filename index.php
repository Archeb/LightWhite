<?php
/**
 * LightWhite
 * 
 * @package LightWhite
 * @author Archeb @ iDea Leaper
 * @version 1.0.0
 * @link https://qwq.moe/
 */
 
if (!defined('__TYPECHO_ROOT_DIR__'))
	exit ;


$this -> need('header.php');
?>
<div class="article-list">
    <?php while($this->next()): ?>
    <div class="article">
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
            <div class="go-comment">
                <span class="mdi mdi-comment-outline"></span>
            </div>
            <div class="go-share">
                <span class="mdi mdi-share-variant"></span>
            </div>
        </div>
        <div class="article-main">
            <div class="article-title">
                <a href="<?php $this->permalink() ?>">
            <?php $this->title(); ?></a>
                <div class="article-meta">
                    <span class="mdi mdi-account-edit"></span> <?php $this->author(); ?>
                    &nbsp;<span class="mdi mdi-tag"></span> <?php echo implode(", ",array_map(function($v){return $v['name'];},$this->categories)) ?>
                </div>
            </div>
            <div class="article-content" id="tr-<?php echo $this->cid ?>">
                            <?php $this->content('继续阅读'); ?>
            </div>
            <div class="article-comment">
                
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <?php $this->pageNav('', ''); ?>
</div>
	<?php $this -> need('footer.php'); ?>