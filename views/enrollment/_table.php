<table class="table table-bordered table-hover table-striped">
	<thead>
		<th>#</th>
		<?php
if ( !isset( $student ) ) {
	echo '<th>Student Name</th>';
}
if ( !isset( $class ) ) {
	echo '<th>Class Name</th>';
} ?>
		<th>Class Cost</th>
		<th>Status</th>
		<th>Enroll Date</th>
		<th></th>
	</thead>
	<tbody>
		<?php
$count = 1;
foreach ( $enrollments as $e ): ?>
		<tr>
			<td><?php echo $count; $count++; ?></td>
			<?php
if ( !isset( $student ) ) {
	echo "<td>" . $e['student_name'] . "</td>";
}
if ( !isset( $class ) ) {
	echo "<td>" . $e['class_name'] . "</td>";
} ?>
			<td><?php echo $e['cost']; ?></td>
			<td><?php echo $e['status']; ?></td>
			<td><?php echo $e['enroll_date']; ?></td>
			<td class="center">
				<a href="index.php?r=enrollment/update/<?php echo $e['id']; ?>">Update</a> |
				<a href="index.php?r=enrollment/delete/<?php echo $e['id']; ?>" onclick="return confirm_delete()">Remove</a>
			</td>
		</tr>
		<?php endforeach; ?></tbody>
</table>
