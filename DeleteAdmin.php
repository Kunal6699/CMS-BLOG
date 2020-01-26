<?php require_once("Include/Sessions.php");?>
<?php require_once("Include/Functions.php");?>
<?php require_once("Include/Functions.php");?>


<?php
   $Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
if(isset($_GET["id"]))
{
   $IdFromURL=$_GET["id"];
   $Query="DELETE FROM registration WHERE id='$IdFromURL'"; 
    $Execute=mysqli_query($Connection,$Query);
    if($Execute) 
    {
    	$_SESSION["SuccessMessage"]="Admin Deleted Succesfully";
         Redirect_to("Admins.php");}
    	else
    	{
    		$_SESSION["ErrorMessage"]="Something went Wrong";
    		 Redirect_to("Admins.php");
    	}
    }



?>