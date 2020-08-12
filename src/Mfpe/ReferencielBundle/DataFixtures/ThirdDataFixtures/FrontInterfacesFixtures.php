<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
//Entity
use Mfpe\ConfigBundle\Entity\FrontInterface;


class FrontInterfacesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        /*************************************** Parent Menu ***************************************/
        $dataFrontInterfaceParent = array(
            array(
                "parent" => NULL,
                "link" => "/demande/liste/",
                "code" => "demands",
                "url_back_end" => "/api/demande",
                "parametres" => array(),
                "method" => array("GET", "POST", "PUT")
            ),
            array(
                "parent" => NULL,
                "link" => "/archive",
                "code" => "consultDemands",
                "url_back_end" => "/api/demande/archive",
                "parametres" => array('date_debut', 'date_fin'),
                "method" => array("Get")
            ),
            array(
                "parent" => NULL,
                "link" => "",
                "code" => "collectData",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
            array(
                "parent" => NULL,
                "link" => "",
                "code" => "donneesSecteurSocio",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
            array(
                "parent" => NULL,
                "link" => "",
                "code" => "donneesSecteurEmploi",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
            array(
                "parent" => NULL,
                "link" => "",
                "code" => "editique",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
            array(
                "parent" => NULL,
                "link" => "",
                "code" => "accessProfilingManagment",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
            array(
                "parent" => NULL,
                "link" => "/access-profiling/nomenclatures",
                "code" => "nomenclatures",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            )
        );

        foreach ($dataFrontInterfaceParent as $key => $value) {
            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
            if (!is_object($frontInterfaceCodeExist)) {
                $frontInterface = New  FrontInterface();
                $frontInterface->setParent($value["parent"]);
                $frontInterface->setLink($value["link"]);
                $frontInterface->setCode($value["code"]);
                $frontInterface->setUrlBackEnd($value["url_back_end"]);
                $frontInterface->setParametres($value["parametres"]);
                $frontInterface->setMethod($value["method"]);
                $manager->persist($frontInterface);
            }
        }
        $manager->flush();
        /*************************************** Parent SubMenu Collecte et Mappage des données ***************************************/
        $frontInterfaceExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => "collectData"));
        $dataFrontInterfaceChild = array(
            array(
                "link" => "/formulaires/projets/projets_publics",
                "code" => "publicProjects",
                "url_back_end" => "/api/project_data/project",
                "parametres" => array("type=1"),
                "method" => array("POST", "GET", "PUT")
            ),
            array(
                "link" => "/formulaires/projets/projets_coopération_internationale",
                "code" => "internationalProjectsCooperation",
                "url_back_end" => "/api/project_data/project",
                "parametres" => array("type=0"),
                "method" => array("POST", "GET", "PUT")
            ),
            array(
                "link" => "/formulaires/inscrit-secteur-public",
                "code" => "inscrit-secteur-public",
                "url_back_end" => "/api/collect_data/graduate_training",
                "parametres" => array("level=1", "sector_type=1"),
                "method" => array("POST", "GET", "PUT")
            ),
            array(
                "link" => "/formulaires/diplomé-secteur-public",
                "code" => "diplomé-secteur-public",
                "url_back_end" => "/api/collect_data/graduate_training",
                "parametres" => array("level=0", "sector_type=1"),
                "method" => array("POST", "GET", "PUT")
            ),
            array(
                "link" => "/formulaires/inscrit-secteur-privé",
                "code" => "inscrit-secteur-privé",
                "url_back_end" => "/api/collect_data/graduate_training",
                "parametres" => array("level=1", "sector_type=0"),
                "method" => array("POST", "GET", "PUT")
            ),
            array(
                "link" => "/formulaires/diplomé-secteur-privé",
                "code" => "diplomé-secteur-privé",
                "url_back_end" => "/api/collect_data/graduate_training",
                "parametres" => array("level=0", "sector_type=0"),
                "method" => array("POST", "GET", "PUT")
            ),
            array(
                "link" => "/formulaires/centres/nombre-centres-formation-privée",
                "code" => "privateCenterNumber",
                "url_back_end" => "/api/collect_data/private_training_center",
                "parametres" => array(),
                "method" => array("POST", "GET", "PUT")
            ),
        );
        foreach ($dataFrontInterfaceChild as $key => $value) {
            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
            if (!is_object($frontInterfaceCodeExist)) {
                $frontInterface = New  FrontInterface();
                $frontInterface->setParent($frontInterfaceExist);
                $frontInterface->setLink($value["link"]);
                $frontInterface->setCode($value["code"]);
                $frontInterface->setUrlBackEnd($value["url_back_end"]);
                $frontInterface->setParametres($value["parametres"]);
                $frontInterface->setMethod($value["method"]);
                $manager->persist($frontInterface);
            }
        }
        $manager->flush();
        /*************************************** Parent SubMenu (Données socioéconomique) ***************************************/
        $frontInterfaceSocioExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => "donneesSecteurSocio"));
        $dataFrontInterfaceSocioChild = array(
            array(
                "link" => "/formulaires/gestion-des-données/socioéconomiques",
                "code" => "formAdd",
                "url_back_end" => "/api/economic_data",
                "parametres" => array("id"),
                "method" => array("GET", "POST", "PUT")
            ),
            array(
                "link" => "/formulaires/gestion-des-données/socioéconomiques/telecharger",
                "code" => "uploadFile",
                "url_back_end" => "/api/csv/economic_data",
                "parametres" => array(),
                "method" => array("POST")
            ),
        );
        foreach ($dataFrontInterfaceSocioChild as $key => $value) {
            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
            if (!is_object($frontInterfaceCodeExist)) {
                $frontInterface = New  FrontInterface();
                $frontInterface->setParent($frontInterfaceSocioExist);
                $frontInterface->setLink($value["link"]);
                $frontInterface->setCode($value["code"]);
                $frontInterface->setUrlBackEnd($value["url_back_end"]);
                $frontInterface->setParametres($value["parametres"]);
                $frontInterface->setMethod($value["method"]);
                $manager->persist($frontInterface);
            }
        }
        $manager->flush();
        /*************************************** Parent SubMenu (Données du Secteur d'emploi) ***************************************/
        $frontInterfaceSecteurEmploiExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => "donneesSecteurEmploi"));
        $dataFrontInterfaceSecteurEmploiChild = array(
            array(
                "link" => "/donnees-bts/telecharger",
                "code" => "donneesBts",
                "url_back_end" => "/api/csv/bts_data",
                "parametres" => array(),
                "method" => array("POST")
            ),
            array(
                "link" => "/investissement/api",
                "code" => "projectAPI",
                "url_back_end" => "/api/project_investment",
                "parametres" => array("type=1"),
                "method" => array("POST", "GET")
            ),
            array(
                "link" => "/investissement/apia",
                "code" => "projectAPIA",
                "url_back_end" => "/api/project_investment",
                "parametres" => array("type=2"),
                "method" => array("POST", "GET")
            ),
            array(
                "link" => "/investissement/entreprise-en-difficulté",
                "code" => "numberEntrepDiffic",
                "url_back_end" => "/api/project_investment",
                "parametres" => array("type=3"),
                "method" => array("POST", "GET")
            ),
            array(
                "link" => "/investissement/donnees-aneti",
                "code" => "donneesAneti",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
        );
        foreach ($dataFrontInterfaceSecteurEmploiChild as $key => $value) {
            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
            if (!is_object($frontInterfaceCodeExist)) {
                $frontInterface = New  FrontInterface();
                $frontInterface->setParent($frontInterfaceSecteurEmploiExist);
                $frontInterface->setLink($value["link"]);
                $frontInterface->setCode($value["code"]);
                $frontInterface->setUrlBackEnd($value["url_back_end"]);
                $frontInterface->setParametres($value["parametres"]);
                $frontInterface->setMethod($value["method"]);
                $manager->persist($frontInterface);
            }
        }
        $manager->flush();
        /*************************************** Parent SubMenu (Editique) ***************************************/
        $frontInterfaceEditiqueExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => "editique"));
        $dataFrontInterfaceEditiqueChild = array(
            array(
                "link" => "/editique/tableau-de-bord",
                "code" => "dashboard",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
            array(
                "link" => "/editique/fiche-descriptive",
                "code" => "ficheDescriptive",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
            array(
                "link" => "/editique/bulletin-regional",
                "code" => "regionalNewsletter",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array()
            ),
        );
        foreach ($dataFrontInterfaceEditiqueChild as $key => $value) {
            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
            if (!is_object($frontInterfaceCodeExist)) {
                $frontInterface = New  FrontInterface();
                $frontInterface->setParent($frontInterfaceEditiqueExist);
                $frontInterface->setLink($value["link"]);
                $frontInterface->setCode($value["code"]);
                $frontInterface->setUrlBackEnd($value["url_back_end"]);
                $frontInterface->setParametres($value["parametres"]);
                $frontInterface->setMethod($value["method"]);
                $manager->persist($frontInterface);
            }
        }
        $manager->flush();
        /*************************************** Parent SubMenu (tableau de bord) ***************************************/
//        $frontInterfaceDashboardExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => "dashboard"));
//        $dataFrontInterfaceDashboardChild = array(
//            array(
//                "link" => "/editique/tableau-de-bord/standard",
//                "code" => "dashboard-standard",
//                "url_back_end" => "",
//                "parametres" => array(),
//                "method" => array()
//            ),
//            array(
//                "link" => "/editique/tableau-de-bord/personalisé",
//                "code" => "dashboard-personalisé",
//                "url_back_end" => "",
//                "parametres" => array(),
//                "method" => array()
//            ),
//        );
//        foreach ($dataFrontInterfaceDashboardChild as $key => $value) {
//            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
//            if (!is_object($frontInterfaceCodeExist)) {
//                $frontInterface = New  FrontInterface();
//                $frontInterface->setParent($frontInterfaceDashboardExist);
//                $frontInterface->setLink($value["link"]);
//                $frontInterface->setCode($value["code"]);
//                $frontInterface->setUrlBackEnd($value["url_back_end"]);
//                $frontInterface->setParametres($value["parametres"]);
//                $frontInterface->setMethod($value["method"]);
//                $manager->persist($frontInterface);
//            }
//        }
//        $manager->flush();
        /*************************************** Parent SubMenu (gestion-access-profiling) ***************************************/
        $frontInterfaceProfilingExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => "accessProfilingManagment"));
        $dataFrontInterfaceProfilingChild = array(
            array(
                "link" => "/access-profiling/settings",
                "code" => "settings",
                "url_back_end" => "",
                "parametres" => array(),
                "method" => array("GET")
            ),
            array(
                "link" => "/gestion-accees/agents",
                "code" => "agentsManagement",
                "url_back_end" => "/api/users/all-agents",
                "parametres" => array(),
                "method" => array("GET")
            ),
            array(
                "link" => "/gestion-roles",
                "code" => "rolesManagement",
                "url_back_end" => "/api/user/roles",
                "parametres" => array(),
                "method" => array()
            )
        );
        foreach ($dataFrontInterfaceProfilingChild as $key => $value) {
            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
            if (!is_object($frontInterfaceCodeExist)) {
                $frontInterface = New  FrontInterface();
                $frontInterface->setParent($frontInterfaceProfilingExist);
                $frontInterface->setLink($value["link"]);
                $frontInterface->setCode($value["code"]);
                $frontInterface->setUrlBackEnd($value["url_back_end"]);
                $frontInterface->setParametres($value["parametres"]);
                $frontInterface->setMethod($value["method"]);
                $manager->persist($frontInterface);
            }
        }
        $manager->flush();

        /*************************************** Parent SubMenu (gestion-access-profiling) ***************************************/
        $frontInterfaceNomenclatureExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => "nomenclatures"));
        $dataFrontInterfaceNomenclatureChild = array(

            array(
                "link" => "/centre-de-formation/liste",
                "code" => "trainingCenterList",
                "url_back_end" => "/api/centreFormation",
                "parametres" => array(),
                "method" => array("POST", "GET", "GET")
            ),
            array(
                "link" => "/specialites/liste",
                "code" => "specialities",
                "url_back_end" => "/api/specialite",
                "parametres" => array(),
                "method" => array("POST", "GET", "GET")
            ),
            array(
                "link" => "/referenciel/liste",
                "code" => "referencesList",
                "url_back_end" => "/api/referenciel/new",
                "parametres" => array(),
                "method" => array("POST")
            ),
            array(
                "link" => "/direction-regionale/liste",
                "code" => "ruList",
                "url_back_end" => "/api/uniteRegionale",
                "parametres" => array(),
                "method" => array("POST", "GET", "GET")
            ),
        );
        foreach ($dataFrontInterfaceNomenclatureChild as $key => $value) {
            $frontInterfaceCodeExist = $manager->getRepository('MfpeConfigBundle:FrontInterface')->findOneBy(array("code" => $value["code"]));
            if (!is_object($frontInterfaceCodeExist)) {
                $frontInterface = New  FrontInterface();
                $frontInterface->setParent($frontInterfaceNomenclatureExist);
                $frontInterface->setLink($value["link"]);
                $frontInterface->setCode($value["code"]);
                $frontInterface->setUrlBackEnd($value["url_back_end"]);
                $frontInterface->setParametres($value["parametres"]);
                $frontInterface->setMethod($value["method"]);
                $manager->persist($frontInterface);
            }
        }
        $manager->flush();

    }
}