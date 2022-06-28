<?php
    if(isset($_POST["button_save"])){
        $customer_name = "";
        $address = "";
        $phone_number = "";
        $customer_id = "";
        $customer_level = "";
        include('./connect.php');
        $result = mysqli_query($con, "select Customer_Id from customer");
        if($result){
          $row = mysqli_num_rows($result);
        }
        if($con){
          $customer_name = $_POST["customer_name"];
          $address = $_POST["address"];
          $phone_number = $_POST["phone_number"];
          $customer_id = $_POST["customer_id"];
          $customer_level = $_POST["customer_level"];
            $qry = mysqli_query($con, "insert into customer values(
                '".$address."',
                '".$customer_name."',
                '".$customer_id."',
                '".$phone_number."',
                '".$customer_level."'
            )");
        }else{
            echo "Connect failed";
        }
    } 
    // delete button 
    if(isset($_GET["id"])){
      $customer_id = $_GET["id"];
      include('./connect.php');
      if($con){
          $qry = mysqli_query($con, "delete from customer where Customer_id='".$customer_id."'");
          if($qry){
            header('Location: customer.php');
          }else{
              echo "Failed";
          }
      }
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="customer.css" /> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container-fluid d-flex flex-column md-3">
      <div class="title p-3"><h1>Customers</h1></div>
      <div class="sub-title p-3">
        <h3><a href="dashboard.php">Dashboard</a>/Customers</h3>
      </div>
      <div class="d-flex flex-row justify-content-between p-3">
        <div><button class="back-btn btn btn-secondary">Back</button></div>
        <div
          class="total-costumer d-flex justify-content-left align-items-center"
        >
          <h3>Total Customer: <?php
          include('./connect.php');
        $result = mysqli_query($con, "select Customer_Id from customer");
        if($result){
          $row = mysqli_num_rows($result);
          if($row){
            echo $row;
          }
          mysqli_free_result($result);
        }
          ?></h3>
        </div>
      </div>
      <div class="sub-header d-flex justify-content-between p-3">
        <div class="search-customer w-75">
          <input
            placeholder="Search Customer..."
            class="form-control form-control-lg w-100 p-2 h6"
          />
        </div>
        <button class="add-btn btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addForm">
          <span class="h6">Add Customer</span>
        </button>
      </div>
      <div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form class="modal-dialog" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Customer Name:</label>
                  <input type="text" class="form-control" id="recipient-name" name="customer_name">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Address:</label>
                  <input type="text" class="form-control" id="recipient-name" name="address">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Phone Number:</label>
                  <input type="text" class="form-control" id="recipient-name" name="phone_number">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Customer ID:</label>
                  <input type="text" class="form-control" id="recipient-name" name="customer_id">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Customer Level:</label>
                  <select class="form-select" aria-label="Default select example" name="customer_level">
                    <option selected>Open this select menu</option>
                    <option value="BRONZE">BRONZE</option>
                    <option value="SILVER">SILVER</option>
                    <option value="GOLD">GOLD</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <input type="submit" name = "button_save" value="Add" class="btn btn-primary"/>
            </div>
          </div>
        </form>
      </div>
      
      <table class="table p-3">
        <thead>
          <tr>
            <th scope="col"> ID </th>
            <th scope="col"> Customer Name</th>
            <th scope="col"> Address </th>
            <th scope="col"> Phone Number</th>
            <th scope="col"> Customer ID </th>
            <th scope="col"> Customer Level </th>
          </tr>
        </thead>
        <tbody>
        <?php
                $con = mysqli_connect(
                    "localhost",
                    "products",
                    "Pitou11112222",
                    "pos");
                if($con){
                    $qry = "";
                    if(isset($_POST["button_search"])){
                        $qry = mysqli_query($con);
                    }
                    $qry = mysqli_query($con, "select * from customer");
                    $num = 1;
                    while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                        echo "<tr><td>".$num++."</td><td>".$row["Customer_Name"]
                        ."</td><td>".$row["Address"]."</td><td>".$row["Phone_Number"]."</td><td>".$row["Customer_Id"]."</td><td>".$row["Level"]."</td>";
                        echo "<td> <a title='Click To Edit Customer' rel='facebox' href='editcustomer.php?id=".$row["Customer_Id"]."' <button class='btn btn-warning'>Edit</button>
                        </a> | <a class='delete-btn btn btn-danger' href='customer.php?id=".$row["Customer_Id"]."' onclick=\"return confirm('Are you sure you want to delete this item')\"><span class='h6'>Delete</span></a></td>";
                        echo "</tr>";    
                    }
                }else{
                    echo "Connection Failed";
                }
            ?>
        </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
