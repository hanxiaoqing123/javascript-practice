<?php
header("Content-type:text/html;charset=utf-8");
$pdo=new PDO("mysql:host=localhost;dbname=liandong","root","");
$pdo->query("set names utf8");
$fid=$_POST['fid'];
$pdoS=$pdo->query("select * from city_xin where fid=$fid");
$arr=$pdoS->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($arr);