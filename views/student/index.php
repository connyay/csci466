
<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<h2><?php echo $title; ?></h2>

<?php if ( $loggedin ): ?>
</div>
<div class="four columns pull-right">
<ul class="nav nav-tabs nav-stacked">
	<li><a href="index.php?r=student/create">Create New Student</a></li>
</ul>
</div>
<div class="twelve columns">
<?php endif; ?>

<?php
if ( $students ):
	foreach ( $students as $a ): ?>


	<h4><a href="index.php?r=student/view/<?php echo $a['id']; ?>"><?php echo $a['name']; ?></a></h4>

	<hr/>
<?php
endforeach;
else: ?>

<p>No students were found.</p>

<?php endif; ?>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
