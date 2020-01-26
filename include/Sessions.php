<?php 

session_start();
function Message()
{
	if(isset($_SESSION["ErrorMessage"]))
	{
		$Output="<div class=\"alert alert-danger\">"; /*\ used to escape  as quotation inside quotation not allowed character */
         
          $Output.=htmlentities($_SESSION["ErrorMessage"]);
             
           $Output.="</div>";
            $_SESSION["ErrorMessage"]=null;  /* taaki starting me null error aaye */

           return $Output;
        

	}
} 
     function SuccessMessage()
{
	if(isset($_SESSION["SuccessMessage"]))
	{
		$Output="<div class=\"alert alert-success\">"; /*\ used to escape  as quotation inside quotation not allowed character */
         
          $Output.=htmlentities($_SESSION["SuccessMessage"]);
             
           $Output.="</div>";
            $_SESSION["SuccessMessage"]=null;  /* taaki starting me null error aaye */

           return $Output;
        

	}
} 




?>