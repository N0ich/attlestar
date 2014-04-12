<?PHP

session_start();
require_once("Class/Fleet.class.php");
$x = intval($_GET['army_size']);
if ($x < 1)
	$x = 1;
if ($x > 10)
	$x = 10;
$_SESSION['p1'] = New Fleet(array('player' => 1, 'size' => $x));
$_SESSION['p2'] = New Fleet(array('player' => 2, 'size' => $x));

$p1 = $_SESSION['p1']->getShip();
$p2 = $_SESSION['p2']->getShip();

function check_pos($x, $y, $p1, $p2)
{
	foreach ($p1 as $ship)
	{
		if ($ship['posx'] == $x && $ship['posy'] == $y)
			return ($ship['sizex']);
	}
	foreach ($p2 as $ship)
	{
		if ($ship['posx'] == $x && $ship['posy'] == $y)
			return ($ship['sizex']);
	}
	return (0);
}


?>
<HTML>
<HEAD>
	<TITLE>
		Les_joies_du_git();
	</TITLE>
	<LINK href="style.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<div class="Player1">
	<H3>Player 1 ships</H3>
	<?php
	foreach ($p1 as $ship)
	{?>
	<HR></HR>
	<?PHP echo $ship['name']; ?>
		<BR />
		<img class="ship-img" src="<?PHP print($ship['sprite']);?>">
		<BR />
			<BR />
		<?PHP $hp = $ship['HP'];
			while ($hp > 0)
			{
				$hp -= 1;
		?><img class="hpbar" src="img/hpbar.png"><?PHP } ?>
			<BR />
		<?PHP $pp = $ship['PP'];
			while ($pp > 0)
			{
				$pp -= 1;
		?><img class="ppbar" src="img/blue.jpg"><?PHP } ?>
			<BR />
	<?PHP echo $ship['weapon']; ?>
	<?PHP } ?>
</div>
<div class="battleground">
<table>
	<?PHP for ($i = 0; $i < 100; $i++) { ?>
		<tr>
			<?PHP for ($j = 0; $j < 150; $j++) { if (($size = check_pos($i, $j, $p1, $p2)) != 0) { 
				for ($k = 0; $k < $size; $k++) { ?>
			<td class="shipcase"></td>
			<?PHP } $j += $size; } else { ?>
			<td></td>
			<?PHP } }?>
		</tr>
		<?PHP }?>
</table>
</div>
<div class="Player2">
	<H3>Player 2 ships</H3>
	<?php
	foreach ($p2 as $ship)
	{?>
	<HR></HR>
	<?PHP echo $ship['name']; ?>
		<BR />
		<img class="ship-img" src="<?PHP print($ship['sprite']);?>">
		<BR />
			<BR />
		<?PHP $hp = $ship['HP'];
			while ($hp > 0)
			{
				$hp -= 1;
		?><img class="hpbar" src="img/hpbar.png"><?PHP } ?>
			<BR />
		<?PHP $pp = $ship['PP'];
			while ($pp > 0)
			{
				$pp -= 1;
		?><img class="ppbar" src="img/blue.jpg"><?PHP } ?>
			<BR />
	<?PHP echo $ship['weapon']; ?>
	<?PHP } ?>
</div>
</BODY>
</HTML>