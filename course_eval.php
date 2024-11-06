<!DOCTYPE html>
<html>
<body>

<?php
//form data
$evaluation_id=$_POST['evaluation_id'];
$course_difficulty=$_POST['course_difficulty'];
$course_rating=$_POST['course_rating'];
$instructor_rating=$_POST['instructor_rating'];
$feedback=$_POST['feedback'];
$engagement_level=$_POST['engagement_level'];
$communication_level=$_POST['communication_level'];

//connection DSN
$host = "pluto.hood.edu";
$dbname = "boe1db";
$user = "boe1";
$pass = "password";

try {
	$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	#use prepared statment with named placeholders :evaluation_id, :course_difficulty, :course_rating, :instructor_rating, :feedback, :engagement_level, :communication_level
	$sql = "insert into course_evaluation (evaluation_id, course_difficulty, course_rating, instructor_rating, feedback, engagement_level, communication_level) values(:evaluation_id, :course_difficulty, :course_rating, :instructor_rating, :feedback, :engagement_level, :communication_level)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':evaluation_id', $evaluation_id);
	$stmt->bindParam(':course_difficulty', $course_difficulty);
	$stmt->bindParam(':course_rating', $course_rating);
	$stmt->bindParam(':instructor_rating', $instructor_rating);
	$stmt->bindParam(':feedback', $feedback);
	$stmt->bindParam(':engagement_level', $engagement_level);
	$stmt->bindParam(':communication_level', $communication_level);

	if($stmt->execute()){
		$rows_affected = $stmt->rowCount();
		echo "<h2>".$rows_affected." evaluation submitted successfully!</h2>";
		$stmt = $conn->query("SELECT evaluation_id, course_difficulty, course_rating, instructor_rating, feedback, engagement_level, communication_level FROM course_evaluation ORDER BY evaluation_id");

		//PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0
		$stmt->setFetchMode(PDO::FETCH_NUM);

		echo "<table border=\"1\">\n";
		echo "<tr><td>evaluation_id</td><td>course_difficulty</td><td>course_rating</td><td>instructor_rating</td><td>feedback</td><td>engagement_level</td><td>communication_level</tr>\n";
		while ($row = $stmt->fetch()) {
			printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
		}
		echo "</table>\n";
		
        // Display links in a box
		echo "<div style='border: 1px solid #000; padding: 10px;'>";
		// Add the link to view all the evaluation reports
		echo "<a href='finish.php'>Click here to finish</a>";
		// Add space between links
		echo "<br><br>";
		// Add the link to start a new evaluation form
		echo "<a href='inputcourse.html'>Click here to start a new evaluation</a>";
		// Close the box
		echo "</div>";
	}
	else
	{
		echo "Insertion failed: (" . $conn->errno . ") " . $conn->error;
	}

	$conn = null;
}
catch(PDOException $e) {
	die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>

</body>
</html>



