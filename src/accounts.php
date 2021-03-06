<!doctype html>
<?php
$config['db'] = array(
	'host'			=>'localhost',
	'username'		=>'rmorga51',
	'password'		=>'',
	'dbname'		=>'accounting'
);
	

$db = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']); 
$db->setATTRIBUTE(PDO::ATTR_EMULATE_PREPARES, false);
$db->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset  ($_GET['Subject'])){
  $order = $_GET['Subject'];
}
else{
  $order = 'account_type';
}

$query = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_status = 'ACTIVE' ORDER BY $order ASC");

$query->execute();
$query->fetch(PDO::FETCH_ASSOC);



?>
<html lang = en>
    <head>
                <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="css/COA.css"/>
            <link rel="stylesheet" href="css/header.css"/>
                <!---Title -->
            <title>AnyWhere-Chart Of Accounts</title>
    </head>
    <body>

        
              <!-- Header-->


              <nav class="navbar navbar-expand navbar-primary">
                <header class="navbar-brand" href="./home.html"><img src="assets/logo.png" alt="bluePrint" height="60"/></header>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link active" href="./home.php">Home<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"href="./COA.php">Charts of Account</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="./JournalEntry.php">Journal Entry</a>
                </li>
                <li class="nav-item">
                         <a class="nav-link" href="./ManagerReview.php">Manager Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./ledgerAccounts.php">Account Ledgers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./accounts.php">Accounts</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="./logs.php">Logs</a>
                </li>
      
                </ul>
                
              </div>
              <div class="pull-right">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="navbarDropdown" href="./login.php"><span class="glyphicon glyphicon-user"></span>Login</a>
                  </li>
                </ul>
              </div>
            </nav>




                <!-- Body -->
                <div class="container">
                    <legend class="" align="center" text-size=""><strong>Accounts</strong></legend>
                    <!-- Search Component -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">

                            </div>
     
                        </div>
                    </div>
                    <form method="get" action="accounts.php" class ="form-inline"> 
                    <select  name="Subject" class = "form-control">
                      <option selected="selected" value="account_type" >Type</option>
                      <option value="account_code">Code</option>
                      <option value="account_name">Name</option>
                      <option value="account_type">Type</option>
                      <option value="account_subtype">Sub Type</option>
                      <option value="normal_side">Side</option>
                      <option value="account_status">Status</option>
                      <option value="balance">Balance</option>
                      <option value="last_date_accessed">Last Date Accesed</option>
                      <option value="last_user_id_accessed">User Id</option>
                    </select>
                    <input class = "btn btn-success float-right" type="submit" value="Filter">
                    </form>
                    <!--Table-->
                    <table id="COA-table" class= "table table-stripped">
                        <tr class="table-header-row">
                          <td><strong>CODE</strong></td>                          
                          <td><strong>TYPE</strong></td>
                          <td><strong>SUB-TYPE</strong></td>
                          <td><strong>NAME</strong></td>
                          <td><strong>SIDE</strong></td>
                          <td><strong>STATUS</strong></td>
                          <td><strong>BALANCE</strong></td>
                          <td><strong>LAST DATE ACCESSED</strong></td>
                          <td><strong>USER ID</strong></td>
                        </tr>
                        <!---PHP database call-->
                        <?php

			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
				echo "<td>",$row['account_code'],"</td>";
				echo "<td>",$row['account_type'],"</td>";
				echo "<td>",$row['account_subtype'],"</td>";
				echo "<td>",$row['account_name'],"</td>";
				echo "<td>",$row['normal_side'],"</td>";
				echo "<td>",$row['account_status'],"</td>";
				echo "<td>",$row['balance'],"</td>";
				echo "<td>",$row['last_date_accessed'],"</td>";
				echo "<td>",$row['last_user_id_accessed'],"</td>";
				echo "</tr>";
			}
		?>
                    </table>
                    </div>

    <script src="./scripts/activeAccounts.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>