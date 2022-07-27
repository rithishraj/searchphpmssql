<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search filter</title>
    <h1>search filter</h1>
</head>
<body>
    <form action="" method="post">
    <label for="search">search</label>
    <input type="search" name="search" id="search" placeholder="search">
    <button type="submit" name="Submit">submit</button>    
    </form>
    <table class="table table-striped table-dark">
      <thead>
        <tr>
            <td>name</td>
            <td>phone</td>
            <td>email</td>
            <td>message</td>
        </tr>
    </thead>  
<?php
include_once("dbconnection.php");

if(isset($_POST['Submit'])) {	
	$search_query = $_POST['search'];
}
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $sql="SELECT * FROM detail WHERE CONCAT(name,phone,email,message) LIKE '%$search_query%'";
  $result=sqlsrv_query($conn,$sql,$params,$options);
  if( $result === false) {
    die( print_r( sqlsrv_errors(), true) );
    }
   
    $row_count = sqlsrv_num_rows( $result );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
else
   //echo $row_count;
    if($row_count > 0)
    {
        //foreach((array)$result as $items)
        //{
          while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_NUMERIC) ) {
            
          
            ?>
            <tbody>
            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td><br>
            </tr>
          </tbody>
            <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tbody>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                                </tbody>
                                            <?php
                                        }
                                  
                                ?>
                                      </table>

<style>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

thead, tbody, td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
                                    </body>
</html>