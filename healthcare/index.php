

<?php
require_once("page.php");
page_header("Healthcare.com");

$message=""; $cnt=true;
if (isset($_POST["login"]))
{


    if (empty($_POST["uname"])) {
        $message="user name can't be Empty";
        $cnt= false;
    }
    else{
        $uname=test_input($_POST["uname"]);
        if (!preg_match("/^[^0-9][A-z0-9_@]{5,}$/", $uname ) ) {
            $message = "Wrong formet of username";
            $cnt=false;
        }
                else{
                    if (empty($_POST["pass"])) {
                        $message="Password can't be Empty";
                        $cnt= false;
                    }
                    else{
                            $pass=test_input($_POST["pass"]);
                            if (!preg_match("/^[a-zA-Z0-9]*$/", $pass))
                            {
                                $message = "Wrong password";
                                $cnt=false;
                            }


                         }
                     }


        }

    if ($cnt)
    {
        myDbConnect();

        $q = "SELECT * FROM login WHERE uname = '$uname' AND pword = '$pass'";
        $res = mysql_query($q);

        if(mysql_num_rows($res)>0)
        {
            $_SESSION["row"]= mysql_fetch_assoc($res);
            if($_SESSION["row"]["type"]=="1")
            {
                header('Location: dhome.php');
                exit;
            }
            elseif($_SESSION["row"]["type"]=="2")
            {
                header('Location: phome.php');
                exit;
            }
        }
        else
            $message = "Wrong Information";

    }
}

?>

<fieldset id="bn" >
    <legend><h1>Log In</h1></legend>
    <form action="index.php" method="post">

        <table>
            <tr>
                <td>User name:</td>
                <td>
                    <input type="text" name="uname"/>
                </td>


            </tr>
            <tr>

            </tr>
            <tr>
                <td>Password :</td>
                <td>
                    <input type="password" name="pass"/>
                </td>

            </tr>
            <tr>

            </tr>

            <tr>

                <td>
                    <input type="submit" name="login" value="Log In" />
                </td>


            </tr>
            <tr>
                <td>
                    <br/>  Not Registered?<br/>
                Sign Up Now as <a href="dreg.php">Doctor</a> <br/>or <a href="preg.php">Patient</a>
                </td>
            </tr>

        </table>


    </form>
    
    
</fieldset>




























<?php

page_footer();


?>
