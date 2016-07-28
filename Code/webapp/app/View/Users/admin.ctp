
<body>


  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      
    </div>
    <div class="col-sm-8 text-left">
      <div class="well">

	
	<div class="panel-group">
  <div class="panel panel-primary">
      <div class="panel-heading">Add Evaluator</div>
		  <div class="panel-body">
				 <a href="addEvaluator">Visit requests(
				 <?php
				
				
				$sql = "SELECT	COUNT(*) as aCount FROM addTeach";
				$result = $conn->query($sql);
				$row=$result->fetch_assoc();
				echo $row["aCount"];

				
				
				 ?>
				 
				 )</a> 
		  
		  </div>
    </div>
	
	
 
</div>



	
	
	</div>
     
	  </div>
   
	
	</div>
    
  </div>
</div>

<a href="home">
		<input type="button" class="btn btn-success center-block" value="Back"></button>
		</a>

</body>
</html>

