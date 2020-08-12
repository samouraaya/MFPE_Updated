<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
//Entity

use Mfpe\DataSocioEconomicBundle\Entity\ProjectInvestment;



class ProjectInvestmentFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985315");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2016");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("29.6");
        $projectInvs->setNumberJobLost("3615");
        $projectInvs->setDate(new \DateTime("18-10-2016"));
        $projectInvs->setType("3");
        $projectInvs->setEnable("true");
        $projectInvs->setCreatedAt(date("08-11-2016"));
        $manager->persist($projectInvs);
        $manager->flush();


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978966");
        $projectInvs->setInvestmentCost("8945.5");
        $projectInvs->setYear("2015");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("36.9");
        $projectInvs->setNumberJobLost("3615");
        $projectInvs->setDate(new \DateTime("28-01-2015"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("28-01-2015"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Kasserine Nord"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("914787");
        $projectInvs->setInvestmentCost("7894.8");
        $projectInvs->setYear("2015");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("34.8");
        $projectInvs->setNumberJobLost("3617");
        $projectInvs->setDate(new \DateTime("01-07-2015"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("01-07-2015"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Renouvellement"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("923564");
        $projectInvs->setInvestmentCost("9478.3");
        $projectInvs->setYear("2019");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("25.3");
        $projectInvs->setNumberJobLost("3620");
        $projectInvs->setDate(new \DateTime("14-10-2019"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new\DateTime("14-10-2019"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("969851");
        $projectInvs->setInvestmentCost("9231.8");
        $projectInvs->setYear("2014");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("27.1");
        $projectInvs->setNumberJobLost("3715");
        $projectInvs->setDate(new \DateTime("13-03-2014"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("13-03-2014"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbeïtla"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("974124");
        $projectInvs->setInvestmentCost("8974.2");
        $projectInvs->setYear("2019");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("30.8");
        $projectInvs->setNumberJobLost("2615");
        $projectInvs->setDate(new \DateTime("30-12-2019"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("30-12-2019"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("965315");
        $projectInvs->setInvestmentCost("7256.9");
        $projectInvs->setYear("2017");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("38.6");
        $projectInvs->setNumberJobLost("2915");
        $projectInvs->setDate(new \DateTime("18-09-2017"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("18-09-2017"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sfax Ville"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978315");
        $projectInvs->setInvestmentCost("9632.1");
        $projectInvs->setYear("2014");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("37.1");
        $projectInvs->setNumberJobLost("3918");
        $projectInvs->setDate(new \DateTime("07-09-2014"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("07-09-2014"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Nefta"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985317");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2016");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("35.6");
        $projectInvs->setNumberJobLost("3114");
        $projectInvs->setDate(new \DateTime("06-06-2016"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("06-06-2016"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);

        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Degache"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Renouvellement"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978315");
        $projectInvs->setInvestmentCost("9632.1");
        $projectInvs->setYear("2018");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("37.1");
        $projectInvs->setNumberJobLost("3918");
        $projectInvs->setDate(new \DateTime("03-03-2018"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("03-03-2018"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbiba"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985317");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2020");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("35.6");
        $projectInvs->setNumberJobLost("3114");
        $projectInvs->setDate(new \DateTime("02-04-2020"));
        $projectInvs->setType("3");
        $projectInvs->setCreatedAt(new \DateTime("02-04-2020"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);

        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985315");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2015");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("29.6");
        $projectInvs->setNumberJobLost("3615");
        $projectInvs->setDate(new \DateTime("10-07-2015"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("10-07-2015"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978966");
        $projectInvs->setInvestmentCost("8945.5");
        $projectInvs->setYear("2020");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("36.9");
        $projectInvs->setNumberJobLost("3615");
        $projectInvs->setDate(new \DateTime("17-01-2020"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("17-01-2020"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Kasserine Nord"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("914787");
        $projectInvs->setInvestmentCost("7894.8");
        $projectInvs->setYear("2018");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("34.8");
        $projectInvs->setNumberJobLost("3617");
        $projectInvs->setDate(new \DateTime("11-10-2018"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("11-10-2018"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Renouvellement"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("923564");
        $projectInvs->setInvestmentCost("9478.3");
        $projectInvs->setYear("2015");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("25.3");
        $projectInvs->setNumberJobLost("3620");
        $projectInvs->setDate(new \DateTime("30-08-2015"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("30-08-2015"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("969851");
        $projectInvs->setInvestmentCost("9231.8");
        $projectInvs->setYear("2014");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("27.1");
        $projectInvs->setNumberJobLost("3715");
        $projectInvs->setDate(new \DateTime("27-06-2014"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("27-06-2014"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbeïtla"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("974124");
        $projectInvs->setInvestmentCost("8974.2");
        $projectInvs->setYear("2014");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("30.8");
        $projectInvs->setNumberJobLost("2615");
        $projectInvs->setDate(new \DateTime("18-03-2014"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("18-03-2014"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("965315");
        $projectInvs->setInvestmentCost("7256.9");
        $projectInvs->setYear("2017");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("38.6");
        $projectInvs->setNumberJobLost("2915");
        $projectInvs->setDate(new \DateTime("19-10-2017"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("19-10-2017"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sfax Ville"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978315");
        $projectInvs->setInvestmentCost("9632.1");
        $projectInvs->setYear("2018");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("37.1");
        $projectInvs->setNumberJobLost("3918");
        $projectInvs->setDate(new \DateTime("22-01-2018"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("22-01-2018"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Nefta"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985317");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2019");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("35.6");
        $projectInvs->setNumberJobLost("3114");
        $projectInvs->setDate(new \DateTime("18-11-2019"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("18-11-2019"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);

        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Degache"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Renouvellement"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978315");
        $projectInvs->setInvestmentCost("9632.1");
        $projectInvs->setYear("2014");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("37.1");
        $projectInvs->setNumberJobLost("3918");
        $projectInvs->setDate(new \DateTime("10-01-2014"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("10-01-2014"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbiba"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985317");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2015");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("35.6");
        $projectInvs->setNumberJobLost("3114");
        $projectInvs->setDate(new \DateTime("12-07-2015"));
        $projectInvs->setType("2");
        $projectInvs->setCreatedAt(new \DateTime("12-07-2015"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);

        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985315");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2019");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("29.6");
        $projectInvs->setNumberJobLost("3615");
        $projectInvs->setDate(new \DateTime("23-03-2019"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("23-03-2019"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978966");
        $projectInvs->setInvestmentCost("8945.5");
        $projectInvs->setYear("2018");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("36.9");
        $projectInvs->setNumberJobLost("3615");
        $projectInvs->setDate(new \DateTime("18-11-2018"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("18-11-2018"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Kasserine Nord"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("914787");
        $projectInvs->setInvestmentCost("7894.8");
        $projectInvs->setYear("2015");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("34.8");
        $projectInvs->setNumberJobLost("3617");
        $projectInvs->setDate(new \DateTime("23-12-2015"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("23-12-2015"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Renouvellement"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("923564");
        $projectInvs->setInvestmentCost("9478.3");
        $projectInvs->setYear("2016");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("25.3");
        $projectInvs->setNumberJobLost("3620");
        $projectInvs->setDate(new \DateTime("22-11-2016"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("22-11-2016"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("969851");
        $projectInvs->setInvestmentCost("9231.8");
        $projectInvs->setYear("2019");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("27.1");
        $projectInvs->setNumberJobLost("3715");
        $projectInvs->setDate(new \DateTime("26-10-2019"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("26-10-2019"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbeïtla"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur électronique"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("974124");
        $projectInvs->setInvestmentCost("8974.2");
        $projectInvs->setYear("2014");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("30.8");
        $projectInvs->setNumberJobLost("2615");
        $projectInvs->setDate(new \DateTime("17-06-2014"));
        $projectInvs->setType("1");
        $projectInvs->setEnable("true");
        $projectInvs->setCreatedAt(new \DateTime("17-06-2014"));
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("965315");
        $projectInvs->setInvestmentCost("7256.9");
        $projectInvs->setYear("2015");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("38.6");
        $projectInvs->setNumberJobLost("2915");
        $projectInvs->setDate(new \DateTime("16-05-2015"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("16-05-2015"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sfax Ville"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Extension"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978315");
        $projectInvs->setInvestmentCost("9632.1");
        $projectInvs->setYear("2014");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("37.1");
        $projectInvs->setNumberJobLost("3918");
        $projectInvs->setDate(new \DateTime("14-08-2014"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("14-08-2014"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Nefta"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Partiellement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985317");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2018");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("35.6");
        $projectInvs->setNumberJobLost("3114");
        $projectInvs->setDate(new \DateTime("18-01-2018"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("18-01-2018"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);

        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Degache"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur textile"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Renouvellement"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Locale"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("978315");
        $projectInvs->setInvestmentCost("9632.1");
        $projectInvs->setYear("2020");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("37.1");
        $projectInvs->setNumberJobLost("3918");
        $projectInvs->setDate(new \DateTime("01-05-2020"));
        $projectInvs->setType("1");
        $projectInvs->setEnable("true");
        $projectInvs->setCreatedAt(new \DateTime("01-05-2020"));
        $manager->persist($projectInvs);



        $projectInvs= new ProjectInvestment();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectInvs->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbiba"));
        $projectInvs->setDelegation($delegation);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->findOneBy(array("intituleFr" => "Secteur du bâtiment"));
        $projectInvs->setSectorEconomic($secteur);
        $object = $manager->getRepository('MfpeReferencielBundle:RefObjetEconomic')->findOneBy(array("intituleFr" => "Création"));
        $projectInvs->setObjectEconomic($object);
        $regime = $manager->getRepository('MfpeReferencielBundle:RefRegime')->findOneBy(array("intituleFr" => "Totalement exportatrice"));
        $projectInvs->setRegime($regime);
        $projectInvs->setJobEstimed("985317");
        $projectInvs->setInvestmentCost("9645.5");
        $projectInvs->setYear("2016");
        $projectInvs->setActiviryCessation("activiry cessation");
        $projectInvs->setDuration("35.6");
        $projectInvs->setNumberJobLost("3114");
        $projectInvs->setDate(new \DateTime("08-11-2016"));
        $projectInvs->setType("1");
        $projectInvs->setCreatedAt(new \DateTime("08-11-2016"));
        $projectInvs->setEnable("true");
        $manager->persist($projectInvs);


        $manager->flush();
    }




}