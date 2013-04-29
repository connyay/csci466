<p><h5><a href="index.php?r=course/view/<?php echo $class['id']; ?>"><?php echo $class['name']; ?></a></h5>
<strong>Description:</strong> <?php echo $class['description']; ?><br>
<strong>Instructor:</strong> <a href="index.php?r=teacher/view/<?php echo $class['teacher']['id']; ?>"><?php echo $class['teacher']['name']; ?></a><br>
<strong>Meeting Days:</strong> <?php echo $class['meetingdays']; ?>
	<?php if ( $class['duration'] ): ?> (<?php echo $class['duration']; ?>)<?php endif; ?><br>
<strong>Cost:</strong> <?php echo $class['cost']; ?><br>
<strong>Room:</strong> <?php echo $class['room']; ?><br>
<strong>Type:</strong> <?php echo ( $class['enrollment_cap'] == 1 ) ? "Individual" : "Group"; ?><br>
<strong>Open Seats:</strong> <?php echo $class['enrollment_cap'] - $class['curr_enroll'] ." / " . $class['enrollment_cap']; ?></p>
