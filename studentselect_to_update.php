<?php 
 include_once 'db.php'; 
 include 'display.php'; 
 echo "<h2> Course Evaluation </h2>"; 
 display("SELECT distinct evaluation_id, course_difficulty, course_rating, instructor_rating, feedback, engagement_level, communication_level FROM course_evaluation;"); 
?> 

<br/> 
<form action="studentfill_to_update.php" method="post"> 
<h2>Evaluation to Select: </h2> 
evaluation_id: <input type="text" name="evaluation_id"/><br>  
<input type="Submit" value= "Select"/><input type="Reset"/> 
</form>


