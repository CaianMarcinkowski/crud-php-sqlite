<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <?php
    try {
        require '../../connection.php';

        if (isset($_GET['id'])) {
            $connection = new Connection();
            $userId = $_GET['id'];

            // Consulta para obter os registros da tabela user_colors associados ao usuário selecionado
            $queryUserColors = "SELECT uc.color_id, c.name AS color_name
                                FROM user_colors uc
                                INNER JOIN colors c ON uc.color_id = c.id
                                WHERE uc.user_id = " . intval($userId);

            $userColors = $connection->query($queryUserColors)->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM users WHERE id = " . intval($userId);

            $user = $connection->query($query)->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "<h1> Edição de registro </h1>";
                echo "<form action='process_edit.php' method='post'>";
                echo    "<input type='hidden' name='id' value='{$user['id']}'>";
                echo    "Nome: <input type='text' name='name' value='{$user['name']}' required><br>";
                echo    "Email: <input type='email' name='email' value='{$user['email']}' required><br>";
                echo    "<input type='hidden' id='selected-colors' name='selected-colors' value=''>";
                echo    "<div class='input-row'>";
                echo        "<label for='color-select'>Cor:</label>";
                echo        "<select class='option-colors' id='color-select' name='color-select'>";
                $colorQuery = "SELECT * FROM colors;";
                $colors = $connection->query($colorQuery)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($colors as $color) {
                    echo        "<option value='{$color['id']}'>{$color['name']}</option>";
                }
                echo        "</select>";
                echo        "<button class='btn-add btn' type='button' onclick='addColor()'>Add</button>";
                echo    "</div>";

                echo "<table class='styled-table' id='color-table'>";
                echo    "<thead>";
                echo        "<tr>";
                echo            "<th>Cor</th>";
                echo            "<th>Remover</th>";
                echo        "</tr>";
                echo    "</thead>";
                echo    "<tbody>";
                foreach ($userColors as $color) {
                    echo "<tr data-color-id='{$color['color_id']}'>";
                    echo    "<td>{$color['color_name']}</td>";
                    echo    "<td><form action='process_edit.php' method='post'>";
                    echo        "<input type='hidden' name='id' value='{$user['id']}'>";
                    echo        "<input type='hidden' name='color_id' value='{$color['color_id']}'>";
                    echo        "<button type='submit' class='remove-button' name='remove_color'>Remover</button>";
                    echo    "</form></td>";
                    echo    "<input type='hidden' name='color-ids[]' value='{$color['color_id']}'>";
                    echo "</tr>";
                }
                echo    "</tbody>";
                echo "</table>";
                echo    "<div class='btn-group'>";
                echo        "<input class='btn' type='submit' value='Atualizar'>";
                echo        "<a class='btn' href='../../index.php'>Cancelar</a>";
                echo    "</div>";
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

</body>

</html>
