<?php
// $id = $_GET['id'];
// echo $id;
?>
<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Image CRUD!</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Image CRUD</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "image_crud");
                        $id = $_GET["id"];
                        $sql = "SELECT * FROM image_crud WHERE id=$id";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) {
                                // echo $row['stud_name'];
                        ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="stud_id" value="<?php echo $row['id']; ?>">
                                    <div class="mb-3">
                                        <label for="stud_name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" id="stud_name" name="stud_name" placeholder="Student name" value="<?php echo $row['stud_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stud_class" class="form-label">Student class</label>
                                        <input type="text" class="form-control" id="stud_class" name="stud_class" placeholder="Student class" value="<?php echo $row['stud_class']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stud_phone" class="form-label">Student phone</label>
                                        <input type="text" class="form-control" id="stud_phone" name="stud_phone" placeholder="Student phone" value="<?php echo $row['stud_phone']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stud_image" class="form-label">Student Image</label>
                                        <input type="file" class="form-control" id="stud_image" name="stud_image">
                                        <input type="hidden" name="stud_image_old" value="<?php echo $row['stud_image']; ?>">
                                    </div>
                                    <img src="<?php echo "upload/" . $row['stud_image'] ?>" alt="" width="100px">
                                    <button type="submit" name="update_data" class="btn btn-primary">UPDATE</button>
                                </form>
                        <?php
                            }
                        } else {
                            echo "record not available";
                        }

                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>