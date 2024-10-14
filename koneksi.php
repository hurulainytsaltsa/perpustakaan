<?php
   $host = "localhost";
   $username = "root";
   $password = "";
   $database = "db_perpus";
   
   $db = new mysqli($host, $username, $password, $database);
   
   if($db->connect_error){
        die("Koneksi Gagal" . $db->connect_error);
   }
?>