<?php
abstract class Model 
{
    private static mixed $pdo;
    
    public static function Connect() : void
    {
        global $cfg;
        try
        {
            self::$pdo = new PDO("mysql:host={$cfg['server']};dbname={$cfg['db']}", $cfg['user'], $cfg['pass']);
        }
        catch (Exception $ex)
        {
            throw new DBException("Csatlakozás sikertelen!", $ex);
        }
    }
    
    public static function Disconnect() : void
    {
        self::$pdo = "";
    }
    
    public static function NewProduct(array $data) : void
    {
        try
        {
            self::$pdo->exec("INSERT INTO `termek`(`gyarto`, `megnevezes`, `tipus`, `nettoar`) VALUES (".self::$pdo->quote($data["gyarto"]).", ".self::$pdo->quote($data["megnevezes"]).", ".self::$pdo->quote($data["tipus"]).", ".self::$pdo->quote($data["nettoar"]).")");
        } 
        catch (Exception $ex)
        {
            throw new DBException("A post beszúrása sikertelen!", $ex);
        }
    }
    
    public static function NewSupply(array $data) : void
    {
        try
        {
            self::$pdo->exec("INSERT INTO `beszerzes`(`bdatum`, `bar`, `darabszam`, `termekid`) VALUES (".self::$pdo->quote($data["bdatum"]).", ".self::$pdo->quote($data["bar"]).", ".self::$pdo->quote($data["darabszam"]).", ".self::$pdo->quote($data["termekid"]).")");
        } 
        catch (Exception $ex)
        {
            throw new DBException("A post beszúrása sikertelen!", $ex);
        }
    }
    
    public static function GetProduct() : array
    {
        try
        {
            $result = self::$pdo->query("SELECT * FROM `termek`");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $ex)
        {
            throw new DBException("A lekérdezés sikertelen!", $ex);
        }
    }
    
    public static function GetSupply(int $id) : array
    {
        try
        {
            $result = self::$pdo->query("SELECT * FROM `beszerzes` WHERE `beszerzesid` = $id");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $ex)
        {
            throw new DBException("A lekérdezés sikertelen!", $ex);
        }
    }
    
    public static function GetProductWithSupply() : array
    {
        try
        {
            $result = self::$pdo->query("SELECT * FROM `termek` LEFT JOIN `beszerzes` ON `termek`.`termekid` = `beszerzes`.`termekid`");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $ex)
        {
            throw new DBException("A lekérdezés sikertelen!", $ex);
        }
    }
    
     public static function NewDarabszam(int $darab, int $beszerzesid) : void
    {
        try
        {
            self::$pdo->exec("UPDATE `beszerzes` SET `darabszam` = $darab WHERE `beszerzesid` = $beszerzesid");
        } 
        catch (Exception $ex)
        {
            throw new DBException("A post beszúrása sikertelen!", $ex);
        }
    }
    
    
}
