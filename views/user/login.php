
<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<h2><?php echo $title; ?></h2>

<?php
if ( isset( $errors ) ) {
	echo '<ul>';
	foreach ( $errors as $e ) {
		echo '<li>' . $e . '</li>';
	}
	echo '</ul>';
}

if ( isset( $saveError ) ) {
	echo "<h2>Error saving data. Please try again.</h2>" . $saveError;
}
?>

<form action="index.php?r=user/login" method="post">

	<p>
		<label for="name">Username:</label>
		<input type="text" id="name" name="username" />
		<label for="name">Password:</label>
		<input type="password" id="name" name="password" />
	</p>

	<input type="submit" name="loginForm" value="Login" />
</form>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
