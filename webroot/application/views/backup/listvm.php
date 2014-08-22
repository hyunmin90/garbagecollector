<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Welcome to whycle.</title>

                            
		<!-- Font Awesome Stylesheet -->
		<link rel="stylesheet" href="<?php echo asset_url();?>font-awesome/css/font-awesome.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/styles.css">
		<!-- Including Open Sans Condensed from Google Fonts -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic" />
		<link href="<?php echo asset_url();?>/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">

                             </head>
                               <body onload="javascript:listvm()">
                                <div id="listform">  
                                <div class ="well">vm list</div>
                                <div id="vm"></div>
                                <div id="vmdetail"></div>
                                </div>



        <!-- BSA AdPacks code. Please ignore and remove.--> 
        <script src="<?php echo asset_url();?>js/jquery-1.8.2.min.js"></script>
        <script src="<?php echo asset_url();?>js/libs/jquery-1.9.1.js"></script>
        <script src="<?php echo asset_url();?>js/libs/handlebars-1.0.0.js"></script>
        <script src="<?php echo asset_url();?>js/libs/ember-1.0.0-rc.8.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/showdown/0.3.1/showdown.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>
        <script src="<?php echo asset_url();?>js/listVMscript.js"></script>
        <script src="<?php echo asset_url();?>js/createVMscript.js"></script>
        <script src="<?php echo asset_url();?>js/bootstrap.js"></script>
    
    </body>
</html>