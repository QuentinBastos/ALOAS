<?php
/**
 * Connection à la base de données
 */
try{
    $pdo = new PDO('mysql:host=testtoj117.mysql.db;dbname=testtoj117;' , 'testtoj117', 'Dd21092005', [ PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION]);

}catch(PDOException $e){
    
    echo $e->getMessage();
} ?>                