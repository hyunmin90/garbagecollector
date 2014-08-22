<?php 
$dev_ui = json_decode(file_get_contents("./assets_dev/dev_ui.json"),true);

$footer_type = $dev_ui['footer_type'];

if($footer_type == 'img')
{
    $footer_img_path = $dev_ui['footer_img_path'];

    $image_content = file_get_contents('.'.$footer_img_path);
    $image = imagecreatefromstring($image_content);
    $footer_img_height = imagesy($image);
}
else if($footer_type == 'tag')
{
    $footer_tag = $dev_ui['footer_tag'];
}
?>
    	<?php if($footer_type == 'img'): ?>
        <div style="height:<?php echo $footer_img_height;?>px;background-image:url('<?php echo $footer_img_path.'?'.date('YmdHis');?>');background-repeat: no-repeat;"></div>
        <?php elseif($footer_type == 'tag'): ?>
            <?php echo $footer_tag;?>
        <?php endif; ?>
    </body>
</html>