<html>
<head>
	<title>User Ledger</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/inaugurate.css">
</head>
<body>
<div class='wrapper'>
	<?php 
		if (isset($errors))
		{
			echo $errors;
		}
	?>
	<div class='login'>
		<form action='/users/login/' method='post'>
			<label>Email: <input type='text' name='email'/></label>
			<label>Password: <input type='password' name='password'/></label>
			<input type='submit' value='Login'>
		</form>
	</div>
	<div class='register'>
		<form action='/users/register/' method='post'>
			<label>Name: <input type='text' name='name'/></label>
			<label>Email Address: <input type='text' name='email'/></label>
			<label>Password: <input type='password' name='password'/></label>
			<label>Confirm Password: <input type='password' name='confirm_password'/></label>
			<input type='submit' value='Register'>
		</form>
	</div>
</div>

</body>
</html>