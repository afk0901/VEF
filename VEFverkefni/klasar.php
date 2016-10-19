<?php
require_once './includes/classes/class.php';
require_once './includes/classes/classadd.php';
$titill1 = "Efnafræði 101";
$titill2 = "Stærðfræði 403";
$titill3 = "Ofvitinn";
$titill4 = "Dísa í draumalandi";
$verd = 2500;
$verd2 = 2000;
$verd3 = 1000;
$verd4 = 3500;

$efnafraedi = new bok($titill1,$verd);
$staerdfraedi = new bok($titill2,$verd2);
$islenska = new bok($titill3,$verd3);
$extendedclass = new publisher($titill4,$verd4);

echo " Efnafræði: ";
echo " Title: ";
$efnafraedi->getTitle();
echo " Price: ";
$efnafraedi->getPrice();
echo " New title: ";
$efnafraedi->setTitle("Efnafræði 102 ");
$efnafraedi->getTitle();
$efnafraedi->setPrice(3500);
echo " New price: ";
$efnafraedi->getPrice();
echo "------------- ";
echo " Stærðfræði: ";
echo " Title: ";
$staerdfraedi->getTitle();
echo " Price: ";
$staerdfraedi->getPrice();
echo " New title: ";
$staerdfraedi->setTitle("Stærðfræði 102 ");
$staerdfraedi->getTitle();
$staerdfraedi->setPrice(1999);
echo " New price: ";
$staerdfraedi->getPrice();
echo '**********';
echo " Íslenska: ";
echo " Title: ";
$islenska->getTitle();
echo " Price: ";
$islenska->getPrice();
echo " New title: ";
$islenska->setTitle("Ljóðamál ");
$islenska->getTitle();
$islenska->setPrice(900);
echo " New price: ";
$islenska->getPrice();
echo '-------------------------------------------------------------------';
echo 'Extended class: ';
$extendedclass->setPublisher(" Mál og Menning ");
$extendedclass->display_bookinformation();
$extendedclass->getPublisher();

?>