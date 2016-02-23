<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>FlashDrive - The UPLB-OVCCA Jeepney Drivers Database</title>
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css"/>
		<link rel="icon" type="image/gif" href="<?php echo base_url();?>images/favicon.ico"/>
		<!--<script src="http://jquery.com/src/jquery.js"></script>-->
		<script src="<?php echo base_url();?>/js/jquery.js"></script>
		<script>
			$(document).ready(function(){
				$("dd:not(:first)").hide();
				$("dt a").click(function(){
					$("dd:visible").slideUp("slow");
					$(this).parent().next().slideDown("slow");
					return false;
				});
			});
		</script>

	</head>
	<body>
		<div id="header" name="top">
			<a href="<?php echo base_url();?>index.php/main/"><img src="<?php echo base_url();?>images/logo.png" /></a>
		</div>
		<table cellspacing="0px" cellpadding="0px">
			<tr>
				<td id="sidebar">
					<div class = "menu">
					
<?php 
	date_default_timezone_set('Asia/Manila');
?>