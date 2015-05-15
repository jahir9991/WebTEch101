<?php
require_once("page.php");
page_header("Doctor Registration ");

$unameErr = $fnameErr  = $lnameErr  = $passErr =$conpassErr=$ageErr = $emailErr = $picErr =$phone1Err=$phone2Err= $genderErr =$qualificationErr=$designationErr=$addressErr=$expertiesErr=$hospitalErr="";
$prule="Ex:  Aaaaaaaa8"; $urule="Ex:  aabbc1_@";
$uname = $fname  = $lname  = $pass = $conpass = $age = $email = $pic =$phone1=$phone2= $gender =$qualification=$designation=$address=$experties=$hospital="";
$cnt=true;

if (isset($_POST["dreg"])) {


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
        $qualification = test_input($_POST["qualification"]);
        $designation = test_input($_POST["designation"]);
        $experties = test_input($_POST["experties"]);
        $email = test_input($_POST["email"]);
        $phone1 = test_input($_POST["phone1"]);
        $phone2 = test_input($_POST["phone2"]);
        $hospital = test_input($_POST["hospital"]);
        $address = test_input($_POST["address"]);
        $pic=test_input($_FILES["fileToUpload"]["name"]);
        $type=1;

        $q1 = "INSERT INTO login VALUES('$uname','$pass','$type')";
        mysql_query($q1);


        //INSERT INTO `healthcare`.`doctorinfo`

        $q2 = "INSERT INTO doctorinfo VALUES('$uname','$pass','$fname','$lname',$age, $gender, '$qualification', '$designation','$hospital','$address','$experties','$email','$phone1','$phone2', '$pic')";
        mysql_query($q2);
        $_SESSION['row']['uname']=$uname;
        header("Location:dhome.php");
        exit;

    }
}



?>
<h1><a href="logout.php">Home</a></h1>
<fieldset id="bn1">
    <legend>Doctor Registration</legend>
    <table>
        <form action="dreg.php" method="post"  enctype="multipart/form-data">

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
                    Qualification :
                </td>
                <td >
                    <input type="text" name="qualification" value="<?=$qualification?>">*
                </td>
                <td >
                        <span class ="error"><?=$qualificationErr?>
                </td>
            </tr>

            <tr>
                <td >
                    Designation :
                </td>
                <td >
                    <select name="designation">
                        <option value="0">Please select one</option>
                        <option value="Professor">Professor</option>
                        <option value="Ass. Professor">Ass. Professor</option>
                        <option value="Senior Doctor">Senior Doctor</option>
                        <option value="Junior Doctor">Junior Doctor </option>
                    </select>
                </td>
                <td >
                        <span class ="error"><?=$designationErr?>
                </td>
            </tr>

            <tr>
                <td >
                    Experties :
                </td>
                <td >
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
                </td>
                <td >
                        <span class ="error"><?=$expertiesErr?>
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
                    Phone 1 :
                </td>
                <td >
                    <input type="text" name="phone1" value="<?=$phone1?>">*
                </td>
                <td >
                        <span class ="error"><?=$phone1Err?>
                </td>
            </tr>

            <tr>
                <td >
                    Phone2 :
                </td>
                <td >
                    <input type="text" name="phone2" value="<?=$phone2?>">*
                </td>
                <td >
                        <span class ="error"><?=$phone2Err?>
                </td>
            </tr>

            <tr>
                <td >
                    Hospital Name :
                </td>
                <td >
                    <input type="text" name="hospital" value="<?=$hospital?>">*
                </td>
                <td >
                        <span class ="error"><?=$hospitalErr?>
                </td>
            </tr>

            <tr>
                <td >
                    Address :
                </td>
                <td >
                    <input type="text" name="address" value="<?=$address?>">*
                </td>
                <td >
                        <span class ="error"><?=$addressErr?>
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
                <td colspan="2">
                    <input type="submit" name="dreg" value="Registration"    style="margin-left:100px; position:relative; height:60; width: 200"/>
                </td>
            </tr>

        </form>
    </table>
</fieldset>



<?php

page_footer();
?>


