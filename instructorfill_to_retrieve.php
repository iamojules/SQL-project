<?php
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evaluation_id = $_POST['evaluation_id'];

    $query = "SELECT course_difficulty, course_rating, instructor_rating, feedback, engagement_level, communication_level FROM course_evaluation WHERE evaluation_id   		= :evaluation_id;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':evaluation_id', $evaluation_id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    printf("<h2>Evaluation Details:</h2>\n");
    printf("Course Difficulty: %s<br>\n", $row['course_difficulty']);
    printf("Course Rating: %s<br>\n", $row['course_rating']);
    printf("Instructor Rating: %s<br>\n", $row['instructor_rating']);
    printf("Feedback: %s<br>\n", $row['feedback']);
    printf("Engagement Level: %s<br>\n", $row['engagement_level']);
    printf("Communication Level: %s<br>\n", $row['communication_level']);
}

?> 
<br/> 
<input type="Submit" value= "Retrieve"/><input type="Reset"/> 
</form>


