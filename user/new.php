<?php include('header.php');
require '../dbconnect.php';
session_start();

  echo "<br>"."<br>"."<br>";
  echo "<br>"."<br>"."<br>";
  echo "<br>"."<br>"."<br>";
  //echo $_SESSION['user']."<br>";
  //echo $_SESSION['seat_no']."<br>";
  //echo $_SESSION['book_date']."<br>";
  //echo $_SESSION['date']."<br>";
  //echo $_SESSION['train_no']."<br>";
$p_name=$_SESSION['user'];
$seat_no=$_SESSION['seat_no'];
$date=$_SESSION['date'];
$date1=$_SESSION['date'];
$train_no=$_SESSION['train_no'];
//$d= select DATEADD(day,1,date($date));
//echo $date;
//echo $date;
$dbhost = 'localhost';
$dbname = 'dbtest';
$dbuser = 'root';
$dbpass = '';
$db1 = new mysqli($dbhost,$dbuser,$dbpass,$dbname);


//$statement = $db->prepare("SELECT * FROM tickets WHERE TrainNumber = ? AND booking_date = ? AND no_of_seats >= ? AND flexible = 1 ORDER BY pnr LIMIT 1");
//$statement->execute(array($train_no,date($date),$seat_no));
//$result1 = $statement->fetch()['available_seats'];
//$result2 = $statement->fetch()['pnr'];
//echo $result1;
//echo "ayush";
//echo $result2;
$pnrf=NULL;
$abc = "SELECT * FROM tickets WHERE TrainNumber = '$train_no' AND booking_date = '$date' AND no_of_seats >= '$seat_no' AND flexible = 1 ORDER BY pnr LIMIT 1";
$row = $db1->query($abc);
$result =$row->fetch_array(MYSQLI_ASSOC);
if($result['pnr']){
$pnrf=$result['pnr'];}
$seatf=$result['no_of_seats'];
$datef=$result['booking_date'];
$bookdate=date('Y-m-d H:i:s',strtotime('today IST'));


  $statement5 = $db->prepare("SELECT * FROM trains WHERE TrainNumber = ?");
  $statement5->execute(array($train_no));
  $price = $statement5->fetch()['price']; 





if($pnrf!=NULL)
{
  $available_Date=NULL;
$abc1 = "SELECT * FROM train_status WHERE TrainNumber = '$train_no' AND available_seats >= '$seatf'  ORDER BY available_Date LIMIT 1";
$row1 = $db1->query($abc1);
$result1 =$row1->fetch_array(MYSQLI_ASSOC);
$available_Date=$result1['available_Date'];

if( $available_Date!=NULL)
{

$abc2 = "UPDATE train_status SET available_seats = available_seats - $seatf, booked_seats = $seatf  where TrainNumber = '$train_no' AND available_Date = '$available_Date' ";
$row2 = $db1->query($abc2);

$abc3 = "UPDATE train_status SET available_seats = available_seats + $seatf  where TrainNumber = '$train_no' AND available_Date = '$datef'";
$row3 = $db1->query($abc3);


$price1 = $price - 0.05*$price;
$abc4 = "UPDATE tickets SET booking_date = '$available_Date', flexible = 0, price = '$price1' where pnr='$pnrf'";
$row4 = $db1->query($abc4);

$random=str_shuffle("012345678915975369740582198745632109632587410756489156324");
$pnr_new=substr($random,0,6);




$price2 = $price + 0.15*$price;
$abc5 = "INSERT into tickets values('$pnr_new','$p_name','$train_no','$seat_no','cnf-emr','$date1','$bookdate',0,'$price2')";
$row5 = $db1->query($abc5);

$abc6 = "UPDATE train_status SET available_seats = available_seats- $seat_no  where TrainNumber = '$train_no' AND available_Date = '$date1'";
$row6 = $db1->query($abc6);
?>
<div align="center" class="col-md-3">
<table class="table tablebg">
  <tr>
    <td>Your Requested is completed </td>
  </tr>
  <tr>
    <td>You are booked under emergency Quota </td>
  </tr>
  <tr>
    <td>You have booked : <?php echo $seat_no ;?> seats.</td>
  </tr>
  <tr>
    <td>Your PNR is : <?php echo $pnr_new ;?></td>
  </tr>
</table>
</div>



  <form style="margin-top:25px;" name="adform" action="userhome.php" class="form-horizontal" >
     <div align="center" class="col-md-3">
      <table class="table tablebg">
        <tr>
          <td>Please pay rupees - <?php echo $price2 ;?>/- </td>
            <td><a><input type="submit" value="PAY" name="PAY" /></a></td>
        </tr>
      </table>
    </div>
  </form>



<?php
}
else {?>
  <div align="center" class="col-md-3">
  <table class="table tablebg">
    <tr>
      <td> Sorry!Your Resevation cannot be confirmed</td>
    </tr>
    <tr>
      <td>No flexible passengers can be booked on another date due to unavailability of seats </td>
    </tr>
  </table>
  </div>
<?php    }
}
else
 { ?>
   <div align="center" class="col-md-3">
   <table class="table tablebg">
     <tr>
       <td> Sorry!Your Resevation cannot be confirmed</td>
     </tr>
     <tr>
       <td>No flexible passengers available on your desired seats </td>
     </tr>
   </table>
   </div>
   <?php
}
?>
