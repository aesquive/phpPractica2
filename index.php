<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if (!$_SESSION || !$_SESSION["mensaje"]) {
    $_SESSION["mensaje"] = "";
}
?>
<!DOCTYPE>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body >
        <div id="container">
            <form action="php/login.php" method="post" >
                <table>
                    <tbody>
                        <tr>
                            <td><a>Usuario:</a></td>
                            <td><input type="text" name="nick" id="nick"/></td>
                        </tr>
                        <tr>
                            <td><a>Password:</a></td>
                            <td><input type="password" name="password" id="password"/></td>
                        </tr>
                    </tbody>
                </table>
                <a class="aviso"><?php echo $_SESSION["mensaje"]; ?></a>
                  <br>
                <input type="submit" value="Ingresar" />
            </form>
        </div>
    </body>
</html>
