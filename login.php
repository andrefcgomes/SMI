<?php
include_once('db.php');
if (isset($_POST['user'])) {
    if (empty($_POST['user']) || empty($_POST['pass'])) {
        $error = "ERRO : username ou password invalida";
        echo $error;
    } else {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $query = "SELECT * FROM users";
        $result = query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['username'] == $user && $row['password'] == $pass) {
                    $_SESSION['user'] = $user;
                    $_SESSION['id'] = $row['idUser'];
                    $_SESSION['perms'] = $row['permissao'];
                    session_write_close();
                }
            }
        } else {
            $error = "ERRO : username ou password invalida";
            echo $error;
        }
    }
}
if (!isset($_SESSION['user'])) {
    ?>
    <button onclick='showPage("content", "user_register.php")'>Registar</button>
    <form method = "post" action = "">
        Username: <input type = "text" name = "user"/><br/>
        Password: <input type = "password" name = "pass"/><br/>
        <input type = "submit"/>
    </form>

    <?php
} else {
    echo 'Bem vindo ' . $_SESSION['user'];
    ?>
    <form method="post" action="logout.php">
        <input type="submit" value="Logout"/>
    </form>
<?php
}
