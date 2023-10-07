<?php
try {
    require '../../connection.php';

    if (isset($_GET['id'])) {
        $connection = new Connection();
        $userId = $_GET['id'];

        $query = "SELECT * FROM users WHERE id = " . intval($userId);

        $user = $connection->query($query)->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "<form action='process_edit.php' method='post'>";
            echo "<input type='hidden' name='id' value='{$user['id']}'>";
            echo "Name: <input type='text' name='name' value='{$user['name']}' required><br>";
            echo "Email: <input type='email' name='email' value='{$user['email']}' required><br>";
            echo "<input type='submit' value='Atualizar'>";
            echo "</form>";
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "ID de usuário não especificado.";
    }
} catch (PDOException $e) {
    echo "Erro durante a execução da consulta: " . $e->getMessage();
}
?>