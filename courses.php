<?php require_once("header.php"); ?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Courses</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Prefix</th>
      <th>Number</th>
      <th>Description</th>
      <th></th>
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

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into course (course_number) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['iName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New course added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update course set course_number=? where course_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['iName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">course edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from course where course_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">course deleted.</div>';
      break;
  }
}
?>
    
      <h1>course</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
<?php
$sql = "SELECT course_id, course_number from course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["course_id"]?></td>
            <td><a href="course-section.php?id=<?=$row["course_id"]?>"><?=$row["course_number"]?></a></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editcourse<?=$row["course_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editcourse<?=$row["course_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editcourse<?=$row["course_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editcourse<?=$row["course_id"]?>Label">Edit course</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editcourse<?=$row["course_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editcourse<?=$row["course_id"]?>Name" aria-describedby="editcourse<?=$row["course_id"]?>Help" name="iName" value="<?=$row['course_number']?>">
                          <div id="editcourse<?=$row["course_id"]?>Help" class="form-text">Enter the course's name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['course_id']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="iid" value="<?=$row["course_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
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
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcourse">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addcourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addcourseLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addcourseLabel">Add course</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="courseName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="courseName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the course's name.</div>
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
