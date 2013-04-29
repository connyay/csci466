<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<?php if ( !isset( $noStudent ) ): ?>

<?php if ( $loggedin ): ?>
</div>
<div class="four columns pull-right">
	<ul class="nav nav-tabs nav-stacked">
		<li><a href='index.php?r=enrollment/forstudent/<?php echo $student["id"]; ?>'>View Enrollments</a></li>
		<li><a href='index.php?r=enrollment/create&student=<?php echo $student["id"]; ?>'>Enroll Student</a></li>
		<li><a href='index.php?r=student/update/<?php echo $student["id"]; ?>'>Update</a></li>
		<li><a href='index.php?r=student/delete/<?php echo $student["id"]; ?>' onclick="return confirm_delete()">Delete</a></li>
	</ul>
<?php endif; ?>
<ul class="nav nav-tabs nav-stacked">
	<li><a href="student">View Students</a></li>
</ul>
</div>
<div class="twelve columns">

	<h1><?php echo $student["name"]; ?></h1>
<?php else: ?>
	<h1>There is no student with the ID you specified.</h1>
<?php endif; ?>


<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
