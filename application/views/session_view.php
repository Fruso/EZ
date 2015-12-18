<html>
<head>
<title>Session View Page</title>
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="main">
<div id="note"><span><b>Note : </b></span> In this DEMO we gives you functionality to set your own session value. </div>
<div class="message">
<?php
if (isset($read_set_value)) {
echo $read_set_value;
}
if (isset($message_display)) {
echo $message_display;
}
?>
</div>

<div id="show_form">
	<h2>CodeIgniter Session Demo</h2>
	<?php echo form_open('session_tutorial/set_session_value'); ?>
	<div class='error_msg'>
	<?php echo validation_errors(); ?>
	</div>
	<?php echo form_label('Enter a session value :');?>
	<input type="text" name="session_value" />
	<input type="submit" value="Set Session Value" id='set_button'/>
	<?php echo form_close(); ?>

	<?php echo form_open('session_tutorial/read_session_value'); ?>
	<input type="submit" value="Read Session Value" id="read_button" />
	<?php echo form_close(); ?>

	<?php echo form_open('session_tutorial/unset_session_value'); ?>
	<input type="submit" value="Unset Session Value" id="unset_button" />
	<?php echo form_close(); ?>
</div>
</div>
</body>
</html>