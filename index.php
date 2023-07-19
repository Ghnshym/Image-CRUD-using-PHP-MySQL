<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="text-white" >Fetch Image with data </h4>
                    </div>
                    <div class="card-body">
                    <?php 
        if(isset($_SESSION['status'])&& $_SESSION != ''){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hay!</strong> <?php echo $_SESSION['status']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Student Class</th>
                                <th>Phone Number</th>
                                <th>Image</th>
                                <th>Update</th>
                                <th>delete</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $conn = mysqli_connect("localhost", "root", "", "image_crud");
                            $sql = "SELECT * FROM image_crud";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            if($num > 0){
                                foreach($result as $row){
                                    echo '
                                    <tr>
                                        <td>'. $row['id'] .'</td>
                                        <td>'. $row['stud_name'] .'</td>
                                        <td>'. $row['stud_class'] .'</td>
                                        <td>'. $row['stud_phone'] .'</td>'; ?>
                                        <td><img src="<?php echo 'upload/'.$row['stud_image']; ?>" alt="imagr" width="80px" height="80px"></td>
                                        <td><a class="btn btn-info" href="edit.php?id=<?php echo $row['id']; ?>">EDIT</a></td>
                    <td>
                        <!-- <a class="btn btn-danger" href="">DELETE</a> -->
                        <form action="code.php" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="delete_image" value="<?php echo $row['stud_image']; ?>">
                    <button type="submit" class="btn btn-danger" name="delete_data">DELETE</button>

                        </form>
                    </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                echo "<tr> Records Not Founds </tr>";
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <div class="container">
    <a href="./create.php" class="btn btn-primary"> create</a>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>