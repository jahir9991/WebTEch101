
<?php
session_start();
function dbconnect()
    {
            $con = mysql_connect("localhost","root","");

            if(!$con){
                die("could not connect to DB");
            }

            mysql_select_db("test",$con);

    }
function page_header($title)
{
?>
<html>
<head>
    <title><?=$title?> </title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
        .error {color: #FF0000;}
       table.fixed { table-layout:fixed; width:900px; font-size: 20; font-style: bold; }

    </style>
</head>
<body   bgcolor="#F0B8B8">
 <script type="text/javascript">
              function rule()
              {
                  window.alert("the password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit exm:Aaaaaaa8");



              };


          </script>
    <div id="wrapper">

        <div id="header">

                    <h1>GSM Arena</h1>
         </div>


 <table  width="100%" cellpadding="0" cellspacing="0">
<?php
}
function page_footer()
{
?>

  </table>
  <div id="footer">

          <h1 align="bottom">copyright@GSMArena,<?=date("Y")?></h1>

</div>

    </div>

</body>
</html>
<?php
}
?>