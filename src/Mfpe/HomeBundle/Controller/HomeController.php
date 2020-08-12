<?php

namespace Mfpe\HomeBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\DataSocioEconomicBundle\Entity\SocioEconomicData;
use Mfpe\DataSocioEconomicBundle\Entity\UniteRegionale;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\DataSocioEconomicBundle\Validator\ValidateSocioEconomicData;
use Mfpe\ReferencielBundle\Entity\RefGouvernorat;
use Mfpe\ReferencielBundle\Services\ReferencielService;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;
use Mfpe\EditiqueBundle\Controller\EdiqueController;

class HomeController extends BaseController
{
    use ControllerTrait;


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/number-project-Data",
     *     name="app_project-data_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="code_gouvernorat",
     *     nullable=true,
     *     description="Code Gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="type",
     *     nullable=true,
     *     description="Type project data"
     * )
     * @SWG\Get(
     *  tags={"Home"},
     *  summary="returns the number of projects according to the type of project and governorate",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectData::class, groups={"publicProject"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getAllNumberProjectAction(Request $request)
    {

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $data = json_decode(json_encode($request->query->all()), true);
        if (isset($data["code_gouvernorat"]) && !empty($data["code_gouvernorat"]) && isset($data["type"]) && !empty($data["type"])) {
            $numberProjectData = $this->getDataProjectByGouvernorat($data["code_gouvernorat"], $data["type"]);

        } else {
            $numberProjectData = (count($this->em()->getRepository('MfpeCollectDataBundle:ProjectData')->findAll()));
        }

        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $numberProjectData], Response::HTTP_OK);
    }

    //function to render number public project and number cooperation project
    private function getDataProjectByGouvernorat($data, $type)
    {

        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->findBy(array("code" => $data));
        $numberProjectData = $this->em()->getRepository('MfpeCollectDataBundle:ProjectData')->findNumberProject($gouvernorat, $type);
        $numberProjectData = $this->get('jms_serializer')->serialize($numberProjectData, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $numberProjectData = json_decode($numberProjectData, JSON_UNESCAPED_UNICODE);
        return $numberProjectData;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/economic-data",
     *     name="app_csv-socio-economic_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="code_gouvernorat",
     *     nullable=true,
     *     description="Code Gouvernorat to search for."
     * )
     * @SWG\Get(
     *  tags={"Home"},
     *  summary="Get data socio economics filtered by code governorate",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvSocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getAllAction(Request $request)
    {

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $data = json_decode(json_encode($request->query->all()), true);
        if (isset($data["code_gouvernorat"]) && !empty($data["code_gouvernorat"])) {
            $csvSocioEconomicData = $this->getDataSocioEconomicByGouvernorat($data);
        } else {
            $csvSocioEconomicData = $this->em()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->findAll();
            // $csvSocioEconomicData = $this->getAllGouvernorat($data);
        }
        $csvSocioEconomicData = $this->get('jms_serializer')->serialize($csvSocioEconomicData, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $csvSocioEconomicData = json_decode($csvSocioEconomicData, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $csvSocioEconomicData], Response::HTTP_OK);
    }

//function to render all fields table CsvSocioEconomicData by code gouvernorat
    private function getDataSocioEconomicByGouvernorat($data, $year)
    {

        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->findBy(array("code" => $data));
        $csvSocioEconomicData = $this->em()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->getCsvSocioEconomicData($data, $year);
        //dataSocioEconomic from data form
        $dataSocioEconomic = $this->getInstitutionEducative($data, $year);
        $resultSocio = [];
        if (isset($csvSocioEconomicData) && !empty($csvSocioEconomicData) && isset($dataSocioEconomic) && !empty($dataSocioEconomic)) {
            $resultSocio = array_merge($dataSocioEconomic[0], $csvSocioEconomicData[0]);
        } else if (isset($csvSocioEconomicData) && !empty($csvSocioEconomicData) && isset($dataSocioEconomic) && empty($dataSocioEconomic)) {
            $resultSocio = $csvSocioEconomicData[0];
        } else if (isset($csvSocioEconomicData) && empty($csvSocioEconomicData) && isset($dataSocioEconomic) && !empty($dataSocioEconomic)) {
            $resultSocio = $dataSocioEconomic[0];
        }
        $csvSocioEconomicData = $this->get('jms_serializer')->serialize($resultSocio, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $csvSocioEconomicData = json_decode($csvSocioEconomicData, JSON_UNESCAPED_UNICODE);
        return $csvSocioEconomicData;
    }

    private function getInstitutionEducative($data, $year)
    {
        $socioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->getInstitutionSanteRoue($data, $year);
        $socioEconomicData = $this->get('jms_serializer')->serialize($socioEconomicData, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData', '')));
        $socioEconomicData = json_decode($socioEconomicData, JSON_UNESCAPED_UNICODE);
        return $socioEconomicData;
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/detail-region",
     *     name="app_detail-region_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="code_gouvernorat",
     *     nullable=true,
     *     description="Code Gouvernorat to search for."
     * )
     * @SWG\Get(
     *  tags={"Home"},
     *  summary="Get detail region filtered by code governorate",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvSocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getDetailRegionAction(Request $request)
    {
        $data = json_decode(json_encode($request->query->all()), true);
        if (isset($data["code_gouvernorat"]) && !empty($data["code_gouvernorat"])) {
            $dataRegion = $this->getDataRegionByGouvernorat($data);
        }
        $dataRegion = $this->get('jms_serializer')->serialize($dataRegion, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $response = json_decode($dataRegion, JSON_UNESCAPED_UNICODE);
        return $response;
    }


    //function to render all fields Region by code gouvernorat
    private function getDataRegionByGouvernorat($data)
    {
        $nbDelegation = count($this->getNumbreDelegationGouvernorat($data));
        //  $nbMunicipalite = $this->getNumbreMunicipaliteGouvernorat($data);
        $dataRegion = ['nbDelegation' => $nbDelegation];
        return $dataRegion;
    }

    //function to render Total Registred  in training by code gouvernorat
    private function getTotalRegistredByGouvernorat($data)
    {

        $nbRegistredPublic = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbRegistredPublic($data);
        $nbRegistredPrivate = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbRegistredPrivate($data);
        $nbDiplomedPrivate = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbDiplomedPrivate($data);
        $nbDiplomedPublic = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbDiplomedPublic($data);

        if (is_null($nbRegistredPublic['nbRegistredPublic'])) {
            $nbRegistredPublic['nbRegistredPublic'] = 0;
        }
        if (is_null($nbRegistredPrivate['nbRegistredPrivate'])) {
            $nbRegistredPrivate['nbRegistredPrivate'] = 0;
        }
        if (is_null($nbDiplomedPrivate['nbDiplomedPrivate'])) {
            $nbDiplomedPrivate['nbDiplomedPrivate'] = 0;
        }
        if (is_null($nbDiplomedPublic['nbDiplomedPublic'])) {
            $nbDiplomedPublic['nbDiplomedPublic'] = 0;
        }
        $nbformed = array_merge($nbRegistredPublic, $nbRegistredPrivate, $nbDiplomedPrivate, $nbDiplomedPublic);

        return $nbformed;
    }

    //function to render Total Registred  in training by code gouvernorat and niveau etude
    private function getTotalRegistredByGouvernoratAndNiveauEtude($data, $niveau)
    {

        $nbRegistredPublic = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbRegistredPublicNiveauEtude($data, $niveau);
        $nbRegistredPrivate = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbRegistredPrivateNiveauEtude($data, $niveau);
        $nbDiplomedPrivate = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbDiplomedPrivateNiveauEtude($data, $niveau);
        $nbDiplomedPublic = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbDiplomedPublicNiveauEtude($data, $niveau);

        if (is_null($nbRegistredPublic['nbRegistredPublic'])) {
            $nbRegistredPublic['nbRegistredPublic'] = 0;
        }
        if (is_null($nbRegistredPrivate['nbRegistredPrivate'])) {
            $nbRegistredPrivate['nbRegistredPrivate'] = 0;
        }
        if (is_null($nbDiplomedPrivate['nbDiplomedPrivate'])) {
            $nbDiplomedPrivate['nbDiplomedPrivate'] = 0;
        }
        if (is_null($nbDiplomedPublic['nbDiplomedPublic'])) {
            $nbDiplomedPublic['nbDiplomedPublic'] = 0;
        }
        $nbformed = array_merge($nbRegistredPublic, $nbRegistredPrivate, $nbDiplomedPrivate, $nbDiplomedPublic);

        return $nbformed;
    }

    //function to render stat  in training by code gouvernorat and training center
    private function getStatFormationByGouvernorat($data)
    {
        $stat = [];
        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->findBy(array("code" => $data["gouvernorat"]));
        //return all center of one governorate
        $centreFormation = $this->em()->getRepository('MfpeCentreFormationBundle:CentreFormation')->findBy(array("gouvernorat" => $gouvernorat));
        //return stat of public formation filtred by gouvernorate
        $statPublic = $this->em()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getStatFormationPublic($data, "true");
        foreach ($centreFormation as $key => $centre) {
            $totalLevel1 = 0;
            $totalLevel2 = 0;
            $totalDiplomed = 0;
            foreach ($statPublic as $statc) {
                if ($centre->getId() == $statc['IdCenter']) {
                    if ($statc['level'] == 1) {
                        $totalLevel1 += $statc['nbEleve'];
                    } elseif ($statc['level'] == 2) {
                        $totalLevel2 += $statc['nbEleve'];
                    } elseif ($statc['level'] == 0) {
                        $totalDiplomed += $statc['nbEleve'];
                    }
                    $stat["public"][$key] = ['idCenter' => $statc['IdCenter'], 'intituleFrCenter' => $statc['centreFr'], 'intituleArCenter' => $statc['centreAr'], 'intituleArSpecialite' => $statc['specialitAr']
                        , 'intituleFrSpecialite' => $statc['specialitFr'], 'niveauDiplome' => $statc['level'], 'totalLevel1' => $totalLevel1, 'totalLevel2' => $totalLevel2, 'totalDiplomed' => $totalDiplomed];
                }

            }

        }
        //return stat of private formation filtred by gouvernorate
        $statPrivate = $this->em()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getStatFormationPrivate($data, "false");
        foreach ($centreFormation as $key => $centre) {
            $totalLevel1 = 0;
            $totalLevel2 = 0;
            $totalDiplomed = 0;
            foreach ($statPrivate as $statc) {
                if ($centre->getId() == $statc['IdCenter']) {
                    if ($statc['level'] == 1) {
                        $totalLevel1 += $statc['nbEleve'];
                    } elseif ($statc['level'] == 2) {
                        $totalLevel2 += $statc['nbEleve'];
                    } elseif ($statc['level'] == 0) {
                        $totalDiplomed += $statc['nbEleve'];
                    }
                    $stat["private"]["statPrivateCenter"][$key] = ['idCenter' => $statc['IdCenter'], 'intituleFrCenter' => $statc['centreFr'], 'intituleArCenter' => $statc['centreAr'], 'intituleArSpecialite' => $statc['specialitAr']
                        , 'intituleFrSpecialite' => $statc['specialitFr'], 'niveauDiplome' => $statc['level'], 'totalLevel1' => $totalLevel1, 'totalLevel2' => $totalLevel2, 'totalDiplomed' => $totalDiplomed];
                }
            }
        }
        $statNbPrivateTrainingCenter = $this->em()->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->getPrivateTrainigCenterByFiltre($data);
        $stat["private"]['nbPrivateTrainingCenter'] = $statNbPrivateTrainingCenter;
        return $stat;
    }


    //function to render  the number delegation by code gouvernorat
    private function getNumbreDelegationGouvernorat($data)
    {
        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("code" => $data));
        $delegation = $this->em()->getRepository('MfpeReferencielBundle:RefDelegation')->findBy(array("parent" => $gouvernorat->getId()));
        return $delegation;
    }

    //function to render the number municipality by delegation
    private function getNumbreMunicipaliteGouvernorat($data)
    {
        $municipality = array();
        $delegation = $this->getNumbreDelegationGouvernorat($data);
        foreach ($delegation as $deleg) {
            $municipalites = $this->em()->getRepository('MfpeReferencielBundle:RefMunicipalite')->findBy(array("parent" => $deleg->getId()));
            array_push($municipality, count($municipalites));
        }
        $nbMunicipality = array_sum($municipality);
        return $nbMunicipality;
    }

//function to render  all governorat
    private function getAllGouvernorat()
    {
        $data = '';
        $categorie = 'RefGouvernorat';
        $response = ReferencielService::getInstance()->getReferencielbycategorie($this->em(), $categorie, $data);
        //dd($response);
        // $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->findBy(array("code" => $data["code_gouvernorat"]));
        // $csvSocioEconomicData = $this->em()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->findBy(array("governoratId" => $gouvernorat));
        $csvSocioEconomicData = $this->get('jms_serializer')->serialize($response, 'json', SerializationContext::create()->setGroups(array('ReferencielGroup')));
        $response = json_decode($csvSocioEconomicData, JSON_UNESCAPED_UNICODE);
        return $response;
    }

    //function to render  all information By governorat
    private function getAllInformationByGouvernorat($data, $year)
    {
//        $numberProjetPublic = $this->getDataProjectByGouvernorat($data, 1);
//        $numberProjetPrive = $this->getDataProjectByGouvernorat($data, 0);
//        $nbProjet = ['nbProjetPublic' => $numberProjetPublic, 'numberProjetPrive' => $numberProjetPrive];
        $region = [];
        $dataSocioEconimic = $this->getDataSocioEconomicByGouvernorat($data, $year);
        $dataGouvernorat = [];
        if (!empty($data)) {
            $dataGouvernorat['gouvernorat'] = $data;
        }
        if (!empty($year)) {
            $dataGouvernorat["annee"] = $year['year'];
        }
        $formation = [];

        //return les stats de formation sc2
        $dataFormationSc2 = $this->getTotalRegistredByGouvernorat($dataGouvernorat);
        //return les stats de formation sc1
        $dataFormationSc1 = $this->getStatFormationByGouvernorat($dataGouvernorat);
        $formation = ['dataFormationSc1' => $dataFormationSc1, 'dataFormationSc2' => $dataFormationSc2];
        //return les stats de l'attestation
        $dataAttestation = $this->getProfessionnalQualification($dataGouvernorat);
        //return nbre delegation
        $nbDelegation = $this->getDataRegionByGouvernorat($dataGouvernorat);
        //return stat dataRegion
        $dataRegion = $this->getIdentityInformationTableData($dataGouvernorat);
        //return stat emploi
        $dataEmploi = $this->getEmploiInformationTableData($dataGouvernorat);

        //return stat Projet
        $dataProjet = $this->getProjetTableData($dataGouvernorat);

        if (isset($nbDelegation) && !empty($nbDelegation) && (isset($dataRegion) && !empty($dataRegion))) {

            $region = array_merge($dataRegion, $nbDelegation);

        } elseif (isset($nbDelegation) && empty($nbDelegation) && (isset($dataRegion) && !empty($dataRegion))) {
            $region = $dataRegion;
        } elseif (isset($nbDelegation) && !empty($nbDelegation) && (isset($dataRegion) && empty($dataRegion))) {
            $region = $nbDelegation;
        }
        $tabRoues = ['dataRegion' => $region, 'dataSocioEconimic' => $dataSocioEconimic, 'dataEmploi' => $dataEmploi, 'dataFormation' => $formation, 'dataProjet' => $dataProjet, 'dataAttestation' => $dataAttestation];
        $csvSocioEconomicData = $this->get('jms_serializer')->serialize($tabRoues, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $response = json_decode($csvSocioEconomicData, JSON_UNESCAPED_UNICODE);
        return $response;
    }


    private function getIdentityInformationTableData($data)
    {
        $identityRegion = $this->getDoctrine()->getManager()->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->getIdentityRegionByGouvernoratAnnee($data);
        if (isset($identityRegion) && !empty($identityRegion)) {
            $identityRegion = $this->get('jms_serializer')->serialize($identityRegion[0], 'json', SerializationContext::create()->setGroups(array('regionGroup', 'descriptionGroup', 'cadreGroup', 'ReferencielGroup')));
            $identityRegion = json_decode($identityRegion, JSON_UNESCAPED_UNICODE);
        }
        return $identityRegion;
    }


    private function getProjetTableData($data)
    {
        $projectData = $this->getDoctrine()->getManager()->getRepository('MfpeCollectDataBundle:ProjectDataCsv')->findProjectDataByFiltre($data);
        return $projectData;
    }

    private function getEmploiInformationTableData($data)
    {
        $tab = [];
        $emploiData = 0;
        $totalOffre = 0;
        $totalDemande = 0;
        $emploiData = $this->getDoctrine()->getManager()->getRepository('MfpeCollectDataBundle:AnetiTable1')->findTotalDataEmploiByFiltre($data);
        $totalOffre = $this->getDoctrine()->getManager()->getRepository('MfpeCollectDataBundle:AnetiTable1')->findTotalOffreEmploiByFiltre($data);
        $totalDemande = $this->getDoctrine()->getManager()->getRepository('MfpeCollectDataBundle:AnetiTable1')->findTotalDemandeEmploiByFiltre($data);
        $tab = array_merge($emploiData, $totalOffre, $totalDemande);
        return $tab;
    }

    //function to calculate the number of professional qaulification
    private function getProfessionnalQualification($data)
    {
        $result = array();
        //Step1 : numbre of candidate
        $candidates = $this->em()->getRepository('MfpeAttestationBundle:Demande')->getAllCandidates($data);
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            //number Men/Women
            if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                $numberMen = $numberMen + 1;
            } else {
                $numberWomen = $numberWomen + 1;
            }
            //Number etranger
            if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                $numberTunisien = $numberTunisien + 1;
            } else {
                $numberEtrangers = $numberEtrangers + 1;
            }
        }
        $result["number_candidat"] = array(
            "number_men" => $numberMen,
            "number_women" => $numberWomen,
            "number_tunisian" => $numberTunisien,
            "number_etrangers" => $numberEtrangers,
            "total" => $numberMen + $numberWomen,
        );

        //Step2 : numbre of candidate qualifiers
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            if ($refStatut->getCode() == "ATTESTATION_OK") {
                //number Men/Women
                if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                    $numberMen = $numberMen + 1;
                } else {
                    $numberWomen = $numberWomen + 1;
                }
                //Number etranger
                if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                    $numberTunisien = $numberTunisien + 1;
                } else {
                    $numberEtrangers = $numberEtrangers + 1;
                }
            }
        }
        $result["number_candidat_qualifier"] = array(
            "number_men" => $numberMen,
            "number_women" => $numberWomen,
            "number_tunisian" => $numberTunisien,
            "number_etrangers" => $numberEtrangers,
            "total" => $numberMen + $numberWomen,
        );

        //Step3 : numbre of candidate not qualifiers
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            if ($refStatut->getCode() == "ATTESTATION_KO") {
                //number Men/Women
                if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                    $numberMen = $numberMen + 1;
                } else {
                    $numberWomen = $numberWomen + 1;
                }
                //Number etranger
                if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                    $numberTunisien = $numberTunisien + 1;
                } else {
                    $numberEtrangers = $numberEtrangers + 1;
                }
            }
        }
        $result["number_candidat_not_qualifier"] = array(
            "number_men" => $numberMen,
            "number_women" => $numberWomen,
            "number_tunisian" => $numberTunisien,
            "number_etrangers" => $numberEtrangers,
            "total" => $numberMen + $numberWomen,
        );

        //Step4 : numbre of specialities
        $specialities = $this->em()->getRepository('MfpeCentreFormationBundle:Specialite')->getSpecialities($data);
        $result["number_specialitie"] = count($specialities);

        //Step5 : numbre of centre formation
        $centreFormations = $this->em()->getRepository('MfpeCentreFormationBundle:CentreFormation')->getCentreFormations($data);
        $result["number_centre_formation"] = count($centreFormations);

        return $result;
    }

    //function to render  all information to all governorat
    private function getAllInformationForAllGouvernorat($year)
    {

        $gouvernorats = $this->getAllGouvernorat();
        $gouvernoratsInformationRoues = [];
        foreach ($gouvernorats as $key => $value) {
            $informationRoues = $this->getAllInformationByGouvernorat($value['code'], $year);
            $gouvernoratsInformationRoues[$value['code']] = $informationRoues;
        }
        return $gouvernoratsInformationRoues;
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/roues",
     *     name="app_roues_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="year",
     *     nullable=true,
     *     description="year to search for."
     * )
     * @SWG\Get(
     *  tags={"Home"},
     *  summary="return all wheel data for all governorates",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectData::class, groups={"publicProject"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getHomeAction(Request $request)
    {
        $year = '';
        $data = json_decode(json_encode($request->query->all()), true);
        if (isset($data['year']) && !empty($data['year'])) {
            $year = $data['year'];
        }
        $dataRoues = $this->getAllInformationForAllGouvernorat($data, $year);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $dataRoues], Response::HTTP_OK);
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailStatGraduateTraining"})
     * @Rest\Get(
     *     path = "/mobile/formation",
     *     name="app_formation_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="annee",
     *     nullable=true,
     *     description="year to search for."
     * )
     * @Rest\QueryParam(
     *     name="gouvernorat",
     *     nullable=true,
     *     description="gouvernorat to search for."
     * )
     * @SWG\Get(
     *  tags={"Home"},
     *  summary="return all data formation for all governorates",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailStatGraduateTraining"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getFormationByNiveauEtudeAction(Request $request)
    {
        $tabNiveau = [];
        $tabFormation = [];
        $tab = [];
        $data = json_decode(json_encode($request->query->all()), true);

        // all niveau etude
        $niveaux = $this->em()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findAllNiveauEtudeStatGraduateTraining();
        foreach ($niveaux as $key => $value) {
                array_push($tabNiveau, $value['idNiveau']);
        }
        $result = array_unique($tabNiveau);

        // data formation by niveau etude
        foreach ($result as $key => $value) {
            //public
            $type = 'TRUE';
            $nbInscritPublic = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbRegistredNiveauEtude($data, $value, $type);
            $nbDiplomedPublic = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getDiplomedNiveauEtude($data, $value, $type);
            //private
            $type = 'FALSE';
            $nbInscritPrive = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getNbRegistredNiveauEtude($data, $value, $type);
            $nbDiplomedPrivate = $this->em()->getRepository('MfpeCollectDataBundle:LevelStudy')->getDiplomedNiveauEtude($data, $value, $type);
            //table public
            $tab['public'] = ['idNiveauDiplome' => $value, 'nbInscritPublic' => $nbInscritPublic['nbRegistred'], 'nbDiplomedPublic' => $nbDiplomedPublic['nbDiplomed']];
            //table prive
            $tab['prive'] = ['idNiveauDiplome' => $value, 'nbInscritPrive' => $nbInscritPrive['nbRegistred'], 'nbDiplomedPrivate' => $nbDiplomedPrivate['nbDiplomed']];
            $tabFormation[$key] = $tab;
        }
        $tabResult = [];
        //organise les donnees par secteur public ou prive
        foreach ($tabFormation as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if ($key1 == 'public') {
                    $tabResult[$key1][$key] = $value1;
                }
                if ($key1 == 'prive') {
                    $tabResult[$key1][$key] = $value1;
                }
                $intArray[$key1][$key] = array_map(
                    function($value2) { return (int)$value2; },
                    $tabResult[$key1][$key]
                );
            }

        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $intArray], Response::HTTP_OK);
    }
}

