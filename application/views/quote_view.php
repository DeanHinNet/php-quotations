<!DOCTYPE html>
<html lang='en'>
<head>
	<meta char='UTF-8'>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../assets/css/quotes.css">
</head>
<body>
<div class='wrapper'>
	<div class='header'>
		<h1>Welcome, <?=$name?>!</h1>
		<a href="welcome/logout">log out</a>
	</div>
	<div class='content'>
		<div class='quote-feed'>
			<?php 
			foreach($quotes as $quote)
			{
				echo "<div class='quotes'>
						{$quote['quotedby']}: <br> 
					 ' {$quote['message']} '<br>
					 Posted by {$quote['name']} 
					 <form action='quotes/favorite' method='post'>
					 	<input type='hidden' name='quote_id' value='{$quote['quote_id']}'>
					 	<input type='submit' value='add to favorites'>
					 </form>
					 </div>";
			}

			?>
		</div>
		<div class='side-bar'>
			<div class='favorites'>
			<h2>MY Favorites</h2>
			<?php 
			foreach($favorite_quotes as $quote)
			{
				echo "<div class='favorites'>
					{$quote['quotedby']}: <br> 
					 ' {$quote['message']} '<br>
					 Posted by {$quote['name']} 
					 <form action='quotes/remove_favorite' method='post'>
					 	<input type='hidden' name='quote_id' value='{$quote['quote_id']}'>
					 	<input type='submit' value='remove'>
					 </form>
					 </div>";
			}
			?>
			</div>
			<div class='quote-add'>
				<form action='/quotes/add' method='post'>
					<label>Quoted By:<input type='text' name='quotedby'/></label>
					<label>Message:<textarea name='message'></textarea></label>
					<input type='submit' value='add'>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>