<?php require_once("include/DB.php");?>   <!-- req once se function dusra file me likh kar usko include karna  -->

<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["Submit"]))
{
$Username=$_POST["Username"];
$Password=$_POST["Password"];




 //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
 


if(empty($Username)||empty($Password))
{
	$_SESSION["ErrorMessage"] ="All fields must be filled out";
	/*header("Location:dashboard.php");
	exit; */
	Redirect_to("Login.php");
}


  else
  { 
  	$Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
   $Found_Account=Login_Attempt($Username,$Password);
   $_SESSION["User_Id"]=$Found_Account["id"];
    $_SESSION["Username"]=$Found_Account["username"];

   if($Found_Account)
   {
    $_SESSION["SuccessMessage"]="Welcome {$_SESSION["Username"]}";
    Redirect_to("dashboard.php");
   }  
   else {
            $_SESSION["ErrorMessage"]="Invalid password / username";
    Redirect_to("Login.php");
   }
   

  }




}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Admins </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/adminstyles1.css">

</head>
<style type="text/css">
	
	.FieldInfo
	{
		color: rgb(251,174,44);
		font-family: Bitter,Georgia,"Times New Roman",Times,serif;
		font-size: 1.2em;
	}
   body
   {
    background-color: #fff;
   }


</style>
<body>
  <div style="height: 10px; background-color: #27aae1 ;"></div>
     <nav class="navbar navbar-inverse" role="navigation">
     <div class="container">
       <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#collapse"
       >
        <span class="sr-only">Toggle Navigation </span>
        <!-- sr  screen readers  -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

       </button>


       <a class="navbar-brand" href="Blog.php ">
        <img style="margin-top: -15px;" src="img/kk.jpg" width=50;height=5;>
</a>
     </div>
    


</div>
     
              </nav>     
<div class="Line" style="height: 10px; background-color: #27aae1 ;"></div>
<div class="container-fluid">
<div class="row">
	
    <div class="col-sm-offset-4 col-sm-4">
    

         <?php echo Message(); echo SuccessMessage(); ?>


          <h1>Welcome Back </h1><br><br>
	  <div>
	  	 <form action="Login.php" method="Post">
	  	 	 <fieldset>
	  	 	 	<div class="form-group"> 
                                                                                 

	  	 	 	<label for="Username"><span class="FieldInfo">UserName:</span>  </label>
          <div class="input-group input-group-lg">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-envelope text-primary">
              </span>
            </span> 
	  	 	 	<!--  input ka id same as label ka for  -->
	  	 	 	<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                </div>
       <div class="form-group">                                     
         

         
             <label for="Password"><span class="FieldInfo">Password:</span>  </label>

             <div class="input-group input-group-lg">
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-lock text-primary">
              </span>
            </span>
          <!--  input ka id same as label ka for  -->
          <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
                </div>
               
                 <br><br>
                 <input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">


	  	 	 </fieldset>
           <br> 

	  	 </form>




	</div> <!-- End of main Area -->
</div>  <!-- End of row -->
</div>   <!-- Ending of container -->





</body>
</html>