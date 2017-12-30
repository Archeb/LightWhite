<?php 
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('words', 'entry');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('words', 'entry');
class words {
    public static function entry()
    {
    ?>
<style>
.field.is-grouped{margin-top:10px;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;  -ms-flex-wrap: wrap;flex-wrap: wrap;}.field.is-grouped>.control{-ms-flex-negative:0;flex-shrink:0}.field.is-grouped>.control:not(:last-child){margin-bottom:.5rem;margin-right:.75rem}.field.is-grouped>.control.is-expanded{-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;-ms-flex-negative:1;flex-shrink:1}.field.is-grouped.is-grouped-centered{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.field.is-grouped.is-grouped-right{-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.field.is-grouped.is-grouped-multiline{-ms-flex-wrap:wrap;flex-wrap:wrap}.field.is-grouped.is-grouped-multiline>.control:last-child,.field.is-grouped.is-grouped-multiline>.control:not(:last-child){margin-bottom:.75rem}.field.is-grouped.is-grouped-multiline:last-child{margin-bottom:-.75rem}.field.is-grouped.is-grouped-multiline:not(:last-child){margin-bottom:0}.tags{-webkit-box-align:center;-ms-flex-align:center;align-items:center;display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.tags .tag{margin-bottom:.5rem}.tags .tag:not(:last-child){margin-right:.5rem}.tags:last-child{margin-bottom:-.5rem}.tags:not(:last-child){margin-bottom:1rem}.tags.has-addons .tag{margin-right:0}.tags.has-addons .tag:not(:first-child){border-bottom-left-radius:0;border-top-left-radius:0}.tags.has-addons .tag:not(:last-child){border-bottom-right-radius:0;border-top-right-radius:0}.tag{-webkit-box-align:center;-ms-flex-align:center;align-items:center;background-color:#f5f5f5;border-radius:3px;color:#4a4a4a;display:-webkit-inline-box;display:-ms-inline-flexbox;display:inline-flex;font-size:.75rem;height:2em;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;line-height:1.5;padding-left:.75em;padding-right:.75em;white-space:nowrap}.tag .delete{margin-left:.25em;margin-right:-.375em}.tag.is-white{background-color:#fff;color:#0a0a0a}.tag.is-black{background-color:#0a0a0a;color:#fff}.tag.is-light{background-color:#fff;color:#363636}.tag.is-dark{background-color:#363636;color:#f5f5f5}.tag.is-primary{background-color:#00d1b2;color:#fff}.tag.is-info{background-color:#3273dc;color:#fff}.tag.is-success{background-color:#23d160;color:#fff}.tag.is-warning{background-color:#ffdd57;color:rgba(0,0,0,.7)}.tag.is-danger{background-color:#ff3860;color:#fff}.tag.is-large{font-size:1.25rem}.tag.is-delete{margin-left:1px;padding:0;position:relative;width:2em}.tag.is-delete:after,.tag.is-delete:before{background-color:currentColor;content:"";display:block;left:50%;position:absolute;top:50%;-webkit-transform:translateX(-50%) translateY(-50%) rotate(45deg);transform:translateX(-50%) translateY(-50%) rotate(45deg);-webkit-transform-origin:center center;transform-origin:center center}.tag.is-delete:before{height:1px;width:50%}.tag.is-delete:after{height:50%;width:1px}.tag.is-delete:focus,.tag.is-delete:hover{background-color:#e8e8e8}.tag.is-delete:active{background-color:#dbdbdb}.tag.is-rounded{border-radius:290486px}
</style>
<script>
    
</script>
<script>
var isComposing=false;
document.addEventListener('DOMContentLoaded',function(){
    var statDiv = document.createElement("div");
    statDiv.className="field is-grouped";
    statDiv.innerHTML='<span class="tag">统计：</span><div class="control"><div class="tags has-addons"><span class="tag is-light" id="words-stat">0</span> <span class="tag is-danger">个文字</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-light" id="pics-stat">0</span> <span class="tag is-info">张图片</span></div></div>';
    document.querySelector('#tab-advance').appendChild(statDiv);
    document.querySelector('#wmd-editarea textarea').addEventListener('keyup',handleStat);
    document.querySelector('#wmd-editarea textarea').addEventListener('compositionstart',function(){isComposing=true;});
    document.querySelector('#wmd-editarea textarea').addEventListener('compositionend',function(){isComposing=false;});
});
function handleStat(){
    if(!isComposing){
        document.querySelector('#words-stat').innerHTML=document.querySelector('#wmd-preview').textContent.length;
        document.querySelector('#pics-stat').innerHTML=document.querySelector('#wmd-preview').querySelectorAll('span.cache').length;
    }
}
</script>
<?php
    }
}
?>

<?php
function themeFields($layout) {
    ?>
    <style>
    #custom-field input{
        width:100%;
    }
    </style>
    <?php
    $previewImage = new Typecho_Widget_Helper_Form_Element_Text('previewImage', NULL, NULL, "文章封面图", "在此填入一个图片地址以显示文章封面图，留空不显示");
    $layout->addItem($previewImage);
    if($_SERVER['SCRIPT_NAME']=="/admin/write-page.php"){
        $icon = new Typecho_Widget_Helper_Form_Element_Text('icon', NULL, NULL, "图标", "在此填入MDI图标类名，将会显示在导航栏中。<a href=\"https://cdn.materialdesignicons.com/2.0.46/\">类名参考</a>");
    $layout->addItem($icon);
    }
}