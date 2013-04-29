<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>
</div>
<div class="sixteen columns">
<?php if ( $enrollments ): ?>

<h2>Enrollments for
	<?php echo $enrollments[0]['class_name']; ?></h2>
<?php
$class = true;
include HOME . DS . 'views' . DS . 'enrollment' . DS . '_table.php'; ?>
<?php else: ?>

<p>No enrollments were found.</p>

<?php endif; ?>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
