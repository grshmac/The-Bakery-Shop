<?php
$hostname  = 'localhost';
$username = 'root';
$password='';
$dbname = 'bakeryecomm';
$connect =  mysqli_connect($hostname , $username , $password ,$dbname) or die("Error Connecting");



//function responsible for connecting to the database
function openConnection(){
    global $serwer;
    $serwer = mysqli_connect("localhost", "root", "") or exit("Nieudane połączenie z serwerem");
    $base = 'bakery';
	try{
		mysqli_select_db($serwer, $base);
	}
	catch(Exception){
		createDatabase();
		mysqli_select_db($serwer, $base);
		createTables();
		insertData();
	}
    mysqli_set_charset($serwer, "utf8");
}

function closeConnection(){
    global $serwer;
	mysqli_close($serwer);
}

function createDatabase(){
	$serwer = mysqli_connect("localhost", "root", "") or exit("Nieudane połączenie z serwerem");
	$base = 'bakery';
	
	mysqli_query($serwer, "CREATE DATABASE `$base` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;") 
	or exit("Błąd w zapytaniu tworzącym bazę");
}

function createTables(){
	global $serwer;

	$zapytanie ="CREATE TABLE `users` (
        `id` int(11) NOT NULL,
        `name` varchar(100) NOT NULL,
        `email` varchar(100) NOT NULL,
        `password` varchar(50) NOT NULL,
        `phone` int(10) NOT NULL,
        `create_datetime` datetime NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `order` (
				`OrderID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`OrderNumber` int(11) NOT NULL,
				`UserID` int(11) NOT NULL,
				`ProductID` int(11) NOT NULL,
				`Quantity` int(11) NOT NULL,
				`Price` double NOT NULL
				)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `product` (
				`ProductID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`Name` varchar(40) NOT NULL,
				`Price` decimal(5,2) NOT NULL,
				`AmountOnStock` int(11) NOT NULL,
				`ImageID` varchar(50) DEFAULT NULL,
				`Hashtag` varchar(40) DEFAULT NULL
				)";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");
}

function insertData(){
	global $serwer;
	mysqli_set_charset($serwer, "utf8");

	$zapytanie ="INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `create_datetime`) VALUES
    (1, 'John Rovie', 'balingbing.johnrovie20@gmail.com', '9847382910','850f5f5611e06993cc07363c98c560d0', '2023-04-18 08:59:41'),
    (2, 'admin', 'admin@gmail.com', 'admin', '98374629405','2023-04-18 11:00:40')";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");

	$zapytanie ="CREATE TABLE `product` (
        `ProductID` int(11) NOT NULL,
        `Name` varchar(40) COLLATE utf8_polish_ci NOT NULL,
        `Price` decimal(5,2) NOT NULL,
        `AmountOnStock` int(11) NOT NULL,
        `ImageID` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
        `Hashtag` varchar(40) COLLATE utf8_polish_ci DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;";
	mysqli_query($serwer, $zapytanie) or exit("Błąd w zapytaniu: $zapytanie");
    
}
?>