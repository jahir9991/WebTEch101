<?php
require_once("headfooter1.php");
page_header("GSMArena.com");
$msg="";$cnt=true;
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if (isset($_POST["Submit"]))
 {

    if (empty($_POST["uname"])) {
                $msg="user name can't be Empty";
                        $cnt= false;
            }
        else {
                    $uname = test_input($_POST["uname"]);

                     if (!preg_match("/^[^0-9][A-z0-9_@]{5,}$/", $uname ) ) {
                        $msg = "Wrong user name";
                         $cnt=false;
                         }

                         if (empty($_POST["pass"])) {
                            $msg="Password can't be Empty";
                                     $cnt= false;
                             }
                    else {
                         $pass = test_input($_POST["pass"]);
                        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $pass)) {
                         $msg = "Wrong password"; $cnt=false;
                                                                 }
                    }
             }




        if ($cnt)
        {
            dbconnect();

            $q = "SELECT * FROM user WHERE username = '$uname' AND pass = '$pass'";
            $rs = mysql_query($q);

            if(mysql_num_rows($rs)==1)
                {
                    $_SESSION["row"]= mysql_fetch_assoc($rs);


                     header ('Location: Pathome.php');
                     exit;
                }
                else
                    $msg = "Wrong Information";

        }

}


?>



<tr  >
    <td colspan="2" >
        <table width="100%" >

        <tr>
                <td colspan="2" >
                    <img   src="img/gsm.gif" height="225" width="55%"  >
                </td>

                <td align="center" width="350px" >
            <fieldset id="dn" >
            <legend >   Log In :</legend>
            <form action="index.php" method="post" >

                            <table align="center" cellpadding="5" >
                        <tr>
                            <td align="right"> User Name : </td>
                            <td> <input type="text" name="uname"/></td>
                        </tr>
                        <tr>
                            <td align="right"> Password : </td>
                            <td> <input type="password" name="pass"/> </td>
                        </tr>
                        <tr>
                            <td align="right"> &nbsp; </td>
                            <td  > <input type="submit" name="Submit" value="Login"  /></td>

                        </tr>
                        <tr >
                            <td colspan="5">
                            Not a user <a href ="Docreg.php"> Sign Up Now</a>
                            </td>
                        </tr>

                        <tr><td>
                            <a href="admin.php">Admin[show database]</a>
                        </td></tr>
                        <?php

                if(isset($msg))
                {
                    echo "<tr>   <td align=\"right\" colspan=\"2\" class=\"error\"> <b><i>" . $msg ." </i>
                    </b> </td>  </tr>";
                 }

                ?>
            </table>

        </form>
        </fieldset>
        </td></tr>
        <tr><td>


        </td></tr>
        <tr>
            <td>
                <img id="bn" src="img/011.gif" height="200" width="300">
            </td>
            <td>
                <img id="bn" src="img/010.gif" height="200" width="300">
            </td>
            <td>
                <img id="bn" src="img/009.gif" height="200" width="300">
            </td>
        </tr>


</table>
        </td>
        </tr>



<?php

page_footer();


 ?>