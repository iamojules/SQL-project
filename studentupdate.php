
 <?php

include_once 'db.php';

# form data
$evaluation_id = $_POST['evaluation_id'];
$course_difficulty = $_POST['course_difficulty'];
$course_rating = $_POST['course_rating'];
$instructor_rating = $_POST['instructor_rating'];
$feedback = $_POST['feedback'];
$engagement_level = $_POST['engagement_level'];
$communication_level = $_POST['communication_level'];

$query = "UPDATE course_evaluation SET course_difficulty = :course_difficulty, course_rating = :course_rating, instructor_rating = :instructor_rating, feedback = :feedback, engagement_level = :engagement_level, communication_level = :communication_level WHERE evaluation_id = :evaluation_id;";
$data = array(
    'course_difficulty' => $course_difficulty,
    'course_rating' => $course_rating,
    'instructor_rating' => $instructor_rating,
    'feedback' => $feedback,
    'engagement_level' => $engagement_level,
    'communication_level' => $communication_level,
    'evaluation_id' => $evaluation_id
);
$stmt = $conn->prepare($query);

if ($stmt->execute($data)) {
    $rows_affected = $stmt->rowCount();
    echo "<h2>". $rows_affected. " Evaluation updated successfully!</h2>";
    include 'display.php';
    display("SELECT distinct evaluation_id, course_difficulty, course_rating, instructor_rating, feedback, engagement_level, communication_level  FROM course_evaluation;");
} else {
    echo "Update failed: (" . $conn->errno . ") " . $conn->error;
}

$conn->close();
?>
    
  
        
 