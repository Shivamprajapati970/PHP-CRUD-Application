<!-- php Database connection -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_shivam";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST['snoEdit'];
        $title = isset($_POST['titleEdit']) ? $_POST['titleEdit'] : '';
        $description = isset($_POST['descriptionEdit']) ? $_POST['descriptionEdit'] : '';

        $sql = "UPDATE `mynote` SET `title` = '$title', `description` = '$description' WHERE `mynote`.`sno` = '$sno'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> Your note has been updated.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Insert the record
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $sql = "INSERT INTO `mynote` (`title`, `description`, `date`) VALUES ('$title', '$description', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                      <strong>myNote!</strong> Your note has been submitted successfully.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <l>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>myNote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    
  </head>
  <body>
    <!-- Edit myNote modal >
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button-->

<!-- Edit myNote Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update myNote</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Update form -->
                <form action="index.php" method="post">
                    <input type="hidden" name="snoEdit" id="snoEdit">
                    <div class="mb-3">
                        <label for="titleEdit" class="form-label">Title</label>
                        <input type="text" name="titleEdit" class="form-control" id="titleEdit" aria-describedby="Help">
                    </div>
                    <div class="mb-3">
                        <label for="descriptionEdit" class="form-label">Description</label>
                        <textarea name="descriptionEdit" class="form-control" id="descriptionEdit"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">myNote</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
        </div>
    </nav>
    <?php
  //   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //     $title1=$_POST['title1'];
  //     $description1=$_POST['description1'];
  //     //INSERT INTO `mynote` (`sno`, `title`, `description`, `date`) VALUES ('1', 'CRUD Operation', 'Today I will complete CRUD Operation.', current_timestamp());
  //     $sql="INSERT INTO `mynote` (`title`, `description`,`date`) VALUE ('$title1','$description1',current_timestamp())";
  //     $result = mysqli_query($conn,$sql);
  //     if($result){
  //       echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
  //                 <strong>myNote! </strong>your note has successfully Submit.
  //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  //               </div>';
  //   }
  // }
    ?>

    <div class="container mt-4">
      <!-- form for add data -->
    <form action="index.php" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="ttile" aria-describedby="Help">
    <div id="Help" class="form-text">Add Your title for note.</div>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Descriptiom</label>
    <input type="text" name="description" class="form-control" id="description">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<!-- Table for showing data -->
<div class="container mt-4 my-4 border">
<table class="table" id="myTable">
  <thead>
    <tr class="table-danger">
      <th scope="col">S.No.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql="SELECT * FROM `mynote`";
    $result = mysqli_query($conn,$sql);
    $no=0;
    while($row = mysqli_fetch_assoc($result)){
      $no++;
      echo "<tr class='table-secondary'>
      <th scope='row'>$no</th>
      <td>". $row['title'] ."</td>
      <td>". $row['description'] ."</td>
      <td><button type='button' class='edit btn btn-sm btn-primary'id=".$row['sno']." data-bs-toggle='modal' data-bs-target='#editModal'> Edit </button> <button type='button' class='delete btn btn-sm btn-danger' id=d".$row['sno']."> Delete </button></td>
     </tr>";
      } 
    ?>
  </tbody>
</table>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script> 
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
    </script>
    <script>
      edit= document.getElementsByClassName('edit');
      Array.from(edit).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("edit", );
          const tr= e.target.parentNode.parentNode;
          const title= tr.getElementsByTagName("td")[0].innerText;
          const description= tr.getElementsByTagName("td")[1].innerText;
          console.log(title, description);
          titleEdit.value=title;
          descriptionEdit.value =description;
          snoEdit.value=e.target.id;
          console.log(e.target.id)
          $('#editModal').modal('toggle')
        })
        
      })

      deletes= document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
          console.log("edit", );
          sno= e.target.id.substr(1,);
          if(confirm("Press a button if you are delete it")){
            console.log("yes");
            window.location=`/PHP-CRUD-Application/index.php?delete=${sno}`;
          }
          else{
            console.log("No way")
          }
        })
        
      })
    </script>
    
  </body>
</html>