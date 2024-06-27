<?php
// Include the header and connection files
include 'header.php';
include 'lib/connection.php';

// Get the 'name' value from the POST request
$name = $_POST['name'];

// Prepare the SQL query to fetch products with the specified name
$sql = "SELECT * FROM product where name='$name'";

// Execute the query
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link to the CSS file for styling the page -->
    <link rel="stylesheet" href="css/pending_orders.css">
</head>
<body>
<div class="container pendingbody">
  <h5>Search Result</h5>
  <!-- Table to display the search results -->
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Description</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
    <?php
    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
      // Loop through each row in the result set
      while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <!-- Display the product image -->
          <td><img src="admin/product_img/<?php echo $row['imgname']; ?>" style="width:50px;"></td>
          <!-- Display the product name -->
          <td><?php echo $row["name"] ?></td>
          <!-- Display the product category -->
          <td><?php echo $row["catagory"] ?></td>
          <!-- Display the product description -->
          <td><?php echo $row["description"] ?></td>
          <!-- Display the product quantity -->
          <td><?php echo $row["quantity"] ?></td>
          <!-- Display the product price -->
          <td><?php echo $row["Price"] ?></td>
        </tr>
        <?php 
      }
    } else {
      // Display a message if no results are found
      echo "0 results";
    }
    ?>
    </tbody>
  </table>
</div>
</body>
</html>
