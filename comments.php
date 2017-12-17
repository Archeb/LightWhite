<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<script type="text/javascript">
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('respond-<?php echo ($this->is('post')) ? 'post' : 'page'; ?>-<?php $this->cid(); ?>'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = this.dom('respond-<?php echo ($this->is('post')) ? 'post' : 'page'; ?>-<?php $this->cid(); ?>'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
 
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div class="comment-element" id="<?php $comments->theId(); ?>">
        <div class="comment-container">
            <div class="comment-author-avatar">
                <a target="_blank" href="<?php echo $comments->url; ?>"><?php $comments->gravatar('55', ''); ?></a>
            </div>
            <div class="comment-author-info">
                <div class="comment-meta">
                    <span class="comment-author-name"><?php echo $comments->author(); ?></span><a class="comment-time" href="<?php $comments->permalink(); ?>"><?php echo $comments->date('Y-m-d H:i'); ?></a><a class="comment-reply" onclick="TypechoComment.reply('<?php $comments->theId(); ?>', <?php echo explode("-",$comments->theId)[1]; ?>);"><span class="mdi mdi-reply"></span></a> 
                </div>
                <div class="comment-content">
                    <?php $comments->content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>

<div id="comments">
    <h3 id="comments-head"><span class="mdi mdi-comment-multiple-outline"></span> <?php _e('评论'); ?></h3>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
    	<div class="warning_tip">发送失败 可能是您的发言太频繁或联系方式有误</div>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
    	    <div class="comment-info mdi">
                <?php if($this->user->hasLogin()): ?>
        		<p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
        		<input type="hidden" name="author" value="博主(刷新可见)"/>
    			<input type="hidden" name="mail" value="" />
    			<input type="hidden" name="url" value="<?php $this->options->siteUrl(); ?>" />
                <?php else: ?>
    			<span class="mdi mdi-account"></span><input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" placeholder="<?php _e('称呼'); ?>" required />
    			<span class="mdi mdi-email"></span><input type="email" name="mail" id="mail" class="text" placeholder="<?php _e('Email'); ?>" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
    			<span class="mdi mdi-home-outline"></span><input type="url" name="url" id="url" class="text" placeholder="<?php _e('网站'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                <?php endif; ?>
            </div>
    		<p>
                <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" placeholder="快来写下成为女装大佬的宣言吧！" required ><?php $this->remember('text'); ?></textarea>
            </p>
    		<p style="display: flex;flex-direction: row-reverse;">
    		    <input type="hidden" name="_" value="<?php echo $this->security->getToken($this->permalink) ?>" />
    		<p align="right">
    		    <?php $comments->cancelReply(); ?>
                <a class="submit" id="submit-comment" type="submit" class="submit"><span class="mdi mdi-send"></span> <?php _e('提交评论'); ?></a>
                
            </p>
            
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
