<?php






$sql = "SELECT Email,School FROM addTeach";
$result = $conn->query($sql);
//$row = $result->fetch_assoc();

echo "<div class='panel panel-primary'>
      <div class='panel-heading'>Add Teacher</div>
		  <div class='panel-body'>
		  <div class='panel panel-primary'>
		   <form action = 'addTeacherAction.php' method = 'post'>";

if($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<input type='checkbox' name='thing[]' value= ' " . $row["Email"] . " ' >&nbsp&nbsp&nbsp&nbsp" . $row["Email"] . "&nbsp-&nbsp" . $row["School"] . "<br>";
    $counter++;
	}

}

echo "
		  </div>
		  
				<button type='submit' class='btn btn-primary' name='selection' value='add'>Add</button>
				<button type='submit' class='btn btn-primary' name='selection' value='deny'>Deny</button>
				</form> 
				<a href ='Admin.php'>
				<button type='button' class='btn btn-success'>Cancel</button>
				</a>
				
		  </div>
    </div>";


?>
