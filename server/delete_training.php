<?php  
include("config.php");     

session_start();  

$id = $_GET['id'];

// SQL-запрос для удаления тренера
$sql = "DELETE FROM trainings WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../admin.php");
} else {
    echo "Ошибка: " . $conn->error;
}

$conn->close();
?>
