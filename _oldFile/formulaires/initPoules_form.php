<?php


$_SESSION['nbEquSelect']=$_POST['nbEquSelect'];

$_SESSION['nbPoules']=(int)$_POST['nbPoules'];


header("location:  /organiser/organiser_poules");
exit();