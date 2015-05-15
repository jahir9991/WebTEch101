 <?php
 require_once("headfooter.php");
 dbconnect();

            $q = "SELECT * FROM user WHERE username ='".$_SESSION['row']["username"]."' AND pass= '"
            .$_SESSION['newpass']."'";
            $rs = mysql_query($q);
            if(mysql_num_rows($rs)==1)
                {
                    $_SESSION['row']= mysql_fetch_assoc($rs);
                     header ('Location: home.php');
                     exit;
                }




 ?>