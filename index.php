<?php
/**
 * LightWhite
 * 使用前请到 设置-评论 中关闭[检查评论来源页URL]和[开启反垃圾保护]
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
    <?php while($this->next()): 
    global $isShuoshuo;
    $isShuoshuo=false;
    array_map(function($v){global $isShuoshuo;if($v['name']=="说说"){$isShuoshuo=true;};},$this->categories);
    if($isShuoshuo===true){ ?>
    <div class="shuoshuo">
        <div class="shuoshuo-meta">
        <style>
        .shuoshuo-meta:before {
            content: '<?php $this->date('F jS , Y'); ?>';
        }
        </style>
            
        </div>
        <div class="shuoshuo-container">
            <div class="author-info">
                <?php $this->author->gravatar(50); ?>
            </div>
            <div class="content-container">
                <div class="content">
                    <a pjax href="<?php $this->author->permalink(); ?>">@<?php $this->author(); ?></a>：<?php echo $this->excerpt; ?>
                </div>
                <div class="comments"></div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <div class="article">
        <div class="tooltip">
            <div class="date">
                <div class="day"><?php echo $this->date->format('d'); ?></div>
                <div class="month"><?php echo substr($this->date->format('F'),0,3); ?></div>
            </div>
            <?php if (!$this->fields->previewImage): ?>
            <div class="article-mobile-title">
                <a pjax href="<?php $this->permalink() ?>">
            <?php $this->title(); ?></a>
            </div>
            <?php endif; ?>
            <div class="font-control" onclick="biggerFont('tr-<?php echo $this->cid ?>')">
                <span class="mdi mdi-format-annotation-plus"></span>
            </div>
            <div class="go-comment">
                <span class="mdi mdi-comment-outline"></span>
            </div>
            <div class="go-share">
                <span class="mdi mdi-share-variant"></span>
            </div>
            <div class="go-tip">
                <span class="mdi mdi-coin"></span>
            </div>
        </div>
        <div class="article-main">
            <?php if ($this->fields->previewImage && $this->fields->previewImage!==""): ?>
            
    		<a pjax href="<?php $this->permalink() ?>">
    		    <div class="preview-image-container">
    		        <div class="preview-image" style="background-image:url(<?php $this->fields->previewImage(); ?>)"></div>
    		        <div class="preview-image-title">
    		            <div class="preview-image-title-content"><?php $this->title(); ?></div>
        		        <div class="preview-image-meta">
                            <span class="mdi mdi-account-edit"></span> <?php $this->author(); ?>
                            &nbsp;<span class="mdi mdi-tag"></span> <?php array_map(function($v){echo '<a pjax href="'.$v['permalink'].'"class="tag-item">'.$v['name'].'</a>';},$this->categories) ?>
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
                            <?php 
                            echo $this->excerpt;
                            if(strpos($this->text, '<!--more-->')){
                                echo "<p class=\"more\"><a href=\"{$this->permalink}\" class=\"mdi\" title=\"{$this->title}\"> 继续阅读</a></p>";
                            }else{
                                echo "<p class=\"more\"><a href=\"{$this->permalink}\" class=\"mdi\" title=\"{$this->title}\"> 展开评论</a></p>";
                            }
                            ?>
            </div>
            <div class="article-comment">
                
            </div>
        </div>
    </div>
    <?php } endwhile; ?>
    <?php $this->pageNav('', ''); ?>
</div>
	<?php $this -> need('footer.php'); ?>