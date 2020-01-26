<?php require_once("include/DB.php");?>   <!-- req once se function dusra file me likh kar usko include karna  -->

<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>


<?php
if(isset($_POST["Submit"]))
{
$Name=$_POST["Name"]; 
$Email=$_POST["Email"];
$Comment=$_POST["Comment"];

 date_default_timezone_set("Asia/Kolkata");
 $CurrentTime=time();  
 //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
 $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;

$PostId=$_GET["id"];

if(empty($Name)||empty($Email)||empty($Comment))
{
  $_SESSION["ErrorMessage"] ="All Fields are reqd.";
  /*header("Location:dashboard.php");
  exit; */
  
}
elseif(strlen($Comment)>500)
{
  $_SESSION["ErrorMessage"]="Only 500 chaacters allowed.";
  
}
  else
  { 
    $Connection=mysqli_connect('localhost','root','');
    $ConnectingDB=mysqli_select_db($Connection,'phpcms');
    $PostIDFromURL=$_GET['id'];
    $Query="INSERT into comments (datetime,name,email,comment,approvedby,status,admin_panel_id)
     VALUES('$DateTime','$Name','$Email','$Comment','Pending','OFF','$PostIDFromURL')";
     $Execute=mysqli_query($Connection,$Query);

     if($Execute)
     {
      $_SESSION["SuccessMessage"]="Comment Submitted  Successfully";
      Redirect_to("FullPost.php?id={$PostId}");
     }
     else 
     {
      $_SESSION["ErrorMessage"]="Something went wrong";
     Redirect_to("FullPost.php?id={$PostId}");

     }
   

  }




}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Full Blog Post </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/naya.css">
   <style type="text/css">
   	

   	.col-sm-3
   	{
   		background-color: green;
   	}
      .FieldInfo
      {
        color: rgb(251,174,44);
        font-family: Bitter,Georgia,"Times New Roman",Times,serif;
        font-size: 1.2em;
      }  
      
      .CommentBlock
      {
        background-color: #F6F7F9;
      }
        .Comment-info
        {
          color: #365899;
          font-family: sans-serif;
          font-size: 1.1em;
          font-weight: bold;
          padding-top: 10px;

        }
        .comment
        {
           margin-top: -2px;
           padding-top: 10px;
           font-size: 1.1em;

        }


   </style>


</head>
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
       <li class="active"><a href="#"> Blog </a></li>
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

<div class="container">   <!-- Container -->
	<div class="blog-header">
	<h1> The Complete Responsive CMS Blog </h1>
    <p class="lead"> Complete Blog Using PHP by Kunal Kumar </p>
     </div>


  <div class="row">
  	<div class="col-sm-8">  <!-- Main Blog Area -->
      <?php
       echo Message();
       echo SuccessMessage();

      ?>
      <?php
        $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');
          
        if(isset($_GET["SearchButton"]))
        {
        	$Search=$_GET["Search"];
             $ViewQuery="SELECT * FROM admin_panel WHERE 
             datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
        }  

          else
         {
         	$PostIDFromURL=$_GET["id"];
       $ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL' ORDER BY datetime desc";}
       $Execute=mysqli_query($Connection,$ViewQuery);
        while($DataRows=mysqli_fetch_array($Execute))
        {
        	$PostId=$DataRows["id"];
        	$DateTime=$DataRows["datetime"];
        	$Title=$DataRows["title"];
        	$Category=$DataRows["category"];
        	$Admin=$DataRows["author"];
        	$Image=$DataRows["image"];
        	$Post=$DataRows["post"];
        

      ?>
             <div class="blogpost thumbnail">
             <img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>">
           <div class="caption"> 
            <h1 id="heading"><?php echo htmlentities($Title);?></h1>

             <p class="description">Category:<?php echo htmlentities($Category);?> Published on <?php echo htmlentities($DateTime);?></p>
            <p class="post"><?php
            
                 echo nl2br($Post); ?></p>
      </div>

     


       </div>
     <?php } ?>
     <br><br>

       <span class="FieldInfo">Comments</span>
       <?php
               $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');
        $PostIdForComments=$_GET["id"];
        $ExtractingCommentsQuery="SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments' AND 
        status='ON'";
        $Execute=mysqli_query($Connection,$ExtractingCommentsQuery);
        while($DataRows=mysqli_fetch_array($Execute))
        {
          $CommentDate=$DataRows["datetime"];
          $CommenterName=$DataRows["name"];
          $Comments=$DataRows["comment"];

        


       ?>
       <div class="CommentBlock">
          <img style="margin-left:10px; margin-top: 10px; " class="pull-left" src="img/avatar.png" width=100px; height=70px;>
          <p style="margin-left: 120px;" class="Comment-info"><?php echo $CommenterName;?></p>
         <p style="margin-left: 120px;"class="description"><?php echo $CommentDate;?></p>
         <p style="margin-left: 120px;" class="Comment"><?php echo nl2br($Comments);?></p>
 
    </div>
    <hr>
     <?php } ?>

             <span class="FieldInfo">Share your thoughts about this Post</span>

      <div>
       <form action="FullPost.php?id=<?php echo $PostId;?>" method="Post" enctype="multipart/form-data">
         <fieldset>
          <div class="form-group">                                              
          <label for="Name"><span class="FieldInfo">Name:</span>  </label>
          <!--  input ka id same as label ka for  -->
          <input class="form-control" type="text" name="Name" id="name" placeholder="Name">

                </div>

                <div class="form-group">                                              
          <label for="Email"><span class="FieldInfo">Email:</span>  </label>
          <!--  input ka id same as label ka for  -->
          <input class="form-control" type="Email" name="Email" id="Email" placeholder="Email">

                </div>
                   

                    <div class="form-group">                                              
          <label for="commentarea"><span class="FieldInfo">Comment</span>  </label>
                    
                 <textarea class="form-control" name="Comment" id="commentarea"></textarea>   

                 <br>
                 <input class="btn btn-primary" type="Submit" name="Submit" value="Submit">


         </fieldset>
           <br> 
        

       </form>


    </div>
     
  	</div>  <!-- Main Blog Area Ending  -->

     <div class="col-sm-offset-1 col-sm-3">
     	<h2>Test </h2>
     <p>Facilisis magna etiam tempor orci eu lobortis. Lobortis mattis aliquam faucibus purus in massa. Proin fermentum leo vel orci porta non pulvinar. Vehicula ipsum a arcu cursus vitae. Diam maecenas sed enim ut sem viverra aliquet eget sit. Mauris pharetra et ultrices neque ornare aenean euismod elementum. Donec et odio pellentesque diam. Magna eget est lorem ipsum.</p>

     </div> <!-- Side Area Ending  -->

  </div> <!-- Row Ending -->
</div>  <!-- Container Enmding  -->

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