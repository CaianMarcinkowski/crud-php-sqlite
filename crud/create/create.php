<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <h1> Dados do novo registro </h1>
    <form action="process_registration.php" method="post">
        <div class="input-row">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-row">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-row">
            <label for="color">Cor:</label>
            <select class="option-colors" id="color" name="color">
                <?php
                try {
                    require '../../connection.php';
                    $connection = new Connection();

                    $colorQuery = "SELECT * FROM colors;";
                    $colors = $connection->query($colorQuery)->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($colors as $color) {
                        echo "<option value='{$color['id']}'>{$color['name']}</option>";
                    }
                } catch (PDOException $e) {
                    echo "Erro durante a execução da consulta: " . $e->getMessage();
                }
                ?>
            </select>
            <button class="btn-add btn" type="button">Add</button>
        </div>

        <table class="styled-table" id="color-table">
            <thead>
                <tr>
                    <th>Cor</th>
                    <th>Remover</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

        <input type="hidden" id="selected-colors" name="selected-colors" value="">

        <div class="btn-group">
            <input class="btn" type="submit" value="Cadastrar">
            <a class="btn" href="../../index.php">Cancelar</a>
        </div>
    </form>
</body>

</html>
