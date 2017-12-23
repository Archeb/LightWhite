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