<?php
session_start(); 
if(!isset($_SESSION["Oturum"]) || $_SESSION["Oturum"]!="6789")
{
	header("location:login.php");
}
if($_GET)
{
include("inc/vt.php");
$id=(int)$_GET["id"]; 


$sorgu=$baglanti->query("delete from kullanicilar where id=$id");

header("location:index1.php");
}
?>