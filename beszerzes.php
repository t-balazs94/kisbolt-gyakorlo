<?php
require_once("config.php");
spl_autoload_register(function($type)
{
    require_once("classes/$type.php");
});

if(isset($_POST["ok"]))
{
    if(isset($_POST["darabszam"]) && isset($_POST["beszerzesid"]))
    {
        try
        {
            Model::Connect();
            Model::NewDarabszam($_POST["darabszam"], $_POST["beszerzesid"]);
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
        $error = "A név és az üzenet megadása kötelező!";
    }
}

        try
        {
            Model::Connect();
            $beszerzesek = Model::GetSupply($_GET["beszerzesid"]);
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
        <title>Termék beszerzési adatok</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/beszerzesstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <nav>
        <ul>
            <li><a href="beszerzesinsert.php">Új termék beszerzés feltöltés</a></li>
            <li><a href="termek.php">Termék adatok</a></li>
            <li><a href="termekinsert.php">Új termék feltöltése</a></li>
        </ul>
    </nav>
    <body>
        <h2>Termékek beszerzési adatai</h2>
        <table class="table table-bordered table-dark table-sm text-center">
            <thead>
            <tr>
                <th>Termék</th>
                <th>Beszerzési dátum</th>
                <th>Beszerzési ár (Ft)</th>
                <th>Darabszám</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($beszerzesek as $beszerzes){ 
                    if($beszerzes['darabszam'] != 0){
                    ?>
                    <tr>
                        <td>
                           <?php echo $beszerzes['termekid']; ?>
                        </td>
                        <td>
                             <?php echo $beszerzes['bdatum']; ?>
                        </td>
                        <td>
                             <?php echo $beszerzes['bar']; ?>
                        </td>
                        <td>
                            <form method="post" action="beszerzes.php?beszerzesid=<?php echo $beszerzes['beszerzesid']; ?>">
                                <input type="number" name="darabszam" id="db" value="<?php echo $beszerzes['darabszam']; ?>" max="<?php echo $beszerzes['darabszam']; ?>">
                                <input type="hidden" name="beszerzesid" value="<?php echo $beszerzes['beszerzesid']; ?>">
                                <input type="submit" value="Rögzít" id="rogzit" name="ok">
                            </form>
                        </td>
                    </tr>
                    <?php }} ?>
            </tbody>
        </table>
        <a href="index.php"><input type="submit" name="fooldal" value="Vissza a főoldalra" class="mt-3"></a>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>