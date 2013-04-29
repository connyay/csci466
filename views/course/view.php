<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<?php if ( !isset( $noTeacher ) ): ?>
</div>
<div class="four columns pull-right">
<?php if ( $loggedin ): ?>
	<ul class="nav nav-tabs nav-stacked">
		<?php if ( ( $class["enrollment_cap"] - $class["curr_enroll"] ) > 0 ): ?>
			<li><a href="index.php?r=enrollment/create&class=<?php echo $class["id"]; ?>">Enroll Student</a></li>
		<?php endif; ?>
		<?php if ( $class["curr_enroll"] > 0 ): ?>
			<li><a href="index.php?r=enrollment/forclass/<?php echo $class["id"]; ?>">View Enrollments</a></li>
		<?php endif; ?>
		<li><a href="index.php?r=course/update/<?php echo $class["id"]; ?>">Update</a></li>
		<li><a href="index.php?r=course/delete/<?php echo $class["id"]; ?>" onclick="return confirm_delete()">Delete</a></li>
	</ul>
<?php endif; ?>
<ul class="nav nav-tabs nav-stacked">
	<li><a href="index.php?r=course">View Classes</a></li>
</ul>
</div>
<div class="twelve columns">
			<h2><?php echo $class['name']; ?></h2>

			<p><strong>Description:</strong> <?php echo $class['description']; ?><br>
			<strong>Instructor:</strong> <a href="index.php?r=teacher/view/<?php echo $class['teacher']['id']; ?>"><?php echo $class['teacher']['name']; ?></a><br>
			<strong>Meeting Days:</strong> <?php echo $class['meetingdays']; ?>
				<?php if ( $class['duration'] ): ?> (<?php echo $class['duration']; ?>)<?php endif; ?><br>
			<strong>Cost:</strong> <?php echo $class['cost']; ?><br>
			<strong>Room:</strong> <?php echo $class['room']; ?><br>
			<strong>Type:</strong> <?php echo ( $class['enrollment_cap'] == 1 ) ? "Individual" : "Group"; ?><br>
			<strong>Open Seats:</strong> <?php echo $class['enrollment_cap'] - $class['curr_enroll'] ." / " . $class['enrollment_cap']; ?></p>

<?php else: ?>

	<h2>There is no class with the ID you specified.</h2>

<?php endif; ?>



<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
