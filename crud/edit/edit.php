<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style/style_edit.css">
    <script src="script.js"></script>
</head>

<body>
    <?php
    try {
        require '../../connection.php';

        if (isset($_GET['id'])) {
            $connection = new Connection();
            $userId = $_GET['id'];

            $query = "SELECT * FROM users WHERE id = " . intval($userId);

            $user = $connection->query($query)->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "<h1> Edição de registro </h1>";
                echo "<form action='process_edit.php' method='post'>";
                echo    "<input type='hidden' name='id' value='{$user['id']}'>";
                echo    "<div class='input-group'>";
                echo        "<div class='input-row'>";
                echo            "<label for='name'>Nome:</label>";
                echo            "<input type='text' name='name' value='{$user['name']}' required>";
                echo        "</div>";
                echo        "<div class='input-row'>"; 
                echo            "<label for='email'>Email:</label>";
                echo            "<input type='email' name='email' value='{$user['email']}' required>";
                echo        "</div>";
                echo        "<div class='input-row'>";
                echo        "<label for='color-select'>Cor:</label>";
                echo        "<a class='btn btn-att-color' href='edit_color.php?id={$user['id']}'>Editar Cores</a>";
                echo        "</div>";
                echo    "</div>";
                echo    "<div class='btn-group'>";
                echo        "<input name='att_data' class='btn' type='submit' value='Atualizar'>";
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