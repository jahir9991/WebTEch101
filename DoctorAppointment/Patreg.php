<?php
require_once("head_footer.php");
page_header("Registration Page");

// if (isset($_SESSION["row"])) {
//         header("Location: logout.php");
//         exit;
//     }


$unameErr = $fnameErr=$mnameErr= $lnameErr=$ageErr =$picErr= $emailErr=$phoneErr = $passErr =$cpassErr= $genderErr ="";
$prule="Ex:  Aaaaaaaa8"; $urule="Ex:  aabbc1_@";
$uname = $fname = $mname = $lname  = $pass=$cpass = $email =$phone= $dept =$age= $gender ="";
$cnt=true;

function picupload()
{
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $picErr="";

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {
        $picErr= "File is not an image.";
        $uploadOk = 0;
        return $picErr;
    }


    if (file_exists($target_file)) {
        $picErr="Sorry, file already exists.";
        $uploadOk = 0;
        return $picErr;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $picErr= "Sorry, your file is too large.";

        $uploadOk = 0;
        return $picErr;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $picErr= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        return $picErr;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $picErr="Sorry, your file was not uploaded.";
        return $picErr;

    }
    else
    {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            return "true";
        } else {
            $picErr= "Sorry, there was an error uploading your file.";
            return $picErr;
        }
    }

}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["Rsubmit"]))
{


    if (empty($_POST["uname"])) {
        $unameErr = "User Name is required";
        $cnt= false;
    }
    else {
        $uname = test_input($_POST["uname"]);


        if (!preg_match("/^[^0-9][A-z0-9_@]{5,}$/", $uname ) ) {
            $unameErr = "Wrong Format of Uname";
            $urule="cant start with digit
                                at lest 6 character with _ @" ;
            $cnt=false;
        }
        else{
            dbconnect();

            $q = "SELECT * FROM user WHERE username = '$uname'";
            $rs = mysql_query($q);

            if(mysql_num_rows($rs)==1)
            {
                $unameErr = "Username already exist";
                $cnt=false;

            }
        }

    }


    if (empty($_POST["fname"]))
    {  $fnameErr = "First Name is required";  $cnt=false; }
    else {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $fname))
        {   $fnameErr = "Only letters and white space allowed";  $cnt=false;}
    }

    if (!empty($_POST["mname"]))
    {
        $mname = test_input($_POST["mname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $mname))
        {   $mnameErr = "Only letters and white space allowed";  $cnt=false;}
    }

    if (empty($_POST["lname"]))
    {  $lnameErr = "Last Name is required";   $cnt=false;}
    else {
        $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed"; $cnt=false;
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



    if (empty($_POST["pass"])) {
        $passErr = "Password is required"; $cnt=false;
    }
    else {
        $pass = test_input($_POST["pass"]);
        $cpass = test_input($_POST["cpass"]);


        if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $pass))
        {
            $passErr = "please check the password rule "; $cnt=false;
            $prule= "must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit";
        }
        if ($pass !==$cpass) {
            $cpassErr = "Password not mached"; $cnt=false;
        }


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

                $pic="student.jpg";

            }
            else
                $pic="student1.jpg";

        }


    }
    if($cnt)
    {

        $uname = trim($_POST["uname"]);
        $fname = trim($_POST["fname"]);
        $mname = trim($_POST["mname"]);
        $lname = trim($_POST["lname"]);

        $pass = trim($_POST["pass"]);
        $email = trim($_POST["email"]);

        $gender =trim($_POST["gender"]);

        $q = "INSERT INTO user VALUES('$uname','$pass','$fname','$mname',
                                 '$lname','$email',$gender,'$pic')";
        mysql_query($q);
        header("Location:Pathome.php");
        exit;

    }
}
?>
<tr>
    <td>
        <a  href="logout.php"> <img src="img/home.jpg" height="40" width="120"> </a>
    </td>
</tr>

<tr>
    <td colspan="3">
        <fieldset  id="bn" width="100%">
            <legend     align="center"><font size="20">Registration</font></legend>
            <table  align="center" cellpadding="5" bgcolor="#DAECEE" class="fixed">

                <form action="Docreg.php" method="post" enctype="multipart/form-data" >

                    <tr >
                        <td align="right" width="25%" > User Name : </td>
                        <td class="error" width="30%"> <input type="text" name="uname" value="<?=$uname?>" />*</td>
                        <td><span class="error" ><?=$unameErr?></td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="error"><?=$urule?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"> Password : </td>
                        <td class="error"> <input type="password" name="pass" value="<?=$pass?>"/>*
                            <!-- <button onclick="rule()">***rule</button> -->
                        </td>
                        <td> <span class="error"><?=$passErr?></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="error"><?=$prule?>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td align="right"> Confirm Password : </td>
                        <td class="error"> <input type="password" name="cpass" value="<?=$cpass?>"/>*</td>
                        <td> <span class="error"><?=$cpassErr?></span></td>
                    </tr>

                    <tr>
                        <td align="right"> First Name : </td>
                        <td class="error"> <input type="text" name="fname" value="<?=$fname?>" />* </td>
                        <td><span class="error" ><?=$fnameErr?></td>
                    </tr>
                    <tr>
                        <td align="right"> Middle Name : </td>
                        <td > <input type="text" name="mname" value="<?=$mname?>" /></td>
                        <td> <span class="error"><?=$mnameErr?></span></td>
                    </tr>
                    <tr>
                        <td align="right"> Last Name : </td>
                        <td class="error" > <input type="text" name="lname" value="<?=$lname?>" />*</td>
                        <td> <span class="error"><?=$lnameErr?></span></td>
                    </tr>
                    <tr>
                        <td align="right"> Age : </td>
                        <td class="error" > <input type="text" name="age" value="<?=$age?>" />*</td>
                        <td> <span class="error"><?=$ageErr?></span></td>
                    </tr>

                    <tr>
                        <td align="right"> Gender : </td>
                        <td> <input type="radio" name="gender" value =1>Male
                            <input type="radio" name="gender" value =2 />Female <span class="error">*</span></td>
                        <td> <span class="error"><?=$genderErr?></span></td>
                    </tr>

                    <tr>
                        <td align="right"> Email : </td>
                        <td class="error"> <input type="text" name="email"value="<?=$email?>"/>*</td>
                        <td> <span class="error"><?=$emailErr?></span></td>

                    <tr>
                    <tr>
                        <td align="right"> Phone : </td>
                        <td class="error"> <input type="text" name="phone"value="<?=$phone?>"/>*</td>
                        <td> <span class="error"><?=$phoneErr?></span></td>
                    </tr>



                    <tr>
                        <td align="right"> Image : </td>
                        <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                        <td> <span class="error"><?=$picErr?></span></td>
                    </tr>
                    <tr><td>

                        </td></tr>


                    <tr>
                        <td>

                        </td>
                        <td> <input type="submit" name="Rsubmit" bgcolor="red" style="position:absolute; height:60; width: 200" value="Registration" /> </td>
                    </tr>

                    <tr height="60"><td></td></tr>

                </form>
            </table>

        </fieldset>


    </td>
</tr>
<?php
page_footer();
?>

