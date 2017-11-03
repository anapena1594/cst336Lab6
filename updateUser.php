<?php

 include 'database.php';
 $conn = getDatabaseConnection();
function getUserInfo() {
  global $conn;
    
    $sql = "SELECT * 
            FROM User
            WHERE id = " . $_GET['userId']; 
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($record);   
    return $record;
    
}

 if (isset($_GET['updateUser'])) { //checks whether admin has submitted form.
     
     //echo "Form has been submitted!";
     
     $sql = "UPDATE User
             SET firstName = :fName,
                 lastName  = :lName,
                 email = :email,
                 phone = :phone,
                 role = :role,
                 deptId= :deptId
            WHERE id = :id";

     $np = array();
    
     //echo "$sql";
    
    $np[':fName'] = $_GET['firstName'];
    $np[':lName'] = $_GET['lastName'];
    $np[':email'] = $_GET['email'];
    $np[':phone'] = $_GET['phone'];
    $np[':role'] = $_GET['role'];
    $np[':deptId'] = $_GET['deptId'];
    $np[':id'] = $_GET['userId'];
    
     $stmt = $conn->prepare($sql);
     $stmt->execute($np);
     
     echo "Record has been updated!";
    
 }

 if (isset($_GET['userId'])) {
     
    $userInfo = getUserInfo(); 
     
     
 }



?>


<!DOCTYPE html>
<html>
    <head>
        <title> Update User </title>
         <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <h1> Update User </h1>
                <h1> Tech Checkout System: Updating User's Info </h1>
        <form method="GET">
            <input type="hidden" name="userId" value="<?=$userInfo['id']?>" />
            First Name:<input type="text" name="firstName" value="<?=$userInfo['firstName']?>" />
            <br />
            Last Name:<input type="text" name="lastName"value="<?=$userInfo['lastName']?>"/>
            <br/>
            Email: <input type= "email" name ="email"value="<?=$userInfo['email']?>"/>
            <br/>
            Phone Number: <input type ="text" name= "phone"value="<?=$userInfo['phone']?>"/>
            <br />
           Role: 
           <select name="role">
                <option value=""> - Select One - </option>
                <option value="staff" <?=($userInfo['role']=='Staff')?" selected":"" ?> >Staff</option>
                <option value="student" <?=($userInfo['role']=='Student')?" selected":"" ?> >Student</option>
                <option value="faculty" <?=($userInfo['role']=='Faculty')?" selected":"" ?> >Faculty</option>
            </select>
            <br />
            Department: 
            <select name="deptId">
            <option value="" > - Select One - </option>
            <option value="computer science"  <?=($userInfo['deptId']=='1')?" selected":"" ?>  > computer science</option>
            <option value="Statistics"  <?=($userInfo['deptId']=='2')?" selected":"" ?>  >Statistics</option>
            <option value="Design"  <?=($userInfo['deptId']=='3')?" selected":"" ?>  >Design</option>
            <option value="Economics"  <?=($userInfo['deptId']=='4')?" selected":"" ?>  >Economics</option>
            <option value="Drama"  <?=($userInfo['deptId']=='5')?" selected":"" ?>  >Drama</option>
            <option value="Biology"  <?=($userInfo['deptId']=='6')?" selected":"" ?>  >Biology</option>
            </select>
            <input type="submit" value="Update User" name="updateUser">
        </form>

    </body>
</html>