<?php include('header.php');
require '../dbconnect.php';
session_start();
if(isset($_POST['submit']))
{
	$pname=$_POST['pname'];
	$_SESSION['user']=$pname;
	$seat_no=$_POST['seat_no'];
	$_SESSION['seat_no']=$seat_no;
	$date=$_POST['date'];
	$date = date($date);
	$_SESSION['date']=$date;
	$bookdate=date('Y-m-d H:i:s',strtotime('today IST'));
	$_SESSION['bookdate']=$bookdate;
	$train_no=$_POST['TrainNumber'];
	$_SESSION['train_no']=$train_no;
  $train_status = 'confirm';
	$flexible=$_POST['flexible'];	

	//echo $flexible;
	$statement = $db->prepare("SELECT * FROM train_status WHERE TrainNumber = ? and available_Date=?");
	$statement->execute(array($train_no,$date));
	$result = $statement->fetch()['available_seats'];
	//echo $result;
  //$wresult= $statement->fetch()['waiting_seats'];
//	echo $wresult;
	//echo $result;
	if($result >= $seat_no)
	{
		$result = $result - $seat_no ;
		//echo $result;
		$random=str_shuffle("012345678915975369740582198745632109632587410756489156324");
		$pnr=substr($random,0,6);


		$statement = $db->prepare("UPDATE train_status SET available_seats=?,booked_seats=? WHERE TrainNumber=? AND available_Date = ?");
		$statement->execute(array($result,$seat_no,$train_no,$date));



	$statement5 = $db->prepare("SELECT * FROM trains WHERE TrainNumber = ?");
	$statement5->execute(array($train_no));
	$price = $statement5->fetch()['price']; 






		$statement = $db->prepare("INSERT INTO tickets (pnr,passenger_name,TrainNumber,no_of_seats,train_status,booking_date,booked_on,flexible,price) VALUES (?,?,?,?,?,?,?,?,?)");
        $statement->execute(array($pnr,$pname,$train_no,$seat_no,$train_status,$date,$bookdate,$flexible,$price));
		?>
		 
		<div align="center" class="col-md-3">
		<table class="table tablebg">
			<tr>
				<td>Your Requested is completed </td>
			</tr>
			<tr>
				<td>You have booked : <?php echo $seat_no ;?> seats.</td>
			</tr>
			<tr>
				<td>Your PNR is : <?php echo $pnr ;?></td>
			</tr>

		</table>
		</div>
</br></br></br></br></br>
	<form style="margin-top:25px;" name="adform" action="userhome.php" class="form-horizontal" >
	   <div align="center" class="col-md-3">
			<table class="table tablebg">
				<tr>
					<td>Please pay rupees - <?php echo $price ;?>/- </td>
			    	<td><a><input type="submit" value="PAY" name="PAY" /></a></td>
				</tr>
			</table>
		</div>
	</form>

		<?php


	}
	/*if($result < $seat_no)
	{  $train_status = 'waiting';
		$wresult = $wresult-$seat_no ;
		$random=str_shuffle("012345678915975369740582198745632109632587410756489156324");
		$pnr=substr($random,0,6);


		$statement = $db->prepare("UPDATE train_status SET booked_seats=?,waiting_seats=? WHERE TrainNumber=? AND available_Date = ?");
		$statement->execute(array($seat_no,$wresult,$train_no,$date));


		$statement = $db->prepare("INSERT INTO tickets (pnr,passenger_name,TrainNumber,no_of_seats,train_status,booking_date,booked_on,flexible) VALUES (?,?,?,?,?,?,?,?)");
        $statement->execute(array($pnr,$pname,$train_no,$seat_no,$train_status,$date,$bookdate,$flexible));
		?>
		<div align="center" class="col-md-3">
		<table class="table tablebg">
			<tr>
				<td>Your Requested is completed  and you got the waiting ticket</td>
			</tr>
			<tr>
				<td>You have booked  WL- <?phP echo $seat_no ;?> seats.</td>
			</tr>
			<tr>
				<td>Your PNR is : <?php echo $pnr ;?></td>
			</tr>
		</table>
		</div>
		<?php


	}*/
else

	{

	?>
	<div align="center" class="col-md-5">
		<table class="table tablebg">
			<tr>
				<td>Unable to book Desired Number of seats</td>
			</tr>
			<tr>
				<td>Available Seats : <?php echo $result ;?> seats.</td>
			</tr>
		</table>
	</div>
<br><br><br><br><br><br><br><br><br><br>
<h2>Do you have any emergency and want to travel with emergency option<h2>

	<form action="new.php">
	<input type="submit" name="submit" value="PROCEED"/>
</form>

	<?php
	}
}
?>
			  <div class="col-md-12 forminput">


			  </div>
			</div>
		</div>
<?php include('../footer.php'); ?>
