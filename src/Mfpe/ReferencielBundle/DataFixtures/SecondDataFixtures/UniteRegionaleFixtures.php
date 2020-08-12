<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

//Entity
use Mfpe\UniteRegionaleBundle\Entity\UniteRegionale;


class UniteRegionaleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert Data UniteRegionale ******************************/
        //UniteRegionale1
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT1");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بتونس");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Tunis");
        $uniteRegionale->setPremierResponsable("Mohamed Ben Hdiden");
        $uniteRegionale->setTel("+216 21 333 333");
        $uniteRegionale->setFax("+216 21 333 333");
        $uniteRegionale->setEmail("unite1@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale2
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT2");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بالقصرين");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Kasserine");
        $uniteRegionale->setPremierResponsable("Aymen Bettaibi");
        $uniteRegionale->setTel("+216 21 111 222");
        $uniteRegionale->setFax("+216 21 111 222");
        $uniteRegionale->setEmail("unite2@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale3
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT3");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بصفاقس ");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Sfax");
        $uniteRegionale->setPremierResponsable("Mohamed Sfaxi");
        $uniteRegionale->setTel("+216 21 555 555");
        $uniteRegionale->setFax("+216 21 555 555");
        $uniteRegionale->setEmail("unite3@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale4
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT4");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بتوزر");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Tozeur");
        $uniteRegionale->setPremierResponsable("Mohamed Tozri");
        $uniteRegionale->setTel("+216 21 123 456");
        $uniteRegionale->setFax("+216 21 123 456");
        $uniteRegionale->setEmail("unite4@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);



        //UniteRegionale5
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT5");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بأريانة");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Ariana");
        $uniteRegionale->setPremierResponsable("Mohamed Ben Mohamed");
        $uniteRegionale->setTel("+216 21 247 369");
        $uniteRegionale->setFax("+216 21 247 369");
        $uniteRegionale->setEmail("unite5@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale6
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT6");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بباجة");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Béja");
        $uniteRegionale->setPremierResponsable("Mohamed Ben Ali");
        $uniteRegionale->setTel("+216 25 247 124");
        $uniteRegionale->setFax("+216 25 247 124");
        $uniteRegionale->setEmail("unite6@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Béja"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale7
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT7");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بالمهدية");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Mahdia");
        $uniteRegionale->setPremierResponsable("Ali Ben Ahmed");
        $uniteRegionale->setTel("+216 22 258 789");
        $uniteRegionale->setFax("+216 22 258 789");
        $uniteRegionale->setEmail("unite7@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale8
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT8");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل ببنزرت");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Bizerte");
        $uniteRegionale->setPremierResponsable("Ahmed Ben Mohamed");
        $uniteRegionale->setTel("+216 23 458 125");
        $uniteRegionale->setFax("+216 23 458 125");
        $uniteRegionale->setEmail("unite8@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale9
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT9");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بسوسة");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Sousse");
        $uniteRegionale->setPremierResponsable("Hassen Ben Ali");
        $uniteRegionale->setTel("+216 24 111 333");
        $uniteRegionale->setFax("+216 24 111 333");
        $uniteRegionale->setEmail("unite9@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale10
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT10");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بنابل");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Nabeul");
        $uniteRegionale->setPremierResponsable("Ahmed Ben Hdiden");
        $uniteRegionale->setTel("+216 26 753 333");
        $uniteRegionale->setFax("+216 26 753 333");
        $uniteRegionale->setEmail("unite10@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale11
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT11");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بالمنستير");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Monastir");
        $uniteRegionale->setPremierResponsable("Sami Lejmi");
        $uniteRegionale->setTel("+216 26 753 333");
        $uniteRegionale->setFax("+216 26 753 333");
        $uniteRegionale->setEmail("unite11@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale12
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT12");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بسيدي بوزيد");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Sidi Bouzid");
        $uniteRegionale->setPremierResponsable("Mohamed Yahia");
        $uniteRegionale->setTel("+216 28 859 666");
        $uniteRegionale->setFax("+216 28 859 666");
        $uniteRegionale->setEmail("unite12@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);


        //UniteRegionale13
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT13");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بقبلي");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Kébili");
        $uniteRegionale->setPremierResponsable("Ali Ben Ali");
        $uniteRegionale->setTel("+216 28 159 753");
        $uniteRegionale->setFax("+216 28 159 753");
        $uniteRegionale->setEmail("unite13@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);


        //UniteRegionale14
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT14");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بالكاف");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de El Kef");
        $uniteRegionale->setPremierResponsable("Khaled Ben Yahia");
        $uniteRegionale->setTel("+216 28 159 753");
        $uniteRegionale->setFax("+216 28 159 753");
        $uniteRegionale->setEmail("unite14@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale15
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT15");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل ببن عروس");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Ben Arous");
        $uniteRegionale->setPremierResponsable("Omar Ben Taieb");
        $uniteRegionale->setTel("+216 27 759 753");
        $uniteRegionale->setFax("+216 27 759 753");
        $uniteRegionale->setEmail("unite15@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);


        //UniteRegionale16
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT16");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بقابس");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Gabès");
        $uniteRegionale->setPremierResponsable("Khalil Ben Mohamed");
        $uniteRegionale->setTel("+216 21 321 753");
        $uniteRegionale->setFax("+216 21 321 753");
        $uniteRegionale->setEmail("unite16@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);


        //UniteRegionale17
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT17");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بقفصة");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Gafsa");
        $uniteRegionale->setPremierResponsable("Ahmed Ben Yahia");
        $uniteRegionale->setTel("+216 28 777 555");
        $uniteRegionale->setFax("+216 28 777 555");
        $uniteRegionale->setEmail("unite17@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);


        //UniteRegionale18
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT18");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بالقيروان");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Kairouan");
        $uniteRegionale->setPremierResponsable("Selim Ben Ahmed");
        $uniteRegionale->setTel("+216 28 159 753");
        $uniteRegionale->setFax("+216 28 159 753");
        $uniteRegionale->setEmail("unite18@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale19
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT19");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بمدنين");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Médnine");
        $uniteRegionale->setPremierResponsable("Sami Ben Yahia");
        $uniteRegionale->setTel("+216 25 155 153");
        $uniteRegionale->setFax("+216 28 155 153");
        $uniteRegionale->setEmail("unite19@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale20
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT20");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بمنوبة");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de La Manouba ");
        $uniteRegionale->setPremierResponsable("Khaled Ben Khaled");
        $uniteRegionale->setTel("+216 21 888 993");
        $uniteRegionale->setFax("+216 21 888 993");
        $uniteRegionale->setEmail("unite20@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale21
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT21");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بسليانة");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Siliana");
        $uniteRegionale->setPremierResponsable("Mohamed Ben Walid");
        $uniteRegionale->setTel("+216 28 444 744");
        $uniteRegionale->setFax("+216 28 444 744");
        $uniteRegionale->setEmail("unite21@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale22
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT22");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بزغوان");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Zaghouan");
        $uniteRegionale->setPremierResponsable("Selim Ben Slimen");
        $uniteRegionale->setTel("+216 24 159 722");
        $uniteRegionale->setFax("+216 24 159 722");
        $uniteRegionale->setEmail("unite22@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale23
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT23");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بتطاوين");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Tataouine");
        $uniteRegionale->setPremierResponsable("Mohamed Ben Walid");
        $uniteRegionale->setTel("+216 26 169 653");
        $uniteRegionale->setFax("+216 26 169 653");
        $uniteRegionale->setEmail("unite23@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);

        //UniteRegionale24
        $uniteRegionale = New UniteRegionale();
        $uniteRegionale->setCodeUnite("UNIT24");
        $uniteRegionale->setTitreAr("الإدارة الجهويه للتكوين المهني والتشغيل بجندوبة");
        $uniteRegionale->setTitreFr("Direction régionale de la formation professionnelle et de l'emploi de Jendouba");
        $uniteRegionale->setPremierResponsable("Walid Ben Mohamed");
        $uniteRegionale->setTel("+216 27 129 713");
        $uniteRegionale->setFax("+216 27 129 713");
        $uniteRegionale->setEmail("unite24@gmail.com");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $uniteRegionale->setGouvernorat($gouvernorat);
        $uniteRegionale->setEnable(true);
        $manager->persist($uniteRegionale);


        $manager->flush();

    }

}