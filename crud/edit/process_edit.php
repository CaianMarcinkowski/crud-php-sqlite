<?php
require '../../connection.php';

//var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = new Connection();

    $userId = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $selectedColorIds = json_decode($_POST['selected-colors']);

    if (isset($_POST['remove_color'])) {
        $userId = $_POST['id'];
        $colorIdToRemove = $_POST['color_id'];

        //var_dump($userId." -- ".$colorIdToRemove);

        // Realize a exclusão na tabela user_colors
        $queryDeleteColor = "DELETE FROM user_colors WHERE user_id = :userId AND color_id = :colorId";
        $paramsDeleteColor = array(':userId' => $userId, ':colorId' => $colorIdToRemove);
        $result = $connection->execute($queryDeleteColor, $paramsDeleteColor);

        if ($result) {
            // Redirecione de volta à página de edição após a exclusão
            header('Location: edit.php?id=' . $userId);
        } else {
            echo "Erro ao excluir a cor.";
        }
    } else {

        // Verifique se o array não está vazio antes de inserir no banco de dados
        if (!empty($selectedColorIds)) {
            foreach ($selectedColorIds as $colorId) {
                // Verifique se já existe um registro com o mesmo user_id e color_id
                $queryCheckExistence = "SELECT COUNT(*) FROM user_colors WHERE user_id = ".intval($userId)." AND color_id = ".intval($colorId).";";
                $count = $connection->query($queryCheckExistence)->fetchColumn();

                // Se não existir um registro, insira-o
                if ($count == 0) {
                    $queryInsertColor = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
                    $paramsInsertColor = array(':user_id' => $userId, ':color_id' => $colorId);
                    $connection->execute($queryInsertColor, $paramsInsertColor);
                }
            }
        }

        // Atualize os dados do usuário na tabela users
        $queryUpdateUser = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $paramsUpdateUser = array(':id' => $userId, ':name' => $name, ':email' => $email);
        $resultUpdateUser = $connection->execute($queryUpdateUser, $paramsUpdateUser);

        if ($resultUpdateUser) {
            header('Location: ../../index.php');
        } else {
            echo "Erro ao atualizar o registro.";
        }
    }
}
