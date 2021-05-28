<?php
include('dbcon.php');

if(isset($_POST['view'])){

    session_start();
    $appt = $_SESSION['appt'];
    if($appt == 'QM'){
        $tablename = 'qmcomments';
    }
    elseif($appt == 'MT'){
        $tablename = 'mtcomments';
    }
    else{
        $tablename = 'polcomments';
    }

$status_query = "SELECT * FROM ".$tablename." WHERE comment_status=0";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);



if($_POST["view"] != '')
{
    $update_query = "UPDATE ".$tablename." SET comment_status = 1 WHERE comment_status=0";
    mysqli_query($con, $update_query);
}
if($count > 5){
    $query = "SELECT * FROM ".$tablename." ORDER BY comment_id DESC";
}
else{
    $query = "SELECT * FROM ".$tablename." ORDER BY comment_id DESC LIMIT 5";
}
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
   $output .= '
   <li class="dropmenu">
   <a href="'.$row["comment_link"].'">
   <strong>'.$row["comment_subject"].'</strong><br />
   <small><em>'.$row["comment_text"].'</em></small>
   </a>
   </li>
   ';

 }
}
else{
     $output .= '
     <li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}

$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);

echo json_encode($data);

}

?>