<?php
require_once("headfooter.php");
page_header("User Home");
if (!isset($_SESSION["row"])) {
        header("Location: index.php");
        exit;
    }
$passErr="";$cnt=true;
 $row=$_SESSION['row'];
 $_SESSION["newpass"]=$row["pass"];
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  ?>

  <tr  >
  <td colspan="2" >
      <table  width="100%" frame="red" id="dn" cellpadding="2px">
        <tr bgcolor="green">

<td > <h3> Welcome <font color="white"><i><?=$row["fname"]." ".$row["mname"]." " .$row["lname"]?></font> </h3>   </td>
            <td align="right" colspan="3">
                        <a  href="logout.php"> <img src="img/logout.png" height="40" width="80"> </a>
           </td>
      </tr>
              <tr>
         <td>
            <img src="uploads\<?=$row['pic']?>" height="225" width="225">
          </td>
              <td >
            <?php
                 echo "User Name : " . $row["username"] ."<br> ";
                 echo "Name: ". $row["fname"]. " ".$row["mname"] ." ". $row["lname"] . "<br>";
                 echo "Email: " . $row["email"] ."<br> ";

                 echo "Password: " . $_SESSION['row']["pass"] ."<br> ";
                 $gender="";
                if ($row["gender"]==1) {
                   $gender="Male";
                }
                  else
                     $gender="Female";

                   echo "Gender: " . $gender ."<br> ";

        if (isset($_POST["Submit"]))
        {
          $p=trim($_POST["pass"]);

                 if (empty($p)) {
                $passErr = "Password is required"; $cnt=false;
                                              }

            else {
                    $pass = test_input($_POST["pass"]);
                      if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $pass)) {
                       $passErr = "please check the password rule "; $cnt=false;

                  }
              }
              if ($cnt) {
                   dbconnect();
                      $q="UPDATE user SET pass='$pass'
                      WHERE username='".$row["username"]."'";
                             $r= mysql_query($q);
                      if ($r) {
                          $passErr="SUCCESSFULL";
                          $_SESSION["newpass"]=$pass;
                          // header("Location: refresh.php");
                          // exit;
                      }else
                             $passErr="Update failed" ;

                }


        }

           ?>
          <form action="home.php" method="post">

          change password: <input type="text" name="pass" >
          <input type="submit" name="Submit" value="change">

          </form>
          <div class="error">  <b><?=$passErr?><b>   </div>
         <button style="position: absolute;" onclick="rule()">***rule</button>
          </td >
          <td>
              <a align="left" href="refresh.php"><img src="img/refresh.png" height="80" width="80"></a>
          </td>
      </tr>
      </table>
  </td>
</tr>
  <?php
  page_footer(  );

   ?>