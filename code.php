<?php
// code for create.php to insert data with image
session_start();
$conn = mysqli_connect("localhost", "root", "", "image_crud");
if(isset($_POST['submit_data'])){
   
    $name = $_POST['stud_name'];
    $class = $_POST['stud_class'];
    $phone = $_POST['stud_phone'];
    $image = $_FILES['stud_image']['name'];

    //for allow extension to store image like .jpeg, .png, .gif
    $allow_extension = array('jpg', 'png', 'gif', 'jpeg');
    $filename = $_FILES['stud_image']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($file_extension, $allow_extension))
    {
        $_SESSION['status'] = "Only images with extension .jpg, .png, .jpeg .gif ";
        header("Location: create.php");   
    }
    else{

    // if you want to avoid uploading same file name image then use this parameter
    if(file_exists("upload/". $_FILES['stud_image']['name'])){

        $filename = $_FILES['stud_image']['name'];
        $_SESSION['status'] = "This file name is already exists please change file or filename " . $filename;
        header("Location: create.php");
    }
    else{

//insert the file
    $sql = "INSERT INTO image_crud (stud_name,stud_class,stud_phone,stud_image) VALUES ('$name','$class','$phone','$image')";
    //check status
    $result = mysqli_query($conn, $sql);
    if($result){
        //move uploaded file parameter impotant*
        move_uploaded_file($_FILES["stud_image"]["tmp_name"],"upload/".$_FILES["stud_image"]["name"]);

        $_SESSION['status'] = "Image uploaded successfully";
        header("location: index.php");
        
    }
    else{
        echo "error";
    }
}
    }
}

//updating code start here
//code for edit.php file to 

if(isset($_POST['update_data']))
{
    //getting data from form 
    $id = $_POST['stud_id'];
    $update_name = $_POST['stud_name'];
    $update_class = $_POST['stud_class'];
    $update_phone = $_POST['stud_phone'];

    // select old or new image
    $new_image = $_FILES['stud_image']['name'];
    $old_image = $_POST['stud_image_old'];

    //condition to selection old or new image
    if($new_image != '')
    {
        $update_filename = $_FILES['stud_image']['name'];
    }
    else
    {
        $update_filename = $old_image;
    }

        //update query
        $sql = "UPDATE image_crud SET stud_name='$update_name', stud_class='$update_class', stud_phone='$update_phone', stud_image='$update_filename' WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if($result){

            //if new file found then move to the folder
            if($_FILES['stud_image']['name']!= ''){
                move_uploaded_file($_FILES["stud_image"]["tmp_name"],"upload/".$_FILES["stud_image"]["name"]);

            //if new image found than unlink or delete old image file
                unlink("upload/".$old_image);
            }
            $_SESSION['status'] = "updated successfully";
            header("Location: index.php"); 
        }
        else{
            $_SESSION['status'] = "error while updating";
            header("Location: index.php");
        }
    }

//delete data or image 
if(isset($_POST['delete_data']))
{
    $id = $_POST['delete_id'];
    $del_image = $_POST['delete_image'];

    $sql = "DELETE FROM image_crud WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        unlink("upload/".$del_image);
        $_SESSION['status'] = " Data Delete successfully";
            header("Location: index.php");
    }
    else{
        $_SESSION['status'] = " error while deleting";
            header("Location: index.php");
    }
}

?>