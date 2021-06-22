<?php
include 'inc.requestupdate.php';
    class ufdmsTest extends \PHPUnit\Framework\TestCase {
        public function testRequestUpdate(){
            include("dbcon.php");
            date_default_timezone_set("Asia/Dhaka");
            $currentdate = date("Y-m-d");
            $currenttime = date('H:i:s');
            $bool = True;
            $quary = "SELECT time,date,status from `veh_mov_req`";
            $result = mysqli_query($con, $quary) or die(mysqli_error($con));
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                    $movDate = $row['date'];
                    $movTime = $row['time'];
                    $stat = $row['status'];
                    
                    $diff = date_diff(date_create($currentdate),date_create($movDate));
                    if($diff->format('%r%d')<0){
                        if($stat == 'requested'){
                            $bool = False;
                            break;
                        }
                    }
                    elseif($diff->format('%d')==0){
                        $timeDiff = date_diff(date_create($currenttime),date_create($movTime));
                        if($timeDiff->format('%r%H')<0 || $timeDiff->format('%r%i')<0 ||$timeDiff->format('%r%s')<0){
                            if($stat == 'requested'){
                                $bool = False;
                                break;
                            }
                        }
                    }
                }
            }
            $this->assertTrue($bool);
        }
    }
//"vendor/bin/phpunit" [terminal Bash]
?>