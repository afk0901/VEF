<?php 
$pics = ['landmannalaugar','laugavegur','northernlights','thorsmork','gullfoss','geysir'];


$path = "./pics/othertrips/{$pics[$randpic]}.jpg";

?>
<img src="<?= $path;?>" class="img-responsive" >