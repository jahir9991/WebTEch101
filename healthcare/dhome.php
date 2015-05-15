<?php
require_once("page.php");
page_header("Doctor Home");
myDbConnect();
$row=$_SESSION["row"];
$uname=$row["uname"];

$q1="SELECT * FROM doctorinfo WHERE duname='$uname' ";

$date="2015-04-08";

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
$msg="";
$rn2=$row2=$res2="";
if(isset($_POST["select"])) {

    $date = $_POST["date"];
    if (empty($date)) {
        $msg = "Please Pick a date ";

    } else {
        myDbConnect();

        $q2 = "SELECT * FROM appointment WHERE duname='$uname' AND date='$date'";

        $res2 = mysql_query($q2);
        $rn2 = mysql_num_rows($res2);
    }

}

?>

<table  width ="100%" id="bn1">
    <tr bgcolor="#d2691e">
        <td colspan="2" align = "right">
            <h3>Welcome :<?=@$uname?></h3>
            <a href="logout.php">Log Out</a>
        </td>
    </tr>
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
        <td colspan="2">


            <form action="dhome.php" method="post">
                <P><b>Select a date of appoinment.</b></P>
                <input type="date" name="date">
                <input type="submit" name="select" value="select"/>
               <h2><?=$msg ?></h2>
            </form>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <table id="bn1">
                <th> Appointment Id </th>
                <th> Patient Name </th>
                <th> Date </th>
                <th> Time </th>

                <?php




                        if ($rn2 > 0) {
                                            while ($row2 = mysql_fetch_assoc($res2)) {
                                                echo " <tr>
                                                    <td>" . "&nbsp" . $row2["aid"] . "&nbsp" . "</td>
                                                    <td>" . "&nbsp" . $row2["puname"] . "&nbsp" . "</td>
                                                    <td>" . "&nbsp" . $row2["date"] . "&nbsp" . "</td>
                                                    <td>" . "&nbsp" . $row2["time"] . "&nbsp" . "</td>


                                               </tr>";
                                            }


                                      }
                else{
                    echo " <tr>
                        <td colspan='3'>no appointment on $date </td></tr>";

                }

                ?>
            </table>

        </td>
    </tr>

</table>

<?php
page_footer();
?>
