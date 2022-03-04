<?php
    session_start();
    if(!isset($_SESSION['login']) || !$_SESSION['login']==1){
    header('Location:login.php');
    }
    $id = $_SESSION['user_id']; 
    include('db/connect.php');
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($result);

    $categoryQuery = "SELECT * FROM category";
    $categoryResult = mysqli_query($conn,$categoryQuery);


?>

<html>
        <head>
            <title>Home-Asmt News</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        </head>
      <body>
            <?php include('include/nav.php');?>    
            
            <div class="container">
             <div class="row">
            <?php include('include/left-nav.php');?>    
               <div class="col-8">
                <form method="POST" action="db/add-category.php">
                    <label>Category title</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="category">
                    </div>
                    <br/>
                     <div class="input-group">
                        <input type="text" placeholder="fa icon class" class="form-control" name="iconclass">
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-dark">Save</button>
                </form>
               <?php include('include/message.php'); ?>

        <div class="row justify-content-md-center"></div>
        <?php
          if(mysqli_num_rows($categoryResult)==0){
            echo "<h3>No Category found</h3>";
           }else{ ?>

           <table class="table">
             <thead>
               <th>Title</th>
               <th>Action</th>
           </thead>
           <tbody>
             <?php while($row=mysqli_fetch_assoc($categoryResult)) { ?>         
           <tr>            
            <td><?php echo $row['title'];?></td>
             <td> <a style="cursor:pointer;" onclick="deleteConfirmation(<?php echo $row['id']; ?>);"><i class="fas fa-trash" style="color:red;"></i> </a>| <a href="edit-category.php?id=<?php echo $row['id'];?>"><i class="fas fa-edit"></i></a></td>
           </tr>
           <i class="fa-solid fa-trash-can"></i>
           <?php } ?>
             </tbody>
             </table>
            
          <?php }
          ?>
      </div>
    </div>
  </div>

  

  <script>
  function deleteConfirmation(id){
bootbox.confirm({ 
    size: "small",
    message: "Are you sure?",
    callback: function(result){ 
    if(result){
      window.location = 'db/delete-category.php?id='+id;
    }
    }
})
  }
  
</script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/998a7629ba.js" crossorigin="anonymous"></script>
<script src="js/bootbox.min.js"></script>



</body>
</html>