<?php require_once("include/DB.php");?>   <!-- req once se function dusra file me likh kar usko include karna  -->

<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login();?>
<?php
if(isset($_POST["Submit"]))
{
$Category=$_POST["Category"];
 date_default_timezone_set("Asia/Kolkata");
 $CurrentTime=time();  
 //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
 $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];
if(empty($Category))
{
	$_SESSION["ErrorMessage"] ="All fields must be filled out";
	/*header("Location:dashboard.php");
	exit; */
	Redirect_to("dashboard.php");
}
elseif(strlen($Category)>99)
{
	$_SESSION["ErrorMessage"]="Too long Name";
	Redirect_to("categories.php");
}
  else
  { 
  	$Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
  	$Query="INSERT INTO category(datetime,name,creatorname)
  	 VALUES('$DateTime','$Category','$Admin')";
  	 $Execute=mysqli_query($Connection,$Query);
     if($Execute)
     {
     	$_SESSION["SuccessMessage"]="Category Added Successfully";
     	Redirect_to("categories.php");
     }
     else
     {
     	$_SESSION["ErrorMessage"]="Category failed to Add";
     	Redirect_to("categories.php");

     }
   

  }




}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard </title>
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
<div class="container-fluid">
<div class="row">
	<div class="col-sm-2"> 
		<h1> Kunal </h1>
     <ul id="Side_Menu" class="nav nav-pills nav-stacked">
     	<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; Dashboard</a></li>
     	<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"> </span> &nbsp;Add New Post </a></li>
     	<li  class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags"> </span> &nbsp;Categories </a></li>
        <li><a href="Admins.php"><span class="glyphicon glyphicon-user"> </span> &nbsp;Manage Admins </a></li>
     	<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"> </span> &nbsp;Comments </a></li>
     	<li><a href="Blog.php"><span class="glyphicon glyphicon-equalizer"> </span> &nbsp;Live Blog </a></li>
     	<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"> </span> &nbsp;Logout </a></li>
     	
     </ul>


	</div>  <!-- End of side area -->
    <div class="col-sm-10">
    	<h1>Manage Categories </h1>

         <?php echo Message(); echo SuccessMessage(); ?>



	  <div>
	  	 <form action="categories.php" method="Post">
	  	 	 <fieldset>
	  	 	 	<div class="form-group">                                              

	  	 	 	<label for="categoryname"><span class="FieldInfo">Name:</span>  </label>
	  	 	 	<!--  input ka id same as label ka for  -->
	  	 	 	<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
                </div>
                 <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">


	  	 	 </fieldset>
           <br> 

	  	 </form>


	  </div>
     <div class="table-responsive"> <!-- bt class make table rspnsv-->
     	   <table class="table table-striped table-hover">
     	   	
           <tr>
           	      <th>Sr No.</th>
           	      <th>Date & Time</th>
           	      <th>Category Name</th>
           	      <th>Creator Name</th>
                  <th>Action</th>

           </tr>
     <?php 
          

        $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');


          $ViewQuery="SELECT * FROM category ORDER BY datetime desc"; 
          /* Jo abhi bana he wo uapr show hoga*/
          $Execute=mysqli_query($Connection,$ViewQuery);
          $SrNo=0;
           while($DataRows=mysqli_fetch_array($Execute,MYSQLI_ASSOC))
           {
           	$Id=$DataRows["id"];
           	$DateTime=$DataRows["datetime"];
           	$CategoryName=$DataRows["name"];
           	$CreatorName=$DataRows["creatorname"];

              $SrNo++;


            

     ?>
          <tr>
          	  <td><?php echo $SrNo; ?></td>
          	  <td><?php echo $DateTime; ?></td>
          	  <td><?php echo $CategoryName; ?></td>
          	  <td><?php echo $CreatorName; ?></td>
              <td><a href="DeleteCategory.php?id=<?php echo $Id; ?>"> 
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