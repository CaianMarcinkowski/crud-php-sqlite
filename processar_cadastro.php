<?php
require 'connection.php';

// Teste para ver os dados do $_POST
//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = new Connection();
    
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $params = array(':name' => $name, ':email' => $email);
    
    $result = $connection->execute($query, $params);

    if ($result) {
        echo "Novo registro cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar o novo registro.";
    }
}
?>