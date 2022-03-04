<?php 
include('connect.php');
if (isset ($_POST['category'])){
    $category =$_POST['category'];
    $iconClass =$_POST['iconclass'];


        if($category!=''){
            $query = "INSERT INTO category(title,iconImage) VALUES('$category','$iconClass')";
                 if(mysqli_query($conn,$query)){
            $msg ="Successfully Inserted";
                }else{
            $msg = mysqli_error();
        }
        header('Location:../category.php?msg='.$msg);
             }else{
        $msg ="Category name required";
        header('Location:../category.php>-?errmsg='.$msg);
        }
        }

?>