<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: index.php");
    // echo $_SESSION['loggedInUser'];
}

// connect to database
include('includes/connection.php');

// query & result
$query = "SELECT * FROM ant_log";
$result = mysqli_query( $conn, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
    // new client added
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New client added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    // client updated
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Client updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
    // client deleted
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Client deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
      
}

// close the mysql connection
mysqli_close($conn);

include('includes/header.php');
echo "Session: ".$_SESSION['loggedInUser'];
?>

<h1>Client Address Book</h1>

<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Notes</th>
        <th>Edit</th>
    </tr>
    <tr>
        <td>John Doe</td>
        <td>john@doe.com</td>
        <td>(123) 456-7890</td>
        <td>111 Address Street, Calgary, AB  T1G 2KY</td>
        <td>Brightside Studios Inc.</td>
        <td>Usually pays early. He's awesome.</td>
        <td><a href="edit.php" type="button" class="btn btn-default btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>
    </tr>
    <tr>
        <td>Jane Doe</td>
        <td>jane@doe.com</td>
        <td>(123) 456-7890</td>
        <td>12a Address Avenue, Calgary, AB  T1G 2KY</td>
        <td>Brightside Studios Inc.</td>
        <td>Nice lady. Pays in high fives though...</td>
        <td><a href="edit.php" type="button" class="btn btn-default btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>
    </tr>

    <tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>
    </tr>
</table>

<?php
include('includes/footer.php');
?>