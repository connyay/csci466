<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'header.php'; ?>
<script>
function quickCourse(index)
{
if (window.location.href.indexOf("?r=") !== -1) {
	window.location.href = window.location.href + "/view/" + index;
} else {
	window.location.href = window.location.href + "?r=course/view/" + index;
}
}
</script>
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
if ( $classes ): ?>
<section class="classes-container" style="width: 200px">
    	<div>
        <input id="QUICK" type="checkbox" />
        <label for="QUICK">Quick Search</label>
        <article>
        	<br>
		 <select name="quickCourse" onchange="quickCourse(this.value)">
	<option value=""> </option>
		  <?php
	foreach ( $classes as $class ) {
		echo '<option value="' . $class["id"] . '">' . $class["name"] . ' </option>';
	} ?>
</select>
		  </article>
    		</div>
		</section>

<?php

foreach ( $classes as $class ): ?>
	<?php include HOME . DS . 'views' . DS . 'course' . DS . '_view.php'; ?>
	<hr/>
<?php
endforeach;
else: ?>

<p>No classes were found.</p>

<?php endif; ?>

<?php include HOME . DS . 'views' . DS . 'layout' . DS . 'footer.php'; ?>
