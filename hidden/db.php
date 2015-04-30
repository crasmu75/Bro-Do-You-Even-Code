<?php

function openDBConnection()
{
   $DBH = new PDO ( "mysql:host=localhost;dbname=snake", 'root', 'root' );
   $DBH->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   return $DBH;
}

?>