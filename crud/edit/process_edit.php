<?php
require '../../connection.php';

// Teste para ver os dados do $_POST
// print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = new Connection();
    
    $userId = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $params = array(':id' => $userId, ':name' => $name, ':email' => $email);
    
    $result = $connection->execute($query, $params);

    if ($result) {
        header('Location: ../../index.php');
    } else {
        echo "Erro ao atualizar o registro.";
    }
}
