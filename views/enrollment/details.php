
<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<?php if ( !isset( $noStudent ) ): ?>

			<h1><?php echo $name; ?></h1>


<?php else: ?>

	<h1>There is no student with the ID you specified.</h1>

<?php endif; ?>

<a href="students">Back to student list</a>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
