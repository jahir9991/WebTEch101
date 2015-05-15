<?php
require_once("db.php");
function PageHeader()
{
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div id="wrapper"> 
		<div id="header">
			<h1>GSM Arena</h1>
		</div>
		<table s width="100%">
		<tr bgcolor="#ffdead">
			<td width="200">
				<ul id="lmenu">
					<?=UserMenu()?>

				</ul>
			</td>
    <td width="200">
        <ul id="lmenu">

           <?=ProductMenu(3)?>
        </ul>
    </td>
            <td >

                    <?=Show(10)?>

            </td>

    <td>
<?php
}
function PageFooter()
{
?>
</td>
</tr>

</table>
<div id="footer">Copyright to kkkkkkkkkkkWeb sec:c , 2015</div>
</div>
</body>

<?php
}
function UserMenu()
{
		$q = "SELECT * FROM CAT ";
		$data = mysql_query($q);
		while($r= mysql_fetch_assoc($data))
		{
			echo "<li><a href=''>".$r["Cname"]."</a></li>";
		}
}
function ProductMenu($p)
{
    $r = "SELECT * FROM `product` WHERE Cid=$p";
    $data1 = mysql_query($r);
    while($m= mysql_fetch_assoc($data1))
    {
        echo "<li><a href=''>".$m["Pname"]."</a></li>";
    }
}
function Show($p)
{
    $r = "SELECT * FROM `product` WHERE Pid=$p";
    $data1 = mysql_query($r);
    while($m= mysql_fetch_assoc($data1))
    {
        echo"<div><h1>$m[Pname]<h1/></div> ";
        ?>
      <div><img src="images/<?="$m[Pic]"?>" height="200" width="150" alt=""/></div>
        <?php

        echo"Price: $m[Price]";
        echo"<div><h2> Release Date : $m[Rdate] </h2> </div>";
        echo "<div>$m[Desc] </div>";
        echo "gvdgcvdhv";


    }
}
?>



