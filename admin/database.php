
<?php
class Database
{
private static $dbHost='localhost';
private static $dbName='Burger_code';
private static $dbUser='root';
private static $dbUserPassword='';
private static $connection=null;

public static function connect()//de maniére public tout le monde peut accéder à la base par cette fonction
{
	try {
			self::$connection= new PDO('mysql:host='.self::$dbHost. ';dbname='. self::$dbName,self::$dbUser,
			self::$dbUserPassword);
			self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//self:: c' est pour l'utilisation des variables statiques
	
			//connecter à la base de données Burger_code
		}
 	catch (PDOException $e)
	
	{
		die('ERROR: '.$e->getMessage());
	}
	return self::$connection;

}
public static function disconnect()
{
	self::$connection=null;

}


}
Database::connect();

?>
