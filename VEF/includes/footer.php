<footer>
<strong>
&copy arnar 
<?php 
$startyear = "2015";
$yearnow = date('Y');

if($startyear == $yearnow)
	{
		echo $yearnow;
	}

else{
	echo $startyear.' - '.$yearnow;
}

?> &ndash; All rights reserved
</strong>
</footer>