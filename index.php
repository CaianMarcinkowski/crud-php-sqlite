<?php

require 'connection.php';

$connection = new Connection();

$users = $connection->query("SELECT * FROM users");

echo "<table border='1'>

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
                           <a href='#'>Editar</a>
                           <a href='excluir.php?id=%s'>Excluir</a>
                      </td>
                   </tr>",
            $user->id, $user->name, $user->email, $user->id);

}

echo "</table>";

echo '
    <form action="cadastrar.php" method="post">
        <input type="submit" value="Cadastrar Novo Registro">
    </form>
';