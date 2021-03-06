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


$query = $db->query("SELECT * FROM chart_of_accounts");
//$query2 = $db->query2("UPDATE account_status FROM chart_of_accounts WHERE account_name = 'n/a'");

$query2 = $db->query("SELECT * FROM chart_of_accounts WHERE account_status = 'n/a' ORDER BY account_name ASC");



?>
<html lang = en>
    <head>
                <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="css/home.css"/>
            <link rel="stylesheet" href="css/header.css"/>
                <!---Title -->
            <title>AnyWhere-createAccount</title>
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



<!--Create Account -->
<div class="App">
        <div class="col-md-3 cols-md-offset-3">
        <!--
          <form id="create-account" method="GET" action="">
          <div class="form-group">
              <label htmlFor="account_type">Account Type</label>
              <select id="account_type" class="form-control">
              <option value="" disabled>--Account Type--</option>  
                <option value="Assests">Assets</option>
                <option value="Liabilities">Liabilities</option>
                <option value="Owner's-Equity">Owner's Equity</option>
                <option value="Revenue">Revenue</option>
                <option value="Expenses">Expenses</option>
              </select> 
          </div>
          </form>-->
          <form  id="create-account" method="POST" action="createAccountUpload.php" enctype="multipart/form-data">
          <div class="form-group">
              <label>
                  Account Name
              </label>
              <select id="normal_side" name="account_name" class="form-control"> 
              <option value="" >--Account Name--</option> 
              <?php
              			while($row = $query2->fetch(PDO::FETCH_ASSOC)){
                      echo '<option class = "accounts" value ="',$row['account_name'],'">',$row['account_name'],'</option>';                      
                    }
          ?>
              </select>
          </div>
          <div class="form-group">
              <label>
              Is Active:
              </label>
              <select id="account_name" name="account_status" class="form-control">
              <option value="" disabled>--Account Type--</option>  
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option>

              </select> 
          </div>
          <div class="form-group">
              <label>
                  Initial Balance
              </label>
              <input id="inital_balance" class="form-control" type="number" name="balance" value="0.00"/>
              
          </div>
          <div class="row">
            <div class="">
                <button class="btn btn-danger left" type="reset"> Cancel</button>
                <input class="btn btn-success right" type="submit" value="submit">
            </div>
            
          </div>
      </form>
    </div>
        </div>




    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>