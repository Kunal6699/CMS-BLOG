<?php require_once("include/DB.php");?>   <!-- req once se function dusra file me likh kar usko include karna  -->

<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login();?>
<?php
if(isset($_POST["Submit"]))
{
$Username=$_POST["Username"];
$Password=$_POST["Password"];
$ConfirmPassword=$_POST["ConfirmPassword"];


 date_default_timezone_set("Asia/Kolkata");
 $CurrentTime=time();  
 //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
 $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];
if(empty($Username)||empty($Password)||empty($ConfirmPassword))
{
	$_SESSION["ErrorMessage"] ="All fields must be filled out";
	/*header("Location:dashboard.php");
	exit; */
	Redirect_to("Admins.php");
}
elseif(strlen($Password)<4)
{
	$_SESSION["ErrorMessage"]="Atleast 4 characters required";
	Redirect_to("Admins.php");
}
   elseif ($Password!==$ConfirmPassword) {
     
     $_SESSION["ErrorMessage"]="Password / ConfirmPassword does not match";
   }

  else
  { 
  	$Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
  	$Query="INSERT INTO registration(datetime,username,password,addedby)
  	 VALUES('$DateTime','$Username','$Password','$Admin')";
  	 $Execute=mysqli_query($Connection,$Query);
     if($Execute)
     {
     	$_SESSION["SuccessMessage"]="Admin Added Successfully";
     	Redirect_to("Admins.php");
     }
     else
     {
     	$_SESSION["ErrorMessage"]="Admin failed to Add";
     	Redirect_to("Admins.php");

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
     <div class="collapse navbar-collapse" id="collapse">
     <ul class="nav navbar-nav">
    <li><a href="#"> Home </a></li>
       <li class="active"><a href="Blog.php" target="_blank"> Blog </a></li>
        <li><a href="#"> About us </a></li>
          <li><a href="#"> Services </a> </li>
           <li><a href="#"> Contact Us</a> </li>
       <li><a href="#"> Features </a> </li>
                      

</ul>

<form action="Blog.php" class="navbar-form navbar-right">
  <div class="form-group">
    <input type="text" name="Search" class="form-control" placeholder="Search"></div>
    <button class="btn btn-default" name="SearchButton">Go</button>

</form>
</div>
     </div>
              </nav>     
<div class="Line" style="height: 10px; background-color: #27aae1 ;"></div>
<div class="container-fluid">
<div class="row">
	<div class="col-sm-2"> 
		<h1> Kunal </h1>
     <ul id="Side_Menu" class="nav nav-pills nav-stacked">
     	<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; Dashboard</a></li>
     	<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"> </span> &nbsp;Add New Post </a></li>
     	<li><a href="categories.php"><span class="glyphicon glyphicon-tags"> </span> &nbsp;Categories </a></li>
        <li class="active"><a href="Admins.php"><span class="glyphicon glyphicon-user"> </span> &nbsp;Manage Admins </a></li>
     	<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"> </span> &nbsp;Comments </a></li>
     	<li><a href="Blog.php"><span class="glyphicon glyphicon-equalizer"> </span> &nbsp;Live Blog </a></li>
     	<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"> </span> &nbsp;Logout </a></li>
     	
     </ul>


	</div>  <!-- End of side area -->
    <div class="col-sm-10">
    	<h1>Manage Admin Access </h1>

         <?php echo Message(); echo SuccessMessage(); ?>



	  <div>
	  	 <form action="Admins.php" method="Post">
	  	 	 <fieldset>
	  	 	 	<div class="form-group">                                              

	  	 	 	<label for="Username"><span class="FieldInfo">UserName:</span>  </label>
	  	 	 	<!--  input ka id same as label ka for  -->
	  	 	 	<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                </div>
<div class="form-group">                                     
          <label for="Password"><span class="FieldInfo">Password:</span>  </label>
          <!--  input ka id same as label ka for  -->
          <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
                </div>
                <div class="form-group">                                              
          <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span>  </label>
          <!--  input ka id same as label ka for  -->
          <input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder="ConfirmPassword">
                </div>

                 <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin">


	  	 	 </fieldset>
           <br> 

	  	 </form>


	  </div>
     <div class="table-responsive"> <!-- bt class make table rspnsv-->
     	   <table class="table table-striped table-hover">
     	   	
           <tr>
           	      <th>Sr No.</th>
           	      <th>Date & Time</th>
           	      <th>Admin Name</th>
           	      <th>Added By</th>
                  <th>Action</th>

           </tr>
     <?php 
          

        $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');


          $ViewQuery="SELECT * FROM registration ORDER BY datetime desc"; 
          /* Jo abhi bana he wo uapr show hoga*/
          $Execute=mysqli_query($Connection,$ViewQuery);
          $SrNo=0;
           while($DataRows=mysqli_fetch_array($Execute,MYSQLI_ASSOC))
           {
           	$Id=$DataRows["id"];
           	$DateTime=$DataRows["datetime"];
           	$UserName=$DataRows["username"];
           	$Admin=$DataRows["addedby"];

              $SrNo++;


            

     ?>
          <tr>
          	  <td><?php echo $SrNo; ?></td>
          	  <td><?php echo $DateTime; ?></td>
          	  <td><?php echo $UserName; ?></td>
          	  <td><?php echo $Admin; ?></td>
              <td><a href="DeleteAdmin.php?id=<?php echo $Id; ?>"> 
                <span class="btn btn-danger"> Delete</span>
               </a></td>
            

          </tr>
        

  <?php }?>
     	   </table>

     </div> 


	</div> <!-- End of main Area -->
</div>  <!-- End of row -->
</div>   <!-- Ending of container -->

<div id="Footer">
  <hr><p> Theme By | Kunal Kumar |&copy; 2019-2020 ----- All Rights Reserved.
  </p>
  <a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold; " href="#">
  <p>
    This site is only used only for educational purposes kunalkumar.com has all rights reserved. 

  </p>  
  </a>
</div>



</body>
</html>