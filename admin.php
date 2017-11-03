<?php
session_start();

if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
}

function userList(){
  include 'database.php';
  $conn = getDatabaseConnection();
  
  $sql = "SELECT *
          FROM User order by firstName ASC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $records;
 }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page </title>
         <link href="style.css" rel="stylesheet" type="text/css"/>
         <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete this user?");
                
            }
            
        </script>
    </head>
    <body>

            <h1> Admin Main </h1>
            <h2> Welcome <?=$_SESSION['adminName']?>!</h2>
            
            <br />
            <form action="addUser.php">
                
                <input type="submit" value="Add new user" />
                
            </form>
             
            <form action="logout.php">
                
                <input type="submit" value="Log Out" />
                
            </form>
            <br />
            <h3> Here are the list of Users: </h3> </br>
            
            <h4>
            
            <?php
            
             $users = userList();
             
             foreach($users as $user) {
                 
                 
                 echo $user['id'] . "  " . $user['firstName'] . " " . $user['lastName'] . "<br />";
                 
                 echo "[<a href='updateUser.php?userId=".$user['id']."'> Update </a>] <br />";
                 echo "[<a onclick='return confirmDelete()' href='deleteUser.php?userId=".$user['id']."'> Delete </a>] <br />";
                 
                 
                 
                 
                 
             }
             
             ?>
             
            </h4> 
            
           
            
    </body>
</html>