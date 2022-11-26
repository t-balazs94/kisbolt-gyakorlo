<?php
require_once("config.php");
spl_autoload_register(function($type)
{
    require_once("classes/$type.php");
});
if(isset($_POST["ok"]))
{
    if(isset($_POST["gyarto"]) && isset($_POST["megnevezes"]) && isset($_POST["nettoar"]) && isset($_POST["tipus"]))
    {
        try
        {
            Model::Connect();
            Model::NewProduct(array("gyarto" => $_POST["gyarto"], "megnevezes" => $_POST["megnevezes"], "nettoar" => $_POST["nettoar"], "tipus" => $_POST["tipus"]));
            $result = "A feltöltés sikeres";
        }
        catch (DBException $ex)
        {
            $error = $ex->getMessage();
        }
        finally
        {
           Model::Disconnect();
        }
    }
    else
    {
        $error = "Minden adatot kötelező megadni!!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Termék rögzítés</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/termekinsertstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <nav>
        <ul>
            <li><a href="beszerzesinsert.php">Új termék beszerzés feltöltés</a></li>
            <li><a href="termek.php">Termék adatok</a></li>
            <li><a href="termekinsert.php">Új termék feltöltése</a></li>
        </ul>
    </nav>
    <body>
        <h2>Termék felvétele</h2>
        <?php
        if(isset($result))
        {
            print("<h4 style='color:green;'>$result</h4>");
        }
        if(isset($error))
        {
            print("<h4 style='color:red;'>$error</h4>");
        }
        ?>
        <table>
        <form method="post">
            <tr>
                <td><label>Gyártó:</label></td>
                <td><input type="text" name="gyarto" placeholder="Írja be a termék gyártóját!"></td>
            </tr>
            <tr>
                <td><label>Megnevezés:</label></td>
                <td><input type="text" name="megnevezes" placeholder="Írja be a termék megnevezésést!"></td>
            </tr>
            <tr>
                <td><label>Nettó Ár:</label></td>
                <td><input type="number" name="nettoar" placeholder="Adja meg a termék nettó árát"></td>
            </tr>
            <tr>
                <td><label>Típus:</label></td>
            <td><select name="tipus" >
                <option value="disabled">Termék típusa</option>
                <option>élelmiszer</option>
                <option>vegyszer</option>
                <option>elektronikai cikk</option>
                <option>háztartási eszköz</option>
                <option>egyéb</option>
                </select></td>
            </tr>
            <tr>
                <td><input type="submit" name="ok" id="ok" value="Rögzít" class="mt-3"></td>
            </tr>
        </form>
        </table>
        <a href="index.php"><input type="submit" name="fooldal" value="Vissza a főoldalra" class="mt-3"></a>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>