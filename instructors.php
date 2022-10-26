<?php require_once("header.php"); ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Instructors</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php
$servername = "localhost";
$username = "amiresta_amirsta";
$password = "z]0qP-?ge@PG";
$dbname = "amiresta_HW3-instructors-database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT instructor_id, instructor_name from instructor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
    

    
  <tr>
    <td><?=$row["instructor_id"]?></td>
    <td><a href="instructor-section.php?id=<?=$row["instructor_id"]?>"><?=$row["instructor_name"]?></a></td>

  </tr>
    
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addinstructor">
        Add New
      </button>
    
    
    
    
    <div class="modal fade" id="addinstructor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addinstructorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addinstructor">Add Customer</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="customerName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="cName" aria-describedby="nameHelp" name="cName">
                  <div id="nameHelp" class="form-text">Enter the Customer's name.</div>
                   <label for="EmployeeID" class="form-label">Employee ID</label>
                   <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="eid">
                   <div id="nameHelp" class="form-text">Enter the Employee's ID</div>
                          <label for="ProductName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" id="pName" aria-describedby="nameHelp" name="pName">
                          <div id="nameHelp" class="form-text">Enter the Product Name</div>
                          <label for="ProductCost" class="form-label">Product Cost</label>
                          <input type="text" class="form-control" id="pCost" aria-describedby="nameHelp" name="pCost">
                          <div id="nameHelp" class="form-text">Enter the Product's cost</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    
    
    
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  
    
   
  </body>
</html>
