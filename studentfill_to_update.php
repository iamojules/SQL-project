<form action="studentupdate.php" method="post"> 
<?php 
include_once 'db.php'; 

$evaluation_id =$_POST['evaluation_id']; 

# prepared statement with Unnamed Placeholders 
$query = "select evaluation_id, course_difficulty, course_rating, instructor_rating, feedback, engagement_level, communication_level from course_evaluation where evaluation_id = ?;"; 
$stmt = $conn->prepare($query); 
$stmt->bindValue(1, $evaluation_id); # bind by value and assign variables to each place holder
$stmt->execute(); 
$stmt->setFetchMode(PDO::FETCH_NUM); 
$row = $stmt->fetch(); 
 
printf("<input type=\"hidden\" name=\"evaluation_id\" value=\"%s\"/><br>\n",$row[0]);
printf("course_difficulty: <input type=\"text\" name=\"course_difficulty\" value=\"%s\"/><br>\n",$row[1]); 
printf("course_rating: <input type=\"text\" name=\"course_rating\" value=\"%s\"/><br>\n",$row[2]);
printf("instructor_rating: <input type=\"text\" name=\"instructor_rating\" value=\"%s\"/><br>\n",$row[3]);
printf("feedback: <input type=\"text\" name=\"feedback\" value=\"%s\"/><br>\n",$row[4]);
printf("engagement_level: <input type=\"text\" name=\"engagement_level\" value=\"%s\"/><br>\n",$row[5]);
printf("communication_level: <input type=\"text\" name=\"communication_level\" value=\"%s\"/><br>\n",$row[6]);
?> 
<br/> 
<input type="Submit" value= "Update"/><input type="Reset"/> 
</form>
