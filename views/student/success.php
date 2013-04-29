
<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<h1><?php echo $title; ?></h1>

<?php if ( !empty( $userData['name'] ) ): ?>
	<h3>Student Name:</h3>
	<p><?php echo $userData['name']; ?></p>
<?php endif;?>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
