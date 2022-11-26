<?php
require_once("config.php");
spl_autoload_register(function($type)
{
    require_once("classes/$type.php");
});
        try
        {
            Model::Connect();
            $termekek = Model::GetProductWithSupply();
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
        <title>Termék adatok</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/termekstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav>
        <ul>
            <li><a href="beszerzesinsert.php">Új termék beszerzés feltöltés</a></li>
            <li><a href="termek.php">Termék adatok</a></li>
            <li><a href="termekinsert.php">Új termék feltöltése</a></li>
        </ul>
    </nav>
        <h2>Termékek adatai</h2>
        <table class="table table-bordered table-dark table-sm text-center">
            <thead>
            <tr>
                <th>Gyártó</th>
                <th>Megnevezés</th>
                <th>Nettó Ár (Ft)</th>
                <th>Bruttó Ár (Ft)</th>
                <th>Típus</th>
                <th>Darabszám</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($termekek as $termek){             
                    ?>
                <tr style="background-color: <?php $termek["darabszam"] == 0?'red':'';?>">
                        <td>
                           <?php echo $termek['gyarto']; ?>
                        </td>
                        <td>
                            <a href="beszerzes.php?beszerzesid=<?php echo $termek['beszerzesid']; ?>">
                           <?php echo $termek['megnevezes']; ?>
                            </a>
                        </td>
                        <td>
                             <?php echo $termek['nettoar']; ?>
                        </td>
                        <td>
                             <?php echo $termek['nettoar'] * 1.27; ?>
                        </td>
                        <td>
                             <?php echo $termek['tipus']; ?>
                        </td>
                        <td>
                             <?php echo $termek['darabszam']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.php"><input type="submit" name="fooldal" value="Vissza a főoldalra" class="mt-3"></a>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>