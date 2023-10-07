<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1> Dados do novo registro </h1>
    <form action="process_registration.php" method="post">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <div class="btn-group">
            <input class="btn" type="submit" value="Cadastrar">
            <a class="btn" href="../../index.php">Cancelar</a>
        </div>
    </form>
</body>
</html>
