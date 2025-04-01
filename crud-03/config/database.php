<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'mi_mvc';

try {
    $conn = new PDO( "mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password );
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
    $conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
    return $conn;
    // Añade este return
} catch ( PDOException $e ) {
    die( 'Conexión fallida: ' . $e->getMessage() );
}
?>