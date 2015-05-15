
<?php
require_once("page.php");
page_header("Patient Home");



$pat=$_SESSION["patuname"];


$msg="";

$docuname=$_SESSION["docuname"];

$q1="SELECT * FROM doctorinfo WHERE duname='$docuname' ";


myDbConnect();
$res1= mysql_query($q1) ;
$rn1=mysql_num_rows($res1);

$fname=$lname=$des=$hospital=$address=$experties=$pic="";

if ($rn1>0) {
    $row1 =mysql_fetch_assoc($res1);
    $fname=$row1["fname"];
    $lname=$row1["lname"];
    $des=$row1["designation"];
    $hospital=$row1["hospital"];
    $address=$row1["address"];
    $experties=$row1["experties"];
    $pic=$row1["img"];
}


if(isset($_POST["select"])) {
    myDbConnect();

    $time = $_POST["time"];
    $date = $_POST["date"];
    $q1 = "SELECT * FROM appointment WHERE duname='$docuname' AND date='$date' AND time='$time'";
    $res = mysql_query($q1);

    $rn1 = mysql_num_rows($res);


    if ($rn1 > 0) {

        $msg = "Already Booked";


    } elseif($rn1<1)
    {
     echo  $pat .
        $date ,
        $time .
        $docuname;
        myDbConnect();
        $q2 = "INSERT INTO `healthcare`.`appointment` (`aid`, `duname`, `puname`, `date`, `time`, `desc`) VALUES (NULL, '$docuname', '$pat', '$date', '$time', NULL);";

        $result = mysql_query($q2);


      if($result)  {
            header("Location: phome.php");
            exit;


        }else{

            echo"unsuccessfull!!!";
        }


    }

    }
?>

<div id="home" >
    <h3>Welcome :<?=$pat?><a href="logout.php">Log Out</a></h3>
</div>

<table  width ="100%">

<tr>
    <td width = "200" height = "200">
        <img src="upload/<?=$pic?>"height="200" width="200" alt=""/>
    </td>
    <td>
        <div>  <?php echo $fname." ". @$lname?> </br>
            <?=@$des?> </br>
            <?=@$experties?> </br>
            <?=@$hospital?> </br>



        </div>
    </td>
</tr>
<tr>
    <tr>
        <form action="take.php" method="post">
        <td>

                <P><b>Select a date of appoinment.</b></P>
                <input type="date" name="date"  >

            <select name="time">
                <option value="0">select time</option>
                <option value="4 PM">4 PM</option>
                <option value="5 PM">5 PM</option>
                <option value="6 PM">6 PM</option>
                <option value="7 PM">7 PM</option>
                <option value="8 PM">8 PM</option>
            </select>

                <input type="submit" name="select" value="Select"/>
            <span class ="error"><?=$msg?>


        </td>
        </form>
    </tr>

    </table>
<?php
page_footer();
?>