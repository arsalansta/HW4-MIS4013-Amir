<?php require_once("header.php"); ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobs and Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    
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




if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into JobsAndRoles (job_name) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['iName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New JobsAndRoles added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update JobsAndRoles set job_name=? where job_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['iName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">JobsAndRoles edited.</div>';
      break;
    case 'Delete':
     
      $sqlDelete = "delete from JobsAndRoles where job_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">JobsAndRoles deleted.</div>';
      break;
  }
}
?>
    
      <h1>JobsAndRoles</h1>
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
$sql = "SELECT job_id, job_name from JobsAndRoles";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["job_id"]?></td>
            <td><a href="instructor-section.php?id=<?=$row["job_id"]?>"><?=$row["job_name"]?></a></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editJobsAndRoles<?=$row["job_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editJobsAndRoles<?=$row["job_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editJobsAndRoles<?=$row["job_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editJobsAndRoles<?=$row["job_id"]?>Label">Edit JobsAndRoles</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editJobsAndRoles<?=$row["job_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editJobsAndRoles<?=$row["job_id"]?>Name" aria-describedby="editJobsAndRoles<?=$row["job_id"]?>Help" name="iName" value="<?=$row['job_name']?>">
                          <div id="editJobsAndRoles<?=$row["job_id"]?>Help" class="form-text">Enter the Jobs or Roles </div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['job_id']?>">
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
                <input type="hidden" name="iid" value="<?=$row["job_id"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobsAndRoles">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addJobsAndRoles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addJobsAndRolesLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addJobsAndRolesLabel">Add Job or Role</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="JobsAndRolesName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="JobsAndRolesName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the Job or Role .</div>
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
