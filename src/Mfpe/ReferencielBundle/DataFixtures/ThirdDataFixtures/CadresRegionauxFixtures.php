<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

//Entity
use Mfpe\UniteRegionaleBundle\Entity\CadresRegionaux;

class CadresRegionauxFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        //Ariana
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ahmed");
        $cadresRegionaux->setNomAr(" أحمد ");
        $cadresRegionaux->setPrenomFr("Ben Ahmed");
        $cadresRegionaux->setPrenomAr("بن أحمد ");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("ahmed@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mohamed");
        $cadresRegionaux->setNomAr(" محمد");
        $cadresRegionaux->setPrenomFr("Ben Mohamed");
        $cadresRegionaux->setPrenomAr("بن محمد ");
        $cadresRegionaux->setContact("+216 58978451");
        $cadresRegionaux->setAdresse("Mohamed@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Beja
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Beja"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ali");
        $cadresRegionaux->setNomAr(" علي  ");
        $cadresRegionaux->setPrenomFr("Ben Ahmed");
        $cadresRegionaux->setPrenomAr("بن أحمد ");
        $cadresRegionaux->setContact("+216 97484751");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Beja"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("علي ");
        $cadresRegionaux->setNomAr(" علي ");
        $cadresRegionaux->setPrenomFr("Ben Ali");
        $cadresRegionaux->setPrenomAr("بن علي ");
        $cadresRegionaux->setContact("+216 56698741");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Ben Arous
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Seif");
        $cadresRegionaux->setNomAr(" سيف  ");
        $cadresRegionaux->setPrenomFr("Ben Ahmed");
        $cadresRegionaux->setPrenomAr("بن أحمد ");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("seif@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mohamed");
        $cadresRegionaux->setNomAr(" محمد  ");
        $cadresRegionaux->setPrenomFr("Ben ALi");
        $cadresRegionaux->setPrenomAr("بن علي  ");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Mohamed@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();



        //Bizerte
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Seif");
        $cadresRegionaux->setNomAr(" سيف  ");
        $cadresRegionaux->setPrenomFr("Sakka");
        $cadresRegionaux->setPrenomAr("سقا");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("seif@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ali");
        $cadresRegionaux->setNomAr(" علي  ");
        $cadresRegionaux->setPrenomFr("Sakka");
        $cadresRegionaux->setPrenomAr("سقا");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Gabès
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khaled");
        $cadresRegionaux->setNomAr("خالد   ");
        $cadresRegionaux->setPrenomFr("Sakka");
        $cadresRegionaux->setPrenomAr("سقا");
        $cadresRegionaux->setContact("+216 9861141");
        $cadresRegionaux->setAdresse("Khaled@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ali");
        $cadresRegionaux->setNomAr(" علي  ");
        $cadresRegionaux->setPrenomFr("Sakka");
        $cadresRegionaux->setPrenomAr("سقا");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Gafsa
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Aymen");
        $cadresRegionaux->setNomAr(" أيمن   ");
        $cadresRegionaux->setPrenomFr("Ben Mohamed");
        $cadresRegionaux->setPrenomAr("بن محمد ");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("Aymen@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ali");
        $cadresRegionaux->setNomAr(" علي  ");
        $cadresRegionaux->setPrenomFr("Sakka");
        $cadresRegionaux->setPrenomAr("سقا");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Jendouba
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Aymen");
        $cadresRegionaux->setNomAr(" أيمن   ");
        $cadresRegionaux->setPrenomFr("Touzeni");
        $cadresRegionaux->setPrenomAr("توزاني");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("Aymen@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ali");
        $cadresRegionaux->setNomAr(" علي  ");
        $cadresRegionaux->setPrenomFr("Sakka");
        $cadresRegionaux->setPrenomAr("سقا");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Kairouan
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Aymen");
        $cadresRegionaux->setNomAr(" أيمن   ");
        $cadresRegionaux->setPrenomFr("Touzeni");
        $cadresRegionaux->setPrenomAr("توزاني");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("Aymen@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ali");
        $cadresRegionaux->setNomAr(" علي  ");
        $cadresRegionaux->setPrenomFr("Ben Moulehom");
        $cadresRegionaux->setPrenomAr("بن مولاهم");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Kasserine
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Zied");
        $cadresRegionaux->setNomAr("زياد    ");
        $cadresRegionaux->setPrenomFr("Ben Fradj");
        $cadresRegionaux->setPrenomAr("بن فرج ");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("Zied@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Ali");
        $cadresRegionaux->setNomAr(" علي  ");
        $cadresRegionaux->setPrenomFr("Ben Zied");
        $cadresRegionaux->setPrenomAr("بن زياد");
        $cadresRegionaux->setContact("+216 58628741");
        $cadresRegionaux->setAdresse("Ali@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Kébili
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Zied");
        $cadresRegionaux->setNomAr("زياد    ");
        $cadresRegionaux->setPrenomFr("Brahem  ");
        $cadresRegionaux->setPrenomAr(" براهم    ");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("Zied@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Omar");
        $cadresRegionaux->setNomAr(" عمر   ");
        $cadresRegionaux->setPrenomFr("Zied");
        $cadresRegionaux->setPrenomAr(" زياد");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Omar@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //El Kef
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Zied");
        $cadresRegionaux->setNomAr("زياد    ");
        $cadresRegionaux->setPrenomFr("Alwalid");
        $cadresRegionaux->setPrenomAr("الوليد ");
        $cadresRegionaux->setContact("+216 5861141");
        $cadresRegionaux->setAdresse("Zied@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Omar");
        $cadresRegionaux->setNomAr(" عمر   ");
        $cadresRegionaux->setPrenomFr("Ben Zied");
        $cadresRegionaux->setPrenomAr("بن زياد");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Omar@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();



        //Mahdia
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Kamel");
        $cadresRegionaux->setNomAr(" كمال");
        $cadresRegionaux->setPrenomFr("Brahem");
        $cadresRegionaux->setPrenomAr(" براهم  ");
        $cadresRegionaux->setContact("+216 5868971");
        $cadresRegionaux->setAdresse("Zied@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Omar");
        $cadresRegionaux->setNomAr(" عمر   ");
        $cadresRegionaux->setPrenomFr("Ben Zied");
        $cadresRegionaux->setPrenomAr("بن زياد");
        $cadresRegionaux->setContact("+216 58698741");
        $cadresRegionaux->setAdresse("Omar@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //La Manouba
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khaled");
        $cadresRegionaux->setNomAr(" خالد ");
        $cadresRegionaux->setPrenomFr("Brahem");
        $cadresRegionaux->setPrenomAr(" براهم  ");
        $cadresRegionaux->setContact("+216 2468971");
        $cadresRegionaux->setAdresse("Khaled@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khaled");
        $cadresRegionaux->setNomAr(" خالد ");
        $cadresRegionaux->setPrenomFr("Brahem");
        $cadresRegionaux->setPrenomAr(" براهم  ");
        $cadresRegionaux->setContact("+216 2468971");
        $cadresRegionaux->setAdresse("Khaled@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Médnine
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khaled");
        $cadresRegionaux->setNomAr(" خالد ");
        $cadresRegionaux->setPrenomFr("Ben Hassen ");
        $cadresRegionaux->setPrenomAr(" بن حسن   ");
        $cadresRegionaux->setContact("+216 2468971");
        $cadresRegionaux->setAdresse("Khaled@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Hassine");
        $cadresRegionaux->setNomAr("حسين   ");
        $cadresRegionaux->setPrenomFr("Ben Khaled");
        $cadresRegionaux->setPrenomAr("بن خالد ");
        $cadresRegionaux->setContact("+216 27897741");
        $cadresRegionaux->setAdresse("Hassine@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();
        //Monastir
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Fahed");
        $cadresRegionaux->setNomAr(" فهد  ");
        $cadresRegionaux->setPrenomFr("Ben Mohamed");
        $cadresRegionaux->setPrenomAr(" بن محمد ");
        $cadresRegionaux->setContact("+216 2468147");
        $cadresRegionaux->setAdresse("Fahed@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mohamed");
        $cadresRegionaux->setNomAr("محمد ");
        $cadresRegionaux->setPrenomFr("Ben Khaled");
        $cadresRegionaux->setPrenomAr("بن خالد ");
        $cadresRegionaux->setContact("+216 27897741");
        $cadresRegionaux->setAdresse("Mohamed@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Nabeul
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Sami");
        $cadresRegionaux->setNomAr("سامي  ");
        $cadresRegionaux->setPrenomFr("Ben Mohamed");
        $cadresRegionaux->setPrenomAr(" بن محمد ");
        $cadresRegionaux->setContact("+216 24168147");
        $cadresRegionaux->setAdresse("Sami@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Chaker");
        $cadresRegionaux->setNomAr("شاكر ");
        $cadresRegionaux->setPrenomFr("Ben Mohamed");
        $cadresRegionaux->setPrenomAr("بن محمد  ");
        $cadresRegionaux->setContact("+216 98797741");
        $cadresRegionaux->setAdresse("Chaker@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Sfax
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mongi");
        $cadresRegionaux->setNomAr("منجي");
        $cadresRegionaux->setPrenomFr("Ben Salah");
        $cadresRegionaux->setPrenomAr(" بن صالح ");
        $cadresRegionaux->setContact("+216 24868147");
        $cadresRegionaux->setAdresse("Mongi@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Salah");
        $cadresRegionaux->setNomAr(" صالح ");
        $cadresRegionaux->setPrenomFr("Ben Mohamed");
        $cadresRegionaux->setPrenomAr("بن محمد  ");
        $cadresRegionaux->setContact("+216 98797741");
        $cadresRegionaux->setAdresse("Salah@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Sidi Bouzid
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mahdi");
        $cadresRegionaux->setNomAr(" مهدي ");
        $cadresRegionaux->setPrenomFr("Ben Salem");
        $cadresRegionaux->setPrenomAr("بن سالم");
        $cadresRegionaux->setContact("+216 24868147");
        $cadresRegionaux->setAdresse("Mahdi@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Adnen");
        $cadresRegionaux->setNomAr(" عدنان  ");
        $cadresRegionaux->setPrenomFr("Ben Salah");
        $cadresRegionaux->setPrenomAr("بن صالح  ");
        $cadresRegionaux->setContact("+216 98797741");
        $cadresRegionaux->setAdresse("Adnen@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        //Siliana
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mahdi");
        $cadresRegionaux->setNomAr(" مهدي ");
        $cadresRegionaux->setPrenomFr("Ben Khaled");
        $cadresRegionaux->setPrenomAr("بن خالد ");
        $cadresRegionaux->setContact("+216 28868147");
        $cadresRegionaux->setAdresse("Mahdi@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Adnen");
        $cadresRegionaux->setNomAr(" عدنان  ");
        $cadresRegionaux->setPrenomFr("Khaled");
        $cadresRegionaux->setPrenomAr("خالد ");
        $cadresRegionaux->setContact("+216 91297741");
        $cadresRegionaux->setAdresse("Adnen@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Sousse
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mahdi");
        $cadresRegionaux->setNomAr(" مهدي ");
        $cadresRegionaux->setPrenomFr("Ben Taieb");
        $cadresRegionaux->setPrenomAr("بن الطيب ");
        $cadresRegionaux->setContact("+216 28868147");
        $cadresRegionaux->setAdresse("Mahdi@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Houssem");
        $cadresRegionaux->setNomAr(" حسام   ");
        $cadresRegionaux->setPrenomFr("Khaled");
        $cadresRegionaux->setPrenomAr("خالد ");
        $cadresRegionaux->setContact("+216 91297741");
        $cadresRegionaux->setAdresse("Houssem@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Tataouine
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khaled");
        $cadresRegionaux->setNomAr(" خالد  ");
        $cadresRegionaux->setPrenomFr("Ben Taieb");
        $cadresRegionaux->setPrenomAr("بن الطيب ");
        $cadresRegionaux->setContact("+216 28868147");
        $cadresRegionaux->setAdresse("Khaled@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Bassem");
        $cadresRegionaux->setNomAr("باسم ");
        $cadresRegionaux->setPrenomFr("Ben Ahmed");
        $cadresRegionaux->setPrenomAr("بن أحمد ");
        $cadresRegionaux->setContact("+216 91297741");
        $cadresRegionaux->setAdresse("Bassem@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Tozeur
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khaled");
        $cadresRegionaux->setNomAr(" خالد  ");
        $cadresRegionaux->setPrenomFr("Alabed");
        $cadresRegionaux->setPrenomAr("العابد  ");
        $cadresRegionaux->setContact("+216 27768147");
        $cadresRegionaux->setAdresse("Khaled@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Bassem");
        $cadresRegionaux->setNomAr("باسم ");
        $cadresRegionaux->setPrenomFr("Fradj");
        $cadresRegionaux->setPrenomAr("فرج ");
        $cadresRegionaux->setContact("+216 91298974");
        $cadresRegionaux->setAdresse("Bassem@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

        //Tunis
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khalil");
        $cadresRegionaux->setNomAr(" خليل   ");
        $cadresRegionaux->setPrenomFr("Alabed");
        $cadresRegionaux->setPrenomAr("العابد  ");
        $cadresRegionaux->setContact("+216 28768147");
        $cadresRegionaux->setAdresse("Khalil@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Khalil");
        $cadresRegionaux->setNomAr("خليل  ");
        $cadresRegionaux->setPrenomFr("Fradj");
        $cadresRegionaux->setPrenomAr("فرج ");
        $cadresRegionaux->setContact("+216 96598974");
        $cadresRegionaux->setAdresse("Khalil@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();



        //Zaghouan
        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "CONSEILLER"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Sami");
        $cadresRegionaux->setNomAr(" سامي    ");
        $cadresRegionaux->setPrenomFr("Alabed");
        $cadresRegionaux->setPrenomAr("العابد  ");
        $cadresRegionaux->setContact("+216 96868147");
        $cadresRegionaux->setAdresse("Sami@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();


        $cadresRegionaux = new CadresRegionaux();
        $fonctionCadre = $manager->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->findOneBy(array("intituleFr" => "maire"));
        $cadresRegionaux->setFonctionCadre($fonctionCadre);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $cadresRegionaux->setIdentiteRegionId($identiteRegion);
        $cadresRegionaux->setNomFr("Mohamed");
        $cadresRegionaux->setNomAr("محمد ");
        $cadresRegionaux->setPrenomFr("Fradj");
        $cadresRegionaux->setPrenomAr("فرج ");
        $cadresRegionaux->setContact("+216 96598974");
        $cadresRegionaux->setAdresse("Mohamed@gmail.com");

        $cadresRegionaux->setEnable(true);
        $manager->persist($cadresRegionaux);
        $manager->flush();

    }





}