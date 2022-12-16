<?php
include 'connection.php';
session_start();

$sno = $_SESSION['stno'];
$getstatus = "SELECT * from studentvote WHERE sno = '$sno'";
$res = mysqli_query($conn, $getstatus);
while ($getrow = mysqli_fetch_array($res)) {
    $pres = $getrow["votedpres"];
    $vpresi = $getrow["votedvpresi"];
    $vprese = $getrow["votedvprese"];
    $gensec = $getrow["votedgs"];
    $depsec = $getrow["votedds"];
    $trea = $getrow["votedtrea"];
    $audi = $getrow["votedaudi"];
    $piom = $getrow["votedpiom"];
    $piof = $getrow["votedpiof"];
}
if (($pres == "0") && ($vpresi == "0") && ($vprese == "0") && ($gensec == "0") && ($depsec == "0") && ($trea == "0") && ($audi == "0") && ($piom == "0") && ($piof == "0")) {
    $updatequery = "UPDATE studentvote set vstatus = 'Not Voted' WHERE sno = '$sno'";
    $up = mysqli_query($conn, $getstatus);
} else {
    $updatequery = "UPDATE studentvote set vstatus = 'Voted' WHERE sno = '$sno'";
    $up = mysqli_query($conn, $getstatus);
}
