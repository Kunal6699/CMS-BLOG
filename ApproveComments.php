<?php require_once("include/DB.php");?>
<?php require_once("Include/Sessions.php");?>
<?php require_once("Include/Functions.php");?>


<?php
   $Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
if(isset($_GET["id"]))
{
   $IdFromURL=$_GET["id"];
   $Admin=$_SESSION["Username"];
   $Query="UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$IdFromURL'"; 
    $Execute=mysqli_query($Connection,$Query);
    if($Execute)
    {
    	$_SESSION["SuccessMessage"]="Comment Approved Succesfully";
         Redirect_to("Comments.php");}
    	else
    	{
    		$_SESSION["ErrorMessage"]="Something went Wrong";
    		 Redirect_to("Comments.php");
    	}
    }



?>