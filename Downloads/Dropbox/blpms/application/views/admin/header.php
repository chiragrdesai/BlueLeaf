<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<link id="bs-css" href="<?php echo base_url(); ?>assets/css/bootstrap-cerulean.min.css" rel="stylesheet">
	<link id="bs-css" href="<?php echo base_url(); ?>admin/style" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/charisma-app.css" rel="stylesheet">
    <link href='<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?php echo base_url(); ?>assets/bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/jquery.noty.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/noty_theme_default.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/elfinder.min.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/elfinder.theme.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/uploadify.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/animate.min.css' rel='stylesheet'>
    <link href='<?php echo base_url(); ?>assets/css/colpick.css' rel='stylesheet'>
	
	<link href='<?php echo base_url(); ?>assets/css/datepicker.css' rel='stylesheet'>
	
	
    <meta name="viewport" content="width=device-width">
    <?php if(isset($showfavicon[0]->variable_value)) { ?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?><?php echo $showfavicon[0]->variable_value ; ?> ">
    <?php } else { ?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
    <?php }  ?>
    
     
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/jquery.min.js"></script>    
    <script src="//code.jquery.com/jquery-1.11.1.min.js" ></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
 </head>
 
 
<body style ="font-size:<?php echo $font_size[0]->variable_value; ?>px;font-family:<?php echo $site_font[0]->variable_value; ?>">

	<div class="ch-container">
		<div class="row">  
