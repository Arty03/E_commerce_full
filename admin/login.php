<?php 

// Start a new session or resume the existing session
SESSION_START();

// Check if the user is already authenticated
if(isset($_SESSION['auth']))
{
    if($_SESSION['auth'] == 1)
    {
        // Redirect to home page if the user is authenticated
        header("location:home.php");
    }
}

// Include the database connection file
include "lib/connection.php";

// Check if the form has been submitted
if (isset($_POST['submit'])) 
{
    // Get the email and password from the form
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    // Print the email and password for debugging purposes
    echo $email;
    echo $pass;

    // Prepare the SQL query to check the user's credentials
    $loginquery = "SELECT * FROM admin WHERE userid='$email' AND pass='$pass'";
    $loginres = $conn->query($loginquery);

    // Print the number of rows returned for debugging purposes
    echo $loginres->num_rows;

    // Check if the query returned any results
    if ($loginres->num_rows > 0) 
    {
        // Fetch the user details from the result set
        while ($result = $loginres->fetch_assoc()) 
        {
            $username = $result['userid'];
        }

        // Store the username and authentication status in the session
        $_SESSION['username'] = $username;
        $_SESSION['auth'] = 1;

        // Redirect to the home page
        header("location:home.php");
    }
    else
    {
        // Print "invalid" if the credentials are incorrect
        echo "invalid";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Sign In</h3>
            </div>
            <div class="card-body">
                <!-- Form for user login -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input-group form-group">
                        <!-- Input field for email -->
                        <input type="text" class="form-control" placeholder="username" name="email">
                    </div>
                    <div class="input-group form-group">
                        <!-- Input field for password -->
                        <input type="password" class="form-control" placeholder="password" name="password">
                    </div>
                    <div class="form-group">
                        <!-- Submit button for the form -->
                        <input type="submit" value="Login" class="btn btn-primary" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Link to Bootstrap JS and Popper.js for functionality -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</body>
</html>
