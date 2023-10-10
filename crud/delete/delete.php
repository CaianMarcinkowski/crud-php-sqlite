<?php
require '../../connection.php';

if (isset($_GET['id'])) {
    $connection = new Connection();
    $userId = $_GET['id'];

    $queryDeleteUserColors = "DELETE FROM user_colors WHERE user_id = :user_id";
    $paramsDeleteUserColors = array(':user_id' => $userId);
    $resultDeleteUserColors = $connection->execute($queryDeleteUserColors, $paramsDeleteUserColors);

    $query = "DELETE FROM users WHERE id = :id";
    $params = array(':id' => $userId);
    $result = $connection->execute($query, $params);

    if ($result && $resultDeleteUserColors) {
        header('Location: ../../index.php');
    } else {
        echo "Erro ao excluir o registro.";
    }
} else {
    echo "ID de usuário não especificado.";
}
?>
