<?php 
include("config.php");    

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $id = $_POST['id']; 
    $tariff_name = $_POST['Tariff_name']; 
    $price = $_POST['price']; 

    // SQL-запрос для обновления тарифа 
    $sql = "UPDATE tariffs SET Tariff_name = '$tariff_name', Price = '$price' WHERE id = $id"; 

    if ($conn->query($sql) === TRUE) { 
        header("Location: ../admin.php"); 
        exit; 
    } else { 
        echo "Ошибка: " . $sql . "<br>" . $conn->error; 
    } 
} else {  
    // Получение текущих данных тарифа  
    $id = $_GET['id'];  
    $result = $conn->query("SELECT * FROM tariffs WHERE id=$id");  
    $tariff = $result->fetch_assoc();  

} 
?> 

<!DOCTYPE html> 
<html lang="ru"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Редактировать тариф</title> 
    <link rel="stylesheet" href="../src/css/action/action.css"> 
</head> 
<body> 

<h1>Редактировать тариф</h1> 

<form action="" class = "form_action" method="POST"> 
    <input type="hidden" name="id" value="<?= htmlspecialchars($tariff['Id']); ?>"> 

    <label for="tariff_name">Название тарифа:</label><br /> 
    <input type="text" name="Tariff_name" class = "input" value="<?= htmlspecialchars($tariff['Tariff_name']); ?>" required><br /> 

    <label for="price">Введите цену:</label><br /> 
    <input type="number" name="price" class = "input" value="<?= htmlspecialchars($tariff['Price']); ?>" required><br /> 

    <input type="submit" class="button" value="Сохранить изменения"> 
</form> 

<a href="../admin.php">Назад к админ-панели</a> 

</body> 
</html> 

<?php 
$conn->close(); 
?>