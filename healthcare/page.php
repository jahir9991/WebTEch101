
<?php
session_start();

function myDbConnect()
    {
        $con=mysql_connect("localhost","root","");
        if(!$con)
        {

            die("unable to connect database");

        }

        mysql_select_db("healthcare",$con);
    }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data=mysql_real_escape_string($data);
    return $data;
}

function page_header($title)
{
?>
<html >
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="style.css">


</head>
<body>
<div id="header" >
</div>
<div class="k">

</div>
<?php
}



// .........................................code....................................


function page_footer()
{

?>
<div id="m">
    <br/>
</div>
<div id="footer">

    <h1>Copyright@.....</h1>

</div>
</body>
</html>
<?php
}
/**
 * @return string
 */
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

    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            return "true";
        } else {
            $picErr= "Sorry, there was an error uploading your file.";
            return $picErr;
        }
    }






}
?>
