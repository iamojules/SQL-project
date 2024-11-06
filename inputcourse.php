<!DOCTYPE html>
<html>
<body>

<?php
//form data
$course_id = $_POST['course_id'];
$course_name = $_POST['course_name'];
$credits = $_POST['credits'];
$mode = $_POST['mode'];

//connection DSN
$host = "pluto.hood.edu";
$dbname = "ljc12db";
$user = "ljc12";
$pass = "password";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert data into course table
    $sql_course = "INSERT INTO course (course_id, course_name, credits, mode) VALUES (:course_id, :course_name, :credits, :mode)";
    $stmt_course = $conn->prepare($sql_course);

    $stmt_course->bindParam(':course_id', $course_id);
    $stmt_course->bindParam(':course_name', $course_name);
    $stmt_course->bindParam(':credits', $credits);
    $stmt_course->bindParam(':mode', $mode);

    if ($stmt_course->execute()) {
        $rows_affected = $stmt_course->rowCount();
        echo "<h2>" . $rows_affected . " course added to be evaluated!</h2>";
        $stmt = $conn->query("SELECT distinct course_id, course_name, credits, mode FROM course order by course_id");

        // PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0
        $stmt->setFetchMode(PDO::FETCH_NUM);

        echo "<table border=\"1\">\n";
        echo "<tr><td>course_id</td><td>course_name</td><td>credits</td><td>mode</td></tr>\n";
        while ($row = $stmt->fetch()) {
            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $row[0], $row[1], $row[2], $row[3]);
        }
        echo "</table>\n";

        // Add the link to the evaluation form
        echo "<a href='course_eval.html'>Click here to evaluate the course</a>";
    } else {
        echo "Insertion failed: (" . $conn->errorCode() . ") " . implode(" ", $conn->errorInfo());
    }

    $conn = null;
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>

</body>
</html>
