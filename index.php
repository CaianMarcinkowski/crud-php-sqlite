<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>

    <?php
    require 'connection.php';

    $connection = new Connection();

    $users = $connection->query("SELECT * FROM users");

    echo "
            <h1>Teste de conhecimentos PHP + Banco de dados</h1>
            <table class='styled-table'>
                <tr>
                    <th>ID</th>    
                    <th>Nome</th>    
                    <th>Email</th>
                    <th>Ação</th>    
                </tr>
        ";

    foreach($users as $user) {
        echo sprintf("<tr>
                          <td>%s</td>
                          <td>%s</td>
                          <td>%s</td>
                          <td>
                            <a href='crud/edit/edit.php?id=%s'>Editar</a>
                            <a href='crud/delete/delete.php?id=%s'>Excluir</a>
                        </td>
                    </tr>",
        $user->id, $user->name, $user->email, $user->id, $user->id);
    }

    echo "</table>";

    echo '
        <form action="crud/create/create.php" method="post">
            <input type="submit" value="Cadastrar Novo Registro">
        </form>
    ';

    ?>
</body>
</html>