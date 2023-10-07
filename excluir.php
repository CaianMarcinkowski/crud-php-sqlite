<?php
require 'connection.php';

if (isset($_GET['id'])) {
    $connection = new Connection();
    $userId = $_GET['id'];

    $query = "DELETE FROM users WHERE id = :id";
    $params = array(':id' => $userId);
    
    $result = $connection->execute($query, $params);

    if ($result) {
        echo "Registro excluído com sucesso.";
    } else {
        echo "Erro ao excluir o registro.";
    }
} else {
    echo "ID de usuário não especificado.";
}
?>
