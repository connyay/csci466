
<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>

<h2><?php echo $title; ?></h2>

<?php if ( $loggedin ): ?>
</div>
<div class="four columns pull-right">
<ul class="nav nav-tabs nav-stacked">
	<li><a href="index.php?r=teacher/create">Create New Teacher</a></li>
</ul>
</div>
<div class="twelve columns">
<?php endif; ?>

<?php
if ( $teachers ):
	$count = 1;
foreach ( $teachers as $teacher ): ?>
	<h3><a href="index.php?r=teacher/view/<?php echo $teacher['id']; ?>"><?php echo $teacher['name']; ?></a>
		<?php if ( $teacher['discipline'] ): ?><small>(<?php echo $teacher['discipline']; ?>)</small> <?php endif; ?>
	</h3>
		<?php if ( !empty( $teacher["classes"] ) ): ?>

		<section class="classes-container">
    	<div>
        <input id="ac-<?php echo $count; ?>" type="checkbox" />
        <label for="ac-<?php echo $count; $count++;?>"><?php echo count( $teacher["classes"] ); echo ( count( $teacher["classes"] ) == 1 ) ? ' class' : " classes"; ?></label>
        <article>
		<?php foreach ( $teacher["classes"] as $class ): ?>
			<p><?php include HOME . DS . 'views' . DS . 'course' . DS . '_embed.php'; ?></p>
		<?php endforeach; ?>
		  </article>
    		</div>
		</section>
		<?php else: ?>
		 <br>
		<?php endif; ?>

	<hr/>
<?php
endforeach;
else: ?>

<p>No teachers were found.</p>

<?php endif; ?>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
