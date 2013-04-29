<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>
</div>
<div class="sixteen columns">
<h2><?php echo $title; ?></h2>

<?php
if ( $enrollments ): ?>
    <?php include HOME . DS . 'views' . DS . 'enrollment' . DS . '_table.php'; ?>
    <?php else: ?>

<p>No enrollments were found.</p>

<?php endif; ?>


<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
