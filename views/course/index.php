<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<h2>Available Classes</h2>

<?php if ( $loggedin ): ?>
</div>
<div class="four columns pull-right">
<ul class="nav nav-tabs nav-stacked">
	<li><a href="index.php?r=course/create">Create New Class</a></li>
</ul>
</div>
<div class="twelve columns">
<?php endif; ?>

<?php
if ( $classes ):
	foreach ( $classes as $class ): ?>
	<?php include HOME . DS . 'views' . DS . 'course' . DS . '_view.php'; ?>
	<hr/>
<?php
	endforeach;
else: ?>

<p>No classes were found.</p>

<?php endif; ?>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
