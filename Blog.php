<?php require_once("include/DB.php");?>   <!-- req once se function dusra file me likh kar usko include karna  -->

<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>


<!DOCTYPE html>
<html>
<head>
	<title> Blog Page </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/naya.css">
   <style type="text/css">
   	

   	.col-sm-3
   	{
   		background-color: green;
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
        $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');
            
        if(isset($_GET["SearchButton"]))
        {
        	$Search=$_GET["Search"];
           // Query When search button is active..

             $ViewQuery="SELECT * FROM admin_panel WHERE 
             datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
        }
        elseif (isset($_GET["Page"]))
         {

          $Page=$_GET["Page"];

          if($Page<1)
           $ShowPostFrom=0;
           else{
                   $ShowPostFrom=($Page*5)-5;

               }                                              
                                                          
            //Query When Pagination is active i.e. Blog.php?Page=1
          $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT  $ShowPostFrom,5";
 
        }

          // Default query for Blog.php
          else
         {
           

       $ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";}  /* from 0 index se 5 tho*/
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
            if(strlen($Post)>150)
            { 
            	$Post=substr($Post,0,150).'...';
            }
                 echo $Post; ?></p>
      </div>

      <a href="FullPost.php?id=<?php echo $PostId; ?>">
       <span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>


       </div>
        <!-- Creating Backward button  -->
     <?php } ?>
      <nav>
        <ul class="pagination pull-left pagination-lg">

        <?php
        if(isset($Page))
        {
        if($Page>1)
        {
           ?>  
           <li><a href="Blog.php?Page=<?php echo $Page-1;?>"> &laquo; </a></li>

     <?php   }
     }
      ?>
       
  

     <?php
          $Connection=mysqli_connect('localhost','root','');
        $ConnectingDB=mysqli_select_db($Connection,'phpcms');
          $QueryPagination="SELECT COUNT(*) FROM admin_panel";
          $ExecutePagination=mysqli_query($Connection,$QueryPagination);
          $RowPagination=mysqli_fetch_array($ExecutePagination);
          $TotalPosts=array_shift($RowPagination);
            // to count total entries....
        /*  echo $TotalPosts;*/
          $PostPagination=ceil($TotalPosts/5);
          /*echo $PostPerPage;*/
           for($i=1;$i<=$PostPagination;$i++)
           {
            if(isset($Page)){
            if($i==$Page){
     ?>     

     <li class="active"><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
      <?php } 
        else
        { ?>
          <li><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i;?></a></li>
        <?php
      } 

      }
      } 
      ?>
          <!-- Creating Forward button  -->

      <?php
        if(isset($Page))
        {
        if($Page+1<=$PostPagination)
        {
           ?>  
           <li><a href="Blog.php?Page=<?php echo $Page+1;?>"> &raquo; </a></li>

     <?php   }
     }
      ?>
        


</ul>
</nav>
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