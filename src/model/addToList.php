<?php

$newList = $_POST['list']; 

$jsonfile = fopen("list.json", "w+") or die("Unable to open file!");
fwrite($jsonfile, json_encode($newList));
fclose($jsonfile);	
