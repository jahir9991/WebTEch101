
<?php
session_start();
function dbconnect()
    {
            $con = mysql_connect("localhost","root","");

            if(!$con){
                die("could not connect to DB");
            }

            mysql_select_db("gsmarena",$con);

    }
function page_header($title)
{
?>
<html>
<head>
    <title><?=$title?> </title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
        .error {color: #ff1706;}
       table.fixed { table-layout:fixed; width:900px;  }

    </style>
</head>
<body >

    <div id="wrapper">

        <div id="header">

                    <h1 style="font-size:85 ">Health Care</h1>
         </div>


 <table   cellpadding="0" cellspacing="0">
<?php
}
function page_footer()
{
?>

  </table>
  <div id="footer">

          <h1 align="bottom">copyright@,<?=date("Y")?></h1>

</div>

    </div>

</body>
</html>
<?php
}
?>