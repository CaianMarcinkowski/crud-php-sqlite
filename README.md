# Projeto PHP com SQLite - CRUD de Usuários e Cores

Este é um projeto PHP que utiliza um banco de dados SQLite para criar, ler, atualizar e excluir registros de usuários, além de permitir que os usuários sejam associados ou desassociados de cores.

## Pré-requisitos

Para executar este projeto, você precisará:

- PHP instalado em seu sistema.
- Extensão SQLite do PHP ativada.
- Um terminal para executar comandos.

## Instruções de Uso

1. Clone este repositório para sua máquina local.

2. No diretório raiz do projeto, execute o seguinte comando para iniciar o servidor PHP embutido:

   ```
   php -S 0.0.0.0:7070
    ```
Isso iniciará o servidor em http://localhost:7070. Você pode acessar o projeto no seu navegador.

O banco de dados SQLite já está incluído no projeto como db.sqlite. Para manusear o banco de dados, você pode usar o comando sqlite3 no terminal. Por exemplo, para abrir o banco de dados:

    sqlite3 db.sqlite
    
Isso abrirá um prompt SQLite onde você pode executar comandos SQL.

O projeto inclui uma página principal que lista os usuários e permite editar ou excluir cada usuário.

Você pode criar, editar e excluir usuários usando as opções fornecidas.

Para associar ou desassociar cores a um usuário, use a tabela em 'editar' e o JavaScript cuidará do restante.

Estrutura do Banco de Dados

O banco de dados contém as seguintes tabelas:

### Tabela: users

    id: Inteiro, chave primária, auto-incremento.
    name: String (100 caracteres), não pode ser nulo.
    email: String (100 caracteres), não pode ser nulo.

### Tabela: colors

    id: Inteiro, chave primária, auto-incremento.
    name: String (50 caracteres), não pode ser nulo.

### Tabela: user_colors

    color_id: Inteiro.
    user_id: Inteiro.

## Dicas

O PHP possui um servidor embutido que é uma maneira rápida de executar projetos locais sem configurar um servidor web completo.

Para manusear o banco de dados SQLite, você pode usar a ferramenta sqlite3 no terminal, conforme mencionado acima.

O projeto utiliza JavaScript para manipular a tabela de listagem de cores, permitindo a associação e desassociação de cores aos registros de usuários.
