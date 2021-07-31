 
   <!-- INSERT INTO `notes` (`Sno`, `title`, `descr`, `tstamp`) VALUES (NULL, 'second title', 'this is second', CURRENT_TIMESTAMP); -->
   <?php
    $insert=false;
    $update=false;
    $delete = false;
   $server="localhost";
   $username="root";
   $password="";
   $database="notes";

   $conn=mysqli_connect($server,$username,$password,$database);

   if(!$conn)
   {
    die("Error ".mysqli_connect_error());
   }

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `Sno` = $sno";
  $result = mysqli_query($conn, $sql);
}   


   if ($_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_POST['snoEdit']))
    {
      //update record
      $sno = $_POST["snoEdit"];
      $title = $_POST["titleEdit"];
      $description = $_POST["descrEdit"];

      $sql="UPDATE `notes` SET `title` = '$title', `descr` = '$description' WHERE 
      `notes`.`Sno` = $sno ";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
      
    }
    else{
     $title=$_POST["title"];
     $descr=$_POST["descr"];

     $sql="INSERT INTO `notes` (`title`, `descr`) VALUES ('$title','$descr')";

     $result=mysqli_query($conn,$sql);

     if($result){
      //echo "Record inserted successfully";
      $insert=true;
     }

     else{
      echo "Wrong!!!!!!!!!!!!!!!";
     }
   }
 }
?>



<!DOCTYPE html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <title>My crud App</title>
  </head>
  <body>
   <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/Crud_Application/index.php" method="post">
      <div class="modal-body">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="form-group">
    <label for="title">Note Title</label>
    <input type="text" class="form-control" name="titleEdit" id="titleEdit" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">Take your daily notes here.</small>
  </div>
  <div class="form-group">
    <label for="desc">Note Description</label>
    <textarea class="form-control" name="descrEdit" id="descrEdit" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Update Note</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">iNotes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact us</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<?php
if($insert)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your data has been submitted successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>

<?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

    <div class="container my-5">
        <h2>Add a Note</h2>
<form action="/Crud_Application/index.php" method="post">
  <div class="form-group">
    <label for="title">Note Title</label>
    <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">Take your daily notes here.</small>
  </div>
  <div class="form-group">
    <label for="desc">Note Description</label>
    <textarea class="form-control" name="descr" id="descr" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
    </div>

    <div class="container">
        

        <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">SL.  no.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
            $sql="SELECT * FROM `notes`";
            $result=mysqli_query($conn,$sql);
            $sno=0;
            while($row=mysqli_fetch_assoc($result)){ 
              $sno++;
            echo "<tr>
      <th scope='row'>".$sno."</th>
      <td>".$row['title']."</td>
      <td>".$row['descr']."</td>
      <td><button class='edit btn btn-sm btn-primary' id=".$row['Sno'].">Edit</button> <button class='delete btn btn-sm btn-danger' id=".$row['Sno'].">Delete</button></td>
    </tr>";
    } 
?>

</tbody>
</table>
    </div>
 
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit");
        tr=e.target.parentNode.parentNode;
        title=tr.getElementsByTagName("td")[0].innerText;
        description=tr.getElementsByTagName("td")[1].innerText;
        console.log(title,description);
        titleEdit.value=title;
        descrEdit.value=description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
      })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id;

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/Crud_Application/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>
</html>