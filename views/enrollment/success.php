
<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<h1><?php echo $title; ?></h1>

<?php if ( !empty( $userData['student_id'] ) ): ?>
	<h3>Student ID:</h3>
	<p><?php echo $userData['student_id']; ?></p>
<?php endif;?>

<?php if ( !empty( $userData['class_id'] ) ): ?>
	<h3>Class ID:</h3>
	<p><?php echo $userData['class_id']; ?></p>
<?php endif;?>

<?php if ( !empty( $userData['status_id'] ) ): ?>
	<h3>Status ID:</h3>
	<p><?php echo $userData['status_id']; ?></p>
<?php endif;?>
<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
