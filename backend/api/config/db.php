<?php

$dataBaseName = "vizsgaremek";
$user = "pmat";
$password = "kEzxzxS(E]H/]QNZ";

$conn = new mysqli("localhost",$user,$password,$dataBaseName);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
echo "Connection successfully"

?>