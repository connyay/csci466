<?php
if ( isset( $errors ) ) {
	echo '<ul>';
	foreach ( $errors as $e ) {
		echo '<li>' . $e . '</li>';
	}
	echo '</ul>';
}

if ( isset( $saveError ) ) {
	echo "<h2>Error saving data. Please try again.</h2>" . $saveError;
}
?>

	<form action="index.php?r=teacher/save<?php if ( isset( $formData['id'] ) ) echo '/'.$formData['id']; ?>" method="post">

	<label for="name">Name:</label>
	<input value="<?php if ( isset( $formData ) ) echo $formData['name']; ?>" type="text" id="name" name="name" />
		<label for="discipline">Discipline:</label>
		
	<select name="discipline">
	<?php 
if ( isset( $formData ) )
	$disciplineID = $formData['discipline_id'];
if ( isset( $discipline_id ) )
	$disciplineID = $discipline_id;
foreach ( $disciplines as $d ) {
	echo ( ( $d["id"] == $disciplineID ) ? '<option selected ' : '<option ' )
		. 'value="'.$d["id"].'">'.$d["discipline"].'</option>';
} ?>
	</select>

	<input type="submit" name="teacherFormSubmit" value="<?php echo ( $newRecord ) ? 'Create' : 'Update'; ?>" />
</form>
