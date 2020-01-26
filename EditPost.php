<?php require_once("include/DB.php");?>   <!-- req once se function dusra file me likh kar usko include karna  -->

<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login();?>
<?php
if(isset($_POST["Submit"]))
{
$Title=$_POST["Title"];
$Category=$_POST["Category"];
$Post=$_POST["Post"];

 date_default_timezone_set("Asia/Kolkata");
 $CurrentTime=time();  
 //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
 $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;
$Admin="Kunal Kumar";
$Image=$_FILES["Image"]["name"]; /* super Global */
$Target="Upload/".basename($_FILES["Image"]["name"]);

if(empty($Title))
{
	$_SESSION["ErrorMessage"] ="Title cant be empty";
	/*header("Location:dashboard.php");
	exit; */
	Redirect_to("AddNewPost.php");
}
elseif(strlen($Title)<2)
{
	$_SESSION["ErrorMessage"]="Title atleat 2";
	Redirect_to("AddNewPost.php");
}
  else
  { 
  	$Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
    
    $EditFromURL=$_GET['Edit'];
  	$Query="UPDATE admin_panel SET datetime='$DateTime',title='$Title',category='$Category',author='$Admin',image='$Image',post='$Post' WHERE id='$EditFromURL'";


  	 $Execute=mysqli_query($Connection,$Query);
       move_uploaded_file($_FILES["Image"]["tmp_name"],$Target); // move karne k lye
       //move_uploaded_file(filename, destination)

     if($Execute)
     {
     	$_SESSION["SuccessMessage"]="Post Updated Successfully";
     	Redirect_to("AddNewPost.php");
     }
     else 
     {
     	$_SESSION["ErrorMessage"]="Something went wrong";
     	Redirect_to("AddNewPost.php");

     }
   

  }




}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Post </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/adminstyles.css">

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
     	<li  class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"> </span> &nbsp;Add New Post </a></li>
     	<li><a href="categories.php"><span class="glyphicon glyphicon-tags"> </span> &nbsp;Categories </a></li>
        <li><a href="#"><span class="glyphicon glyphicon-user"> </span> &nbsp;Manage Admins </a></li>
     	<li><a href="#"><span class="glyphicon glyphicon-comment"> </span> &nbsp;Comments </a></li>
     	<li><a href="#"><span class="glyphicon glyphicon-equalizer"> </span> &nbsp;Live Blog </a></li>
     	<li><a href="#"><span class="glyphicon glyphicon-log-out"> </span> &nbsp;Add New Post </a></li>
     	
     </ul>


	</div>  <!-- End of side area -->
    <div class="col-sm-10">
    	<h1>Update Post </h1>

         <?php echo Message(); echo SuccessMessage(); ?>
          


	  <div>

        <?php
        $SearchQueryParameter=$_GET['Edit'];
        $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');
         $Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
         $ExecuteQuery=mysqli_query($Connection,$Query);
         while($DataRows=mysqli_fetch_array($ExecuteQuery))
         {
              $TitleToBeUpdated=$DataRows['title'];
               $CategoryToBeUpdated=$DataRows['category'];
               $ImageToBeUpdated=$DataRows['image'];
                $PostToBeUpdated=$DataRows['post'];


         }
        ?>

	  	 <form action="EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>" method="Post" enctype="multipart/form-data">
	  	 	 <fieldset>
	  	 	 	<div class="form-group">                                              
	  	 	 	<label for="title"><span class="FieldInfo">Title:</span>  </label>
	  	 	 	<!--  input ka id same as label ka for  -->
	  	 	 	<input value="<?php echo $TitleToBeUpdated;?>"class="form-control" type="text" name="Title" id="title" placeholder="Title">

                </div>
                     
                  <div class="form-group">                 
                  <span class="FieldInfo"> Existing Category: </span>
                <?php echo $CategoryToBeUpdated;?>
                <br>

	  	 	 	<label for="categoryselect"><span class="FieldInfo">Category:</span>  </label>
                 <select class="form-control" id="categoryselect" name="Category">
                 	
                 <?php 
          

        $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');


          $ViewQuery="SELECT * FROM category ORDER BY datetime desc"; 
          /* Jo abhi bana he wo uapr show hoga*/
          $Execute=mysqli_query($Connection,$ViewQuery);
         
           while($DataRows=mysqli_fetch_array($Execute,MYSQLI_ASSOC))
           {
           	$Id=$DataRows["id"];
          
           	$CategoryName=$DataRows["name"];
          
     ?>
          <option><?php echo $CategoryName; ?></option>   
                 
             <?php } ?>
                 
                 </select>
                </div>

                 <div class="form-group">  
                   <span class="FieldInfo"> Existing Image: </span>
                <img src="Upload/<?php echo $ImageToBeUpdated;?>" width=170px; height=75px;>
                <br>

	  	 	 	<label for="imageselect"><span class="FieldInfo">Select Image:</span>  </label>
	  	 	 	<input type="File" name="Image" class="form-control" id="imageselect">
                 </div>
                    <div class="form-group">                                              
	  	 	 	<label for="postarea"><span class="FieldInfo">Post:</span>  </label>
                    
                 <textarea class="form-control" name="Post" id="postarea">  
                   <?php echo $PostToBeUpdated; ?> 
                   </textarea> 
                 <br>
                 <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Post">


	  	 	 </fieldset>
           <br> 

	  	 </form>


	  </div>
     
     
        


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