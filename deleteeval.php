
<?php 
include_once 'db.php';
 
#form data 
$evaluation_id=$_POST['evaluation_id']; 
$sql = "delete from course_evaluation where evaluation_id = :evaluation_id;";
$stmt = $conn->prepare($sql); 

# data stored in an associative array 
$data = array( 'evaluation_id' => $evaluation_id); 

if($stmt->execute($data)){ 
   $rows_affected = $stmt->rowCount(); 
   echo "<h2>".$rows_affected." Evaluation deleted sucessfully!</h2>"; 
   $stmt = $conn->query("SELECT distint evaluation_id, course_difficulty, course_rating, instructor_rating, feedback, engagement_level, communication_level FROM course_evaluation"); 

   //PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 1 
   $stmt->setFetchMode(PDO::FETCH_NUM); 
   echo "<table border=\"1\">\n"; 
   echo "<tr><td>evaluation_id</td><td>course_difficulty</td><td>course_rating</td><td>instructor_rating</td><td>feedback</td><td>engagement_level</td><td>	    	communication_level</tr>\n";
   while ($row = $stmt->fetch()) { 
   printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]); 
	} 
	echo "</table>\n"; 
}
else 
{ 
	echo "\nPDOStatement::errorInfo():\n"; 
	print_r($stmt->errorInfo()); 
}
$stmt = null; 
$conn = null; 
?>