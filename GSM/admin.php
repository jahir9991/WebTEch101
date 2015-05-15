<?php
require_once("headfooter.php");
page_header("Admin page");

 ?>
 <tr>
    <td>
       <a  href="logout.php"> <img src="img/home.jpg" height="40" width="120"> </a>
    </td>
</tr>
<tr>
    <td align="right">

    <!-- Welcome  <b><?=$_SESSION['row']['fname']?> <i>[admin]<i> <b> <a href="logout.php">Log Out</a> -->

    </td>
</tr>
<tr>
<td>
<table bgcolor="#00FFFF" border="2">
            <th>User name</th>
            <th> Passwoed </th>
             <th>Name</th>
             <th>Email</th>
             <th>Pic</th>
             <th>Gender</th>


 <?php
    dbconnect();

        $q="SELECT * FROM user ";

        $res= mysql_query($q) ;
        $rn=mysql_num_rows($res);
        if ($rn>0) {
            while($row =mysql_fetch_assoc($res)) {
                 echo " <tr><td>"."&nbsp" . $row["username"]."&nbsp" . " </td>

                 <td>"."&nbsp".$row["pass"]."&nbsp" . "</td>
                 <td>"."&nbsp" . $row["fname"]."&nbsp".$row["mname"]."&nbsp".$row["lname"]."&nbsp" . "</td>
                  <td>"."&nbsp".$row["email"]."&nbsp" . "</td>
                  <td>"."&nbsp".$row["pic"]."&nbsp" . "</td>
                  <td>"."&nbsp".$row["gender"]."&nbsp" . "</td>

                 </tr>";
             }

        }
?>
</table>
</td>
</tr>

<?php

page_footer();

  ?>