
  <div class="row">
  <div class="banner col-lg-13">

<?php
$pics = ['landmannalaugar','laugavegur','northernlights','thorsmork','gullfoss','geysir'];
$headings = ['Climp A Mountian!',"Let's take a look at the view!", "See The Northern Lights!", 'See The Magificent Nature!','See Our Beutiful Waterfalls!','See Our Springs!'];

$randpic = rand(0, count($pics)-1);//Hér er valið random stak úr fylkinu -1 því count byrjar að telja á 1 (fylki byrja alltaf á 0)

$path = "./pics/Banner/{$pics[$randpic]}.jpg";//Hérna er síðan sett slóðina í streng með því að tilgeina hvar mappan er og taka stak úr fylkinu sem er random stak s.s. randpic.
echo '<h1>'.$headings[$randpic].'</h1>';//Heading sem fylgir hverri mynd
?>
<img src="<?= $path;?>" class="img-responsive" >
</div>
</div>
