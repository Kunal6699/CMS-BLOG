<?php require_once("include/DB.php");?>   <!-- req once se function dusra file me likh kar usko include karna  -->

<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>

<?php
 
  $_SESSION["User_Id"]=null;
  session_destroy();
  Redirect_to("Login.php");

?>