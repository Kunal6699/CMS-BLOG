<?php require_once("include/DB.php");?> 
<?php require_once("include/Sessions.php")?>


<?php
function Redirect_to($New_location)
{
	header("Location:".$New_location);
	exit;
}
 
   function Login_Attempt($Username,$Password)
   {
       	$Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
     $Query="SELECT * FROM registration WHERE username='$Username' And password='$Password'";
     $Execute=mysqli_query($Connection,$Query);
     if($admin=mysqli_fetch_assoc($Execute))
     {
     	return $admin;
     }
       else
       {
       	return null;
       }


   }

     function Login()
     {
     	if(isset($_SESSION["User_Id"])) /*pichla page pe session wala message create kiye hue he */
     	{
     		return true;
     	}
     }
      function Confirm_Login()
      {
      	if(!Login())
      	{
      		$_SESSION["ErrorMessage"]="Login Required";
      		Redirect_to("Login.php");
      	}
      }





?>