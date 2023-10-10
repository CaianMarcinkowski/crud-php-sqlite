<?php
require '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = new Connection();

    $userId = $_POST['id'];

    if (isset($_POST['add_color'])) {
        $userId = $_POST['id'];
        $selectedColorId = $_POST['color-select'];

        $queryCheckExistence = "SELECT COUNT(*) FROM user_colors WHERE user_id = ".$userId." AND color_id = ".$selectedColorId.";";
        $count = $connection->query($queryCheckExistence)->fetchColumn();

        if ($count == 0) {
            $queryInsertColor = "INSERT INTO user_colors (user_id, color_id) VALUES (:userId, :colorId)";
            $paramsInsertColor = array(':userId' => $userId, ':colorId' => $selectedColorId);
            $result = $connection->execute($queryInsertColor, $paramsInsertColor);

            if ($result) {
                header('Location: edit_color.php?id=' . $userId);
                exit;
            } else {
                echo "Erro ao adicionar a cor.";
            }
        } else {
            header('Location: edit_color.php?id=' . $userId);
            exit;
        }
    }

    if (isset($_POST['remove_color'])) {
        $userId = $_POST['id'];
        $colorIdToRemove = $_POST['color_id'];

        $queryDeleteColor = "DELETE FROM user_colors WHERE user_id = :userId AND color_id = :colorId";
        $paramsDeleteColor = array(':userId' => $userId, ':colorId' => $colorIdToRemove);
        $result = $connection->execute($queryDeleteColor, $paramsDeleteColor);

        if ($result) {
            header('Location: edit_color.php?id=' . $userId);
            exit;
        } else {
            echo "Erro ao excluir a cor.";
        }
    }

    if (isset($_POST['att_data'])){
        $name = $_POST['name'];
        $email = $_POST['email'];

        $queryUpdateUser = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $paramsUpdateUser = array(':id' => $userId, ':name' => $name, ':email' => $email);
        $resultUpdateUser = $connection->execute($queryUpdateUser, $paramsUpdateUser);

        if ($resultUpdateUser) {
            header('Location: ../../index.php');
            exit;
        } else {
            echo "Erro ao atualizar o registro.";
        }
    }
}
