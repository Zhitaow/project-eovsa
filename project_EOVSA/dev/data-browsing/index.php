<?php
session_start();

include('includes/functions.php');

// if login form was submitted
if( isset( $_POST['login'] )) {
    // create variables
    // wrap data with validate function
    $formUsername = validateFormData( $_POST['username'] );
    $formPass = validateFormData( $_POST['password'] );
    
    // connect to database
    include('includes/connection.php');
    // require_once('includes/connection.php');
    // create query
    $query = "SELECT name, password FROM admins WHERE username='$formUsername'";
    
    // store the result
    $result = mysql_query( $query );
    
    // verify if result is returned
    if( mysql_num_rows($result) > 0 ) {
        // store basic user data in variables
        while( $row = mysql_fetch_assoc($result) ) {
            $name = $row['name'];
            $hashedPass = $row['password'];
        }
        
        // verify hashed password with submitted password
        // if( password_verify( $formPass, $hashedPass ) ) {
        if ($formPass == $hashedPass) {
            // correct login details!
            // store data in SESSION variables
            $_SESSION['loggedInUser'] = $name;
            // echo $_SESSION['loggedInUser'] ;
            // redirect user to clients page
            header( "Location: clients.php" );
        } else { // hashed password didn't verify
            
            // error message
            $loginError = "<div class='alert alert-danger'>Wrong username / password combination. Try again.</div>";
        }
        
    } else { // there are no results in database
        
        // error message
        $loginError = "<div class='alert alert-danger'>No such user in database. Please try again. <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    
}
if(isset( $_POST['visit'] )) {
    header( "Location: view-only.php" );
}
// close mysql connection
mysql_close($conn);

include('includes/header.php');
include('includes/custom_login.php');

?>



<div style="padding-top: 10%;" >
<h1><font color="white">E<i class="fa fa-sun-o"></i>VSA Database</font></h1>
<p>&nbsp;</p>
<p class="lead"><font color="white">Visitors proceed below </font></p>
<form class="form" style="width: 300px;"  action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
    <button type="submit" class="btn btn-warning btn-md" name="visit"> Enter</button>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p class="lead"><font color="white">Tohbans sign in below</font></p>
<form class="form" style="width: 300px;"  action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
     <div class="form-group">
        <label for="login-username" class="sr-only">Username</label>
        <input type="text" class="form-control" id="login-username" placeholder="username" name="username" value="<?php echo $formUsername; ?>">
    </div>
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login"> Login</button>
</form>

<?php echo $loginError; ?>
</div>
<?php
// include('includes/footer.php');
?>