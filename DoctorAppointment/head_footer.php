<?php
session_start();
function dbconnect()
{
    $con = mysql_connect("localhost","root","");

    if(!$con){
        die("could not connect to DB");
    }

    mysql_select_db("healthcare",$con);

}

function page_header($title)
{
    ?>

    <html>
    <!doctype html>

    <head>
        <title><?=$title?></title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>

    <div id="header"  >
    </div >
    <div id="menu">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>

    <table >

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
