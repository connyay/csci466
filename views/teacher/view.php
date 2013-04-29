<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

</div>
<div class="four columns pull-right">
<?php if ( $loggedin ): ?>
	<ul class="nav nav-tabs nav-stacked">
		<li><a href='index.php?r=course/create&teacher=<?php echo $teacher["id"]; ?>'>Add class</a></li>
		<li><a href='index.php?r=teacher/update/<?php echo $teacher["id"]; ?>'>Update</a></li>
		<li><a href='index.php?r=teacher/delete/<?php echo $teacher["id"]; ?>' onclick="return confirm_delete()">Delete</a></li>
	</ul>
<?php endif; ?>
<ul class="nav nav-tabs nav-stacked">
	<li><a href="index.php?r=teacher">View Teachers</a></li>
</ul>
</div>
<div class="twelve columns">

	<h2><?php echo $teacher['name']; ?>
		<?php if ( $teacher['discipline'] ): ?><small>(<?php echo $teacher['discipline']; ?>)</small> <?php endif; ?>
	</h2>

	<?php if ( !empty( $classes ) ) {
	$fullclasses = array();
	$openClasses = array();
} else {
	echo "No classes were found.";
}
foreach ( $classes as $class ) {
	( ( $class['enrollment_cap'] - $class['curr_enroll'] ) <= 0 ) ? array_push( $fullclasses, $class ) : array_push( $openClasses, $class );
} ?>

	<?php if ( !empty( $openClasses ) ) : ?>
	<p><strong>Available Classes:</strong></p>
	<div class="classes">
	<?php foreach ( $openClasses as $class ): ?>
		<p><?php include HOME . DS . 'views' . DS . 'course' . DS . '_embed.php'; ?></p>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<?php if ( !empty( $fullclasses ) ) : ?>
	<p><strong>Unavailable Classes:</strong></p>
	<div class="classes">
	<?php foreach ( $fullclasses as $class ): ?>
			<?php include HOME . DS . 'views' . DS . 'course' . DS . '_embed.php'; ?>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>




<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
