<?php
require '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = new Connection();
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $colors = json_decode($_POST['selected-colors']);

    $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $params = array(':name' => $name, ':email' => $email);
    
    $result = $connection->execute($query, $params);

    $userId = $connection->getConnection()->lastInsertId();

    foreach ($colors as $colorId) {
        $queryUserColor = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
        $params = array(':user_id' => $userId, ':color_id' => $colorId);
        $resultUserColor = $connection->execute($queryUserColor, $params);
    }

    if ($result) {
        header('Location: ../../index.php');
    } else {
        echo "Erro ao cadastrar o novo registro.";
    }
}
?>
