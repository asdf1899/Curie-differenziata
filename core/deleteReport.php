<?php
  include "dbConnection.php";
  include "getData.php";
  session_start();
  $reportID = $_GET['id'];
  $cestini = getCestiniByControllo($reportID, $db_conn);
  if (isset($cestini)){
    for ($i=0; $i < count($cestini); $i++){
      if (isset($cestini[$i][1])){
        unlink('../'.$cestini[$i][1]);
      }
      $sql = "DELETE FROM t_cestini WHERE ID='".$cestini[$i][0]."'";
      echo $sql;
      $deleteCestini = mysqli_query($db_conn, $sql);
      if ($deleteCestini == null){
        die("error");
      }
    }
    $sql = "DELETE FROM t_controlli WHERE ID='$reportID'";
    $deleteQuery = mysqli_query($db_conn, $sql);
    if ($deleteQuery == null){
      die("error");
    }
    $_SESSION['include'] = 'list.php';
    redirect("../checking.php");
  }
?>
