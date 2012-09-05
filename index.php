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
        
        <link href="jqueryToastMessages/resources/css/jquery.toastmessage.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
        <script src="jqueryToastMessages/javascript/jquery.toastmessage.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                var mensaje=$("#mensajeAlerta").attr("value");
                if(mensaje!=""){
                    
                $().toastmessage('showErrorToast',$("#mensajeAlerta").attr("value"));
                }
            });
            
        </script>
    </head>
    <body >
        <div id="container">
            <input type="hidden" id="mensajeAlerta" value="<?php echo $_SESSION["mensaje"]; ?>"/>
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
                <input type="submit" value="Ingresar" />
            </form>
        </div>
    </body>
</html>
