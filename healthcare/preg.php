<?php
require_once("page.php");
page_header("Patient Registration ");

$unameErr = $fnameErr  = $lnameErr  = $passErr =$conpassErr=$ageErr = $emailErr = $picErr =$phoneErr= $genderErr ="";
$prule="Ex:  Aaaaaaaa8"; $urule="Ex:  aabbc1_@";
$uname = $fname  = $lname  = $pass = $conpass = $age = $email = $pic =$phone= $gender ="";
$cnt=true;

if (isset($_POST["preg"])) {


    if (empty($_POST["uname"])) {
        $unameErr = "User Name is required";
        $cnt= false;
    }
    else {
        $uname = test_input($_POST["uname"]);


        if (!preg_match("/^[^0-9][A-z0-9_@]{5,}$/", $uname ) ) {
            $unameErr = "Wrong Format of Username";
            $urule="cant start with digit
                                at lest 6 character with _ @" ;
            $cnt=false;
        }
        else{
            myDbConnect();

            $q = "SELECT * FROM login WHERE uname= '$uname'";
            $rs = mysql_query($q);

            if(mysql_num_rows($rs)==1)
            {
                $unameErr = "Username already exist";
                $cnt=false;

            }
        }

    }


    if (empty($_POST["pass"])) {
        $passErr = "Password is required"; $cnt=false;
    }
    else {
        $pass = test_input($_POST["pass"]);
        $conpass = test_input($_POST["conpass"]);


        if (!preg_match("/^.*(?=.{6,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $pass))
        {
            $passErr = "please check the password rule "; $cnt=false;
            $prule= "must be at least 6 characters and must contain at least one lower case letter, one upper case letter and one digit";
        }
        if ($pass !==$conpass) {
            $conpassErr = "Password not mached"; $cnt=false;
        }


    }

    if (empty($_POST["fname"]))
    {  $fnameErr = "First Name is required";  $cnt=false; }
    else {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $fname))
        {   $fnameErr = "Only letters and white space allowed";  $cnt=false;}
    }



    if (empty($_POST["lname"]))
    {  $lnameErr = "Last Name is required";   $cnt=false;}
    else {
        $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed"; $cnt=false;
        }
    }


    if (empty($_POST["age"]))
    {  $ageErr = "age required ";   $cnt=false;}
    else {
        $lname = test_input($_POST["age"]);
        if (!preg_match("/^[0-9]*$/", $age)) {
            $ageErrErr = "Only numeric value allowed"; $cnt=false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required"; $cnt=false;
    } else {
        $email = trim($_POST["email"]);

        $Emailexp = "/^[^0-9]([A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*$/";
        if (!preg_match($Emailexp, $email)) {
            $emailErr = "Invalid email format"; $cnt=false;
        }
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required"; $cnt=false;
    } else {
        $gender =trim( $_POST["gender"] );
    }





    if ($cnt) {


        if (!empty($_FILES["fileToUpload"]["name"]))
        {
            $result=picupload();
            if ($result=="true") {
                $pic= $_FILES["fileToUpload"]["name"];
                $picErr="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            }
            else{
                $picErr=$result;
                $cnt=false;
            }

        }else
        {
            $picErr="no file";
            if ($_POST["gender"]==1) {
                // VIP
            } else{

            }

        }

    }


    if($cnt)
    {
        myDbConnect();

        $uname = test_input($_POST["uname"]);
        $pass = test_input($_POST["pass"]);
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
        $age = test_input($_POST["age"]);
        $gender = test_input($_POST["gender"]);
        $email = test_input($_POST["email"]);
        $phone = test_input($_POST["phone"]);
        $pic=test_input($_FILES["fileToUpload"]["name"]);
        $type=2;

        $q1 = "INSERT INTO login VALUES('$uname','$pass','$type')";
        mysql_query($q1);




        $q2 = "INSERT INTO patientinfo VALUES('$uname','$pass','$fname','$lname',$age, $gender,'$phone','$email', '$pic')";
        mysql_query($q2);
        $_SESSION['row']['uname']=$uname;
        header("Location:phome.php");
        exit;

    }
}



?>


    <h1><a href="logout.php">Home</a></h1>

    <fieldset id="dreg">
        <legend>Doctor Registration</legend>

        <table>
            <form action="preg.php" method="post"  enctype="multipart/form-data">
                <tr>
                    <td >
                        User name :
                    </td>
                    <td >
                        <input type="text" name="uname" value="<?=$uname?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$unameErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Password :
                    </td>
                    <td >
                        <input type="password" name="pass" value="<?=$pass?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$passErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Re-Password :
                    </td>
                    <td >
                        <input type="password" name="conpass" value="<?=$conpass?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$conpassErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        First Name :
                    </td>
                    <td >
                        <input type="text" name="fname" value="<?=$fname?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$fnameErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Last Name :
                    </td>
                    <td >
                        <input type="text" name="lname" value="<?=$lname?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$lnameErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Age :
                    </td>
                    <td >
                        <input type="text" name="age" value="<?=$age?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$ageErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Gender :
                    </td>
                    <td>
                        <input type="radio" name="gender" value =1>Male
                        <input type="radio" name="gender" value =2 />Female
                    </td>
                    <td>
                        <span class="error"><?=$genderErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Email :
                    </td>
                    <td >
                        <input type="text" name="email" value="<?=$email?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$emailErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Phone :
                    </td>
                    <td >
                        <input type="text" name="phone" value="<?=$phone?>">*
                    </td>
                    <td >
                        <span class ="error"><?=$phoneErr?>
                    </td>
                </tr>
                <tr>
                    <td >
                        Image :
                    </td>

                    <td>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </td>


                    <td >
                        <span class ="error"><?=$picErr?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="preg" value="Registration"/>
                    </td>
                </tr>

            </form>
        </table>
    </fieldset>

<?php

page_footer();
?>