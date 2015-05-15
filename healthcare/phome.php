<?php
require_once("page.php");
page_header("Patient Home");
myDbConnect();


$row=$_SESSION["row"];
$uname=$row["uname"];



$q1="SELECT * FROM patientinfo WHERE puname='$uname' ";

$res1= mysql_query($q1) ;
$rn1=mysql_num_rows($res1);


$fname=$lname=$pic="";
if ($rn1>0) {
    $row1 =mysql_fetch_assoc($res1);
    $fname=$row1["fname"];
    $lname=$row1["lname"];

    $pic=$row1["img"];
}




if(isset($_POST["choose"]))
{

    $_SESSION["docuname"]=$_POST["doc"];
    $_SESSION["patuname"]=$uname;

  header('Location: take.php');
  exit;

}



function ddddd( $docrow ,$track)
{

    ?>
    <tr>
            <td height="100px" width="10px">
                <img src="upload/<?=$docrow["img"]?>" height="100px" width="100px"/>
            </td>

    <?php


    echo "

                        <td>" . "&nbsp" . $docrow["fname"] . "&nbsp" .$docrow["lname"] . "</td>

                        <td>" . "&nbsp" . $docrow["designation"] . "&nbsp" . "</td>
                        <td>" . "&nbsp" . $docrow["hospital"] . "&nbsp" . "</td>
                        <td>" . "&nbsp" . $docrow["ph1"] . "&nbsp" . "</td>
                        <td>" . "&nbsp" . $docrow["email"] . "&nbsp" . "</td>





                   </tr>"
    ;
    ?>
    <td>

            <input type="submit" name="choose"  value="Take Appointment" >

    </td>



<?php



}


?>



    <div id="home" >
            <h3>Welcome :<?=@$uname?><a href="logout.php">Log Out</a></h3>
    </div>




<table  width ="100%" id="mtable">
<tr>
    <td width="30%" bgcolor="#d2691e">
        <table >
            <tr>
                <td>
                    <img src="upload/<?=$pic?>"height="200" width="200" alt=""/>

                </td>
                <td>
                    <div> Name : <?php echo $fname." ". @$lname?></div><br/>


                </td>
            </tr>
            <tr>
                <td>
                    <form action="phome.php" method="post">
                        <P><b>Select a date of appoinment.</b></P>
                        <input type="date" name="date"  >
                        <input type="submit" name="select" value="Select"/>
                        <input type="submit" name="selectall" value="Select All"/>

                    </form>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table bgcolor="#00FFFF" id="bn1" >
                        <th> Appointment Id </th>
                        <th> Doctor Name</th>
                        <th> Time </th>
                        <th> Date </th>


                        <?php
                        if(isset($_POST["select"])) {
                            myDbConnect();
                            $date=$_POST["date"];
                            $duname = $row["uname"];
                            $q = "SELECT * FROM appointment WHERE puname='$uname' AND DATE='$date'";

                            $res = mysql_query($q);
                            $rn = mysql_num_rows($res);
                            if ($rn > 0) {
                                while ($approw = mysql_fetch_assoc($res)) {
                                    echo " <tr>

                        <td>" . "&nbsp" . $approw["aid"] . "&nbsp" . "</td>
                        <td>" . "&nbsp" . $approw["duname"] . "&nbsp" .  "</td>
                        <td>" . "&nbsp" . $approw["time"] . "&nbsp" . "</td>
                   </tr>";
                                }

                            }
                        }

                        if(isset($_POST["selectall"])) {
                            myDbConnect();

                            $q = "SELECT * FROM appointment WHERE puname='$uname'";

                            $res = mysql_query($q);
                            $rn = mysql_num_rows($res);
                            if ($rn > 0) {
                                while ($approw = mysql_fetch_assoc($res)) {
                                    echo " <tr>

                        <td>" . "&nbsp" . $approw["aid"] . "&nbsp" . "</td>
                        <td>" . "&nbsp" . $approw["duname"] . "&nbsp" .  "</td>
                        <td>" . "&nbsp" . $approw["time"] . "&nbsp" . "</td>
                        <td>" . "&nbsp" . $approw["date"] . "&nbsp" . "</td>
                   </tr>";
                                }

                            }
                        }
                        ?>
                    </table>

                </td>


            </tr>
        </table>



    </td>
<!--....................................................-->
    <td width="70%">

             <table>

                    <tr bgcolor="#8a2be2">
                        <td >
                            <form action="phome.php" method="post">

                            <select name="experties">
                                <option value="0">Please select one</option>
                                <option value="Cardiologist">Cardiologist</option>
                                <option value="Dermatogist">Dermatogist</option>
                                <option value="ENT">ENT</option>
                                <option value="Gastrologist">Gastrologist</option>
                                <option value="Gynecologist">Gynecologist</option>
                                <option value="Medicine">Medicine</option>
                                <option value="Neurologist">Neurologist</option>
                                <option value="Oncologist">Oncologist</option>
                                <option value="Pathologist">Pathologist</option>
                                <option value="Plastic Surgeon">Plastic Surgeon</option>
                                <option value="Urologist">Urologist</option>
                            </select>


                                <input type="submit" name="Search" id="Search"/>
                            </form>

                        </td>
                    </tr>
                 <tr>
                     <td>
                         <table bgcolor="#00FFFF" align="top" id="bn1" >
                             <th> </th>
                             <th> Doctor NAME </th>
                             <th> Designation </th>
                             <th> Hospitals </th>
                             <th> Phone </th>
                             <th> Email </th>

                             <?php
                             if(isset($_POST["Search"])) {

                                 $track=1;
                                 myDbConnect();
                                 $exp=$_POST["experties"];

                                 $q = "SELECT * FROM doctorinfo WHERE experties='$exp' ";

                                 $res = mysql_query($q);
                                 $rn = mysql_num_rows($res);
                                 if ($rn > 0) {
                                     while ($docrow = mysql_fetch_assoc($res))
                                     {

                                          ?>

                                            <form action="phome.php" method="post">


                                                <input  type="text"  style="visibility:hidden; "   name="doc" value="<?=$docrow["duname"]?>"/>

                                                <?php

                                                    

                                                    ddddd($docrow,$track);

                                                $track++;

                                                ?>
                                                </form>
                                                         <?php



                                     }

                                 }
                             }
                             ?>


                         </table>

                     </td>
                 </tr>

             </table>




      </td>
 </tr>


    </table>

<?php
page_footer();







?>