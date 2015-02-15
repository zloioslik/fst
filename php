<?php 
$value = $_GET['value'];
$host=(String)  'localhost';
$db=(String) 'furyup';
$dsn = "mysql:host=$host;dbname=$db;charset=cp1251";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, 'device', '', $opt);

$stmt = $pdo->prepare ( "CALL furyup_json_exchange(:jsonIn, @jsonOut)" ) ;

$stmt->execute(array('jsonIn' => $value));
$stmt->closeCursor();

$r = $pdo->query("SELECT @jsonOut AS jsonOut")->fetch(PDO::FETCH_ASSOC);
if ($r) {
	echo  $r['jsonOut'];
}
?>
