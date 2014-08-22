<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Daum Developers</title>
        <link rel="stylesheet" href="<?php echo JS_DIR;?>/bootstrap.min.css">
        <script type="text/javascript" src="http://s1.daumcdn.net/svc/original/U03/cssjs/jquery/jquery-2.1.1.min.js"></script>
        <script src="<?php echo JS_DIR;?>/libs/handlebars-1.0.0.js"></script>
        <script src="<?php echo JS_DIR;?>/libs/ember-1.0.0-rc.8.js"></script>
        <script src="<?php echo JS_DIR;?>/bootstrap.js"></script>
        <?php if(isset($add_headers)): ?>
        <?php foreach($add_headers as $header_item):?>
        <?php echo $header_item; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body>
        <?php if($header_type == 'img'): ?>
        <div style="height:<?php echo $header_img_height;?>px;background-image:url('<?php echo $header_img_path;?>');"></div>
        <?php elseif($header_type == 'tag'): ?>
            <?php echo $header_tag;?>
        <?php endif; ?>


        <?php if($footer_type == 'img'): ?>
        <div style="height:<?php echo $footer_img_height;?>px;background-image:url('<?php echo $footer_img_path;?>');"></div>
        <?php elseif($footer_type == 'tag'): ?>
            <?php echo $footer_tag;?>
        <?php endif; ?>
    </body>
</html>