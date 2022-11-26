<?php
require_once("config.php");
spl_autoload_register(function($type)
{
    require_once("classes/$type.php");
});
if(isset($_POST["ok"]))
{
    if(isset($_POST["bdatum"]) && isset($_POST["bar"]) && isset($_POST["darabszam"]) && isset($_POST["termekid"]))
    {
        try
        {
            Model::Connect();
            Model::NewSupply(array("bdatum" => $_POST["bdatum"], "bar" => $_POST["bar"], "darabszam" => $_POST["darabszam"], "termekid" => $_POST["termekid"]));
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
        $error = "Minden adatot kötelező megadni!";
    }
}

try
{
      Model::Connect();
      $termekek = Model::GetProduct();    
}
 catch (DBException $ex)
        {
            $error = $ex->getMessage();
        }
        finally
        {
           Model::Disconnect();
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Termék rögzítés</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/beszerzesinsertstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <nav>
        <ul>
            <li><a href="beszerzesinsert.php">Új termék beszerzés feltöltés</a></li>
            <li><a href="termek.php">Termék adatok</a></li>
            <li><a href="termekinsert.php">Új termék feltöltése</a></li>
        </ul>
    </nav>
    <body>
        <h2>Termék beszerzésének felvétele</h2>
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
                <td><label>Beszerzés dátuma:</label></td>
                <td><input type="date" name="bdatum" placeholder="Írd be a beszerzés dátumát!"></td>
            </tr>
            <tr>
             <td><label>Termék beszerzési ára:</label></td>
             <td><input type="number" name="bar" placeholder="Írd be a termék beszerzési árát!"></td>
            </tr>
             <td><label>Termék mennyisége</label></td>
             <td><input type="number" name="darabszam" placeholder="Add meg a termék darabszámát"></td>
            <tr>
            <th><select name="termekid">
                <?php
                foreach($termekek as $termek)
                {
                    print("<option value=\"{$termek['termekid']}\">{$termek['gyarto']} ({$termek['megnevezes']})</option>");
                }
                ?>
            </select></th>
            </tr>
            <tr>
            <th><input type="submit" name="ok" id="ok" value="Rögzít" class="mt-3"></th>
            </tr>
        </form>
        </table>
        <a href="index.php"><input type="submit" name="fooldal" value="Vissza a főoldalra" class="mt-3"></a>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>