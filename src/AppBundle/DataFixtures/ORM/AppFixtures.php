<?PHP
namespace AppBundle\DataFixtures;

use AppBundle\Entity\FormTemplate;
use AppBundle\Entity\Question;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
{
$f1 = new FormTemplate();
$f1->setName("post venta");
$f2 = new FormTemplate;
$f2->setName("calidad de servicios");
$manager->persist($f1);
$manager->persist($f2);
for($i=0;$i<10;$i++)
{

$q1 = new Question();
$q1->setText("esta satisfecho".$i);
if($i%2==0)
{
$q1->setForm($f1);
}
else
{
$q1->setForm($f2);
}
$manager->persist($q1);
}
$manager->flush();


}
}
