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

$query = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_status != 'n/a'");

    


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
            <link rel="stylesheet" href="css/ledgerAccounts.css"/>
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




            <!-- Search Component -->
                   <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <form method="get" action="ledgerAccounts.php" class ="search-form">
                                    <div class="form-group has-feedback">
                                        <label for="search" class="sr-only">Search Accounts</label>
                                                <input type="text" class="form-control" name="search" id="search" placeholder="search"/>
                                                <input class = "btn btn-success float-right" align = "right" type="submit" value="Filter">
                
                                          <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                          
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
<!--Body of ledger accoutns -->
<div id = "table-container">
<?php
 while($coa = $query->fetch(PDO::FETCH_ASSOC)){
           /*Account Name */
           echo '<div class = "show">';
           echo '<legend class="" align="center" text-size=""><strong><p class = "table-title">', $coa['account_name'],'</p></strong></legend>';
echo '<table class= "table">';
        /*Header for table */
        echo '<tr class = "table-header-row"><th>Date</th><th>Debit</th><th>Credit</th></tr>';
        echo '<tbody>';
        $accountName = $coa['account_name'];
        $query2 = $db->query("SELECT * FROM journal_entry INNER JOIN je_accounts ON journal_entry.transaction_id = je_accounts.transaction_id WHERE account_name =
         '$accountName' ORDER BY debit Desc");
        
        while($row = $query2->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        echo '<td>',$row['date1'],'</td>';
        echo '<td class = "table-debit">',$row['debit'],'</td>';
        echo '<td class = "table-credit">',$row['credit'],'</td>';
        echo '<td></td>';
        }
        echo  '</tbody></table>';
        echo '</div>';
 }
?>
</div>
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="./scripts/ledgerAccounts.js" type="text/javascript"></script>
    </body>
</html> 