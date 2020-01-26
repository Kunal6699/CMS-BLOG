<?php require_once("include/DB.php");?> 
<?php require_once("include/Sessions.php")?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login();?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/adminstyles1.css">

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
		<br><br>
     <ul id="Side_Menu" class="nav nav-pills nav-stacked">
     	<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp; Dashboard</a></li>
     	<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"> </span> &nbsp;Add New Post </a></li>
        <li><a href="categories.php"><span class="glyphicon glyphicon-tags"> </span> &nbsp;Categories </a></li>
        <li><a href="Admins.php"><span class="glyphicon glyphicon-user"> </span> &nbsp;Manage Admins </a></li>
     	<li class="active"><a href="Comments.php"><span class="glyphicon glyphicon-comment"> </span> &nbsp;Comments </a></li>
     	<li><a href="Blog.php"><span class="glyphicon glyphicon-equalizer"> </span> &nbsp;Live Blog </a></li>
     	<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"> </span> &nbsp;Logout </a></li>
     	
     </ul>


	</div>  <!-- End of side area --> 

	<div class="col-sm-10">  <!-- Main Area  -->

         <div><?php echo Message(); echo SuccessMessage(); ?> </div>
		<h1> UnApproved Comments </h1>
		<div class="table-responsive">
			<table class="table table-striped">
				
				<tr>
            <th>No.</th>
            <th>Name</th>
            <th>Date</th>
            <th>Comment</th>
            <th>Approve</th>
            <th>Delete Comment</th>
            <th>Details</th>
        </tr>
        <?php
           $Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');

        $Query="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc";
        $Execute=mysqli_query($Connection,$Query);
         $SrNo=0;
         while($DataRows=mysqli_fetch_array($Execute,MYSQLI_ASSOC))
         {
         	$CommentId=$DataRows['id'];
         	$DateTimeofComment=$DataRows['datetime'];
         	$PersonName=$DataRows['name'];
         	$PersonComment=$DataRows['comment'];
            $CommentedPostId=$DataRows['admin_panel_id']; 
              $SrNo++;
              if(strlen($PersonName)>10)
             { $PersonName=substr($PersonName,0,10).'...';}

            ?>
            <tr>
            	<td><?php echo $SrNo;?></td>
            	<td style="color: #5e5eff;"><?php echo $PersonName;?></td>
            	<td><?php echo $DateTimeofComment;?></td>
            	<td><?php echo $PersonComment;?> </td>
            	<td><a href="ApproveComments.php?id=<?php echo htmlentities($CommentId);?>"><span class="btn btn-success">Approve</span></a></td>
               <td><a href="DeleteComments.php?id=<?php echo $CommentId;?>">
                  <span class="btn btn-danger">Delete</span></a></td>
                <td><a href="FullPost.php?id=<?php echo $CommentedPostId;?>" target="_blank"><span class="btn btn-primary">Live Preview </span></a></td>
           

            </tr>
        <?php } ?>



			</table>
		</div>
           
      <h1> Approved Comments </h1>
		<div class="table-responsive">
			<table class="table table-striped">
				
				<tr>
            <th>No.</th>
            <th>Name</th>
            <th>Date</th>
            <th>Comment</th>
            <th>Approved By</th>
            <th>Revert Approve</th>
            <th>Delete Comment</th>
            <th>Details</th>
        </tr>
        <?php
           $Connection=mysqli_connect('localhost','root','');
  	$ConnectingDB=mysqli_select_db($Connection,'phpcms');
       
       
        $Query="SELECT * FROM comments WHERE status='ON' ORDER by datetime desc";
        $Execute=mysqli_query($Connection,$Query);
         $SrNo=0;
         while($DataRows=mysqli_fetch_array($Execute,MYSQLI_ASSOC))
         {
         	$CommentId=$DataRows['id'];
         	$DateTimeofComment=$DataRows['datetime'];
         	$PersonName=$DataRows['name'];
         	$PersonComment=$DataRows['comment'];
            $ApprovedBy=$DataRows['approvedby'];
            $CommentedPostId=$DataRows['admin_panel_id']; 
              $SrNo++;

             
              if(strlen($PersonName)>10)
             { $PersonName=substr($PersonName,0,10).'...';}
            ?>
            <tr>
            	<td><?php echo $SrNo;?></td>
            	<td style="color:#5e5eff;"><?php echo $PersonName;?></td>
            	<td><?php echo $DateTimeofComment;?></td>
            	<td><?php echo $PersonComment;?> </td>
            

             <td><?php echo $ApprovedBy;?></td>

            	<td><a href="DisApproveComments.php?id=<?php echo $CommentId;?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
                <td><a href="DeleteComments.php?id=<?php echo $CommentId;?>">
                  <span class="btn btn-danger">Delete</span></a></td>
                 <td><a href="FullPost.php?id=<?php echo $CommentedPostId;?>" target="_blank"><span class="btn btn-primary">Live Preview </span></a></td>
           

            </tr>
        <?php } ?>



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