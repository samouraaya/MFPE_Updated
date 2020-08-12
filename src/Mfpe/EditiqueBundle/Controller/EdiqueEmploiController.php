<?php

namespace Mfpe\EditiqueBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Mfpe\ConfigBundle\Services\EntityMerger;
use Mfpe\ConfigBundle\Services\PermissionService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use phpDocumentor\Reflection\Types\Object_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Mfpe\ConfigBundle\Representation\UsersApp;
use Mfpe\CollectDataBundle\Entity\StatGraduateTraining;
use Mfpe\CollectDataBundle\Entity\PrivateTrainnigCenter;
use Mfpe\CollectDataBundle\Entity\ProjectData;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;
use Mfpe\DataSocioEconomicBundle\Entity\CsvBTSData;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Mfpe\EditiqueBundle\Validator\ValidateEmploi;

/**
 * Description of EdiqueController
 *
 * @author Wiem Hadiji
 */
class EdiqueEmploiController extends BaseController
{
    use ControllerTrait;

//return tab of total programme emploi
    private function getTotalEmploiProgramme($emploiData)
    {
//SIVP
        $totalSIVPNouveau = 0;
        $totalSIVPNouveauD = 0;
        $totalSIVPNouveauF = 0;
        $totalSIVPInser = 0;
        $totalSIVPInserD = 0;
        $totalSIVPInserF = 0;
        $totalSIVPCour = 0;
        $totalSIVPCourF = 0;
        $totalSIVPCourD = 0;
//CIVP
        $totalCIVPNouv = 0;
        $totalCIVPNouvF = 0;
        $totalCIVPNouvD = 0;
        $totalCIVPInserD = 0;
        $totalCIVPInserF = 0;
        $totalCIVPInser = 0;
        $totalCIVPCour = 0;
        $totalCIVPCourF = 0;
        $totalCIVPCourD = 0;

//SCV
        $totalSCVNouv = 0;
        $totalSCVNouvD = 0;
        $totalSCVNouvF = 0;
        $totalSCVInser = 0;
        $totalSCVInserF = 0;
        $totalSCVInserD = 0;
        $totalSCVCour = 0;
        $totalSCVCourF = 0;
        $totalSCVCourD = 0;

//CAIP  Nouv
        $totalCAIPNouv = 0;
        $totalCAIPNouvD = 0;
        $totalCAIPNouvF = 0;
        $totalCAIPInser = 0;
        $totalCAIPInserD = 0;
        $totalCAIPInserF = 0;
        $totalCAIPCour = 0;
        $totalCAIPCourD = 0;
        $totalCAIPCourF = 0;

//CIDES
        $totalCIDESNouv = 0;
        $totalCIDESNouvD = 0;
        $totalCIDESNouvF = 0;
        $totalCIDESInser = 0;
        $totalCIDESInserD = 0;
        $totalCIDESInserF = 0;
        $totalCIDESCour = 0;
        $totalCIDESCourD = 0;
        $totalCIDESCourF = 0;

//CRVA  Nouv
        $totalCRVANouv = 0;
        $totalCRVANouvD = 0;
        $totalCRVANouvF = 0;
        $totalCRVAInser = 0;
        $totalCRVAInserD = 0;
        $totalCRVAInserF = 0;
        $totalCRVACour = 0;
        $totalCRVACourD = 0;
        $totalCRVACourF = 0;

//Forsat  Nouv
        $totalForsatiNouv = 0;
        $totalForsatiNouvD = 0;
        $totalForsatiNouvF = 0;
        $totalForsatiCour = 0;
        $totalForsatiCourD = 0;
        $totalForsatiCourF = 0;
        $totalForsatiAcheve = 0;
        $totalForsatiAcheveD = 0;
        $totalForsatiAcheveF = 0;

//KARAMA Nouv
        $totalKARAMANouv = 0;
        $totalKARAMANouvD = 0;
        $totalKARAMANouvF = 0;
        $totalKARAMACour = 0;
        $totalKARAMACourD = 0;
        $totalKARAMACourF = 0;
        $totalKARAMAcheve = 0;
        $totalKARAMAcheveD = 0;
        $totalKARAMAcheveF = 0;
        $totalKARAMAInser = 0;
        $totalKARAMAInserD = 0;
        $totalKARAMAInserF = 0;

//La micro entreprise
        $totalMEEtudies = 0;
        $totalMEEtudiesD = 0;
        $totalMEEtudiesF = 0;
        $totalMEFinances = 0;
        $totalMEFinancesD = 0;
        $totalMEFinancesF = 0;
        $totalMEBA = 0;
        $totalMEBAD = 0;
        $totalMEBAF = 0;
        $totalMEVisite = 0;
        $totalMEVisiteF = 0;
        $totalMEVisiteD = 0;

// Micro Entreprise
        $totalActionMESI = 0;
        $totalActionMESID = 0;
        $totalActionMESIF = 0;
        $totalActionCEFE = 0;
        $totalActionCEFED = 0;
        $totalActionCEFEF = 0;
        $totalActionCREE = 0;
        $totalActionCREED = 0;
        $totalActionCREEF = 0;
        $totalActionMorraine = 0;
        $totalActionMorraineD = 0;
        $totalActionMorraineF = 0;
        foreach ($emploiData as $res) {

//Les programmes actifs d'emploi
//SIVP
//SIVP Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('SIVP Nouv')) {
//SIVP Nouv
                $totalSIVPNouveau++;
                if (strtoupper($res->getDipSup()) == 1) {
//SIVP Nouv diplome
                    $totalSIVPNouveauD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//SIVP Nouv femme
                    $totalSIVPNouveauF++;
                }
            }

//SIVP inser
            if (strtoupper($res->getIndicateur()) == strtoupper('SIVP inser')) {
//SIVP inser
                $totalSIVPInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//SIVP inser diplome
                    $totalSIVPInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//SIVP inser femme
                    $totalSIVPInserF++;
                }
            }

//SIVP  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('SIVP inser')) {
//SIVP  en cour
                $totalSIVPCour++;
                if (strtoupper($res->getDipSup()) == 1) {
//SIVP  en cour diplome
                    $totalSIVPCourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//SIVP  en cour femme
                    $totalSIVPCourF++;
                }
            }

//CIVP  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('CIVP Nouv')) {
//CIVP  Nouv
                $totalCIVPNouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIVP  Nouv diplome
                    $totalCIVPNouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIVP  Nouv femme
                    $totalCIVPNouvF++;
                }
            }
//CIVP  inser
            if (strtoupper($res->getIndicateur()) == strtoupper('CIVP inser')) {
//CIVP  inser
                $totalCIVPInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIVP  Nouv diplome
                    $totalCIVPInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIVP  Nouv femme
                    $totalCIVPInserF++;
                }
            }
//CIVP  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('CIVP en cour')) {
//CIVP  en cour
                $totalCIVPCour++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIVP  en cour diplome
                    $totalCIVPCourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIVP  en cour femme
                    $totalCIVPCourF++;
                }
            }

//SCV  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('SCV Nouv')) {
//SCV  Nouv
                $totalSCVNouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//SCV Nouv D
                    $totalSCVNouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//SCV  Nouv femme
                    $totalSCVNouvF++;
                }
            }
//SCV  inser
            if (strtoupper($res->getIndicateur()) == strtoupper('SCV inser')) {
//SCV  inser
                $totalSCVInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//SCV inser D
                    $totalSCVInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//SCV  inser femme
                    $totalSCVInserF++;
                }
            }

//SCV  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('SCV en cour')) {
//SCV  en cour
                $totalSCVCour++;
                if (strtoupper($res->getDipSup()) == 1) {
//SCV en cour D
                    $totalSCVCourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//SCV  en cour femme
                    $totalSCVCourF++;
                }
            }
//CAIP  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('CAIP Nouv')) {
//CAIP  Nouv
                $totalCAIPNouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//CAIP  Nouv D
                    $totalCAIPNouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CAIP  Nouv femme
                    $totalCAIPNouvF++;
                }
            }

//CAIP  Inser
            if (strtoupper($res->getIndicateur()) == strtoupper('CAIP inser')) {
//CAIP  Inser
                $totalCAIPInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//CAIP  Nouv D
                    $totalCAIPInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CAIP  Nouv femme
                    $totalCAIPInserF++;
                }
            }

//CAIP  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('CAIP  en cour')) {
//CAIP  en cour
                $totalCAIPCour++;
                if (strtoupper($res->getDipSup()) == 1) {
//CAIP  en cour D
                    $totalCAIPCourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CAIP  en cour femme
                    $totalCAIPCourF++;
                }
            }


//CIDES  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('CIDES Nouv')) {
//CIDES  Nouv
                $totalCIDESNouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIDES  Nouv D
                    $totalCIDESNouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIDES  Nouv femme
                    $totalCIDESNouvF++;
                }
            }

//CIDES  Inser
            if (strtoupper($res->getIndicateur()) == strtoupper('CIDES inser')) {
//CIDES  Inser
                $totalCIDESInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIDES  Nouv D
                    $totalCIDESInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIDES  Nouv femme
                    $totalCIDESInserF++;
                }
            }

//CIDES  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('CIDES  en cour')) {
//CIDES  en cour
                $totalCIDESCour++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIDES  en cour D
                    $totalCIDESCourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIDES  en cour femme
                    $totalCIDESCourF++;
                }
            }


//CIDES  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('CIDES Nouv')) {
//CIDES  Nouv
                $totalCIDESNouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIDES  Nouv D
                    $totalCIDESNouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIDES  Nouv femme
                    $totalCIDESNouvF++;
                }
            }

//CIDES  Inser
            if (strtoupper($res->getIndicateur()) == strtoupper('CIDES inser')) {
//CIDES  Inser
                $totalCIDESInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIDES  Nouv D
                    $totalCIDESInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIDES  Nouv femme
                    $totalCIDESInserF++;
                }
            }

//CIDES  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('CIDES  en cour')) {
//CIDES  en cour
                $totalCIDESCour++;
                if (strtoupper($res->getDipSup()) == 1) {
//CIDES  en cour D
                    $totalCIDESCourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIDES  en cour femme
                    $totalCIDESCourF++;
                }
            }


//CRVA  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('CRVA Nouv')) {
//CRVA  Nouv
                $totalCRVANouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//CRVA  Nouv D
                    $totalCRVANouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CRVA  Nouv femme
                    $totalCRVANouvF++;
                }
            }

//CRVA  Inser
            if (strtoupper($res->getIndicateur()) == strtoupper('CRVA inser')) {
//CRVA  Inser
                $totalCRVAInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//CRVA  Inser D
                    $totalCRVAInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CIDES  Inser femme
                    $totalCRVAInserF++;
                }
            }

//CRVA  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('CRVA  en cour')) {
//CRVA  en cour
                $totalCRVACour++;
                if (strtoupper($res->getDipSup()) == 1) {
//CRVA  en cour D
                    $totalCRVACourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//CRVA  en cour femme
                    $totalCRVACourF++;
                }
            }


//Forsati  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('Forsati Nouv')) {
//Forsati  Nouv
                $totalForsatiNouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//Forsati  Nouv D
                    $totalForsatiNouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//Forsati  Nouv femme
                    $totalForsatiNouvF++;
                }
            }

//Forsati  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('Forsati  en cour')) {
//Forsati  en cour
                $totalForsatiCour++;
                if (strtoupper($res->getDipSup()) == 1) {
//Forsati  en cour D
                    $totalForsatiCourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//Forsati  en cour femme
                    $totalForsatiCourF++;
                }
            }
//Forsati  acheves
            if (strtoupper($res->getIndicateur()) == strtoupper('Forsati acheves')) {
//Forsati  acheves
                $totalForsatiAcheve++;
                if (strtoupper($res->getDipSup()) == 1) {
//Forsati  acheves D
                    $totalForsatiAcheveD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//Forsati  acheves femme
                    $totalForsatiAcheveF++;
                }
            }


//KARAMA  Nouv
            if (strtoupper($res->getIndicateur()) == strtoupper('KARAMA Nouv')) {
//KARAMA  Nouv
                $totalKARAMANouv++;
                if (strtoupper($res->getDipSup()) == 1) {
//KARAMA  Nouv D
                    $totalKARAMANouvD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//KARAMA  Nouv femme
                    $totalKARAMANouvF++;
                }
            }

//KARAMA  en cour
            if (strtoupper($res->getIndicateur()) == strtoupper('KARAMA en cour')) {
//KARAMA  en cour
                $totalKARAMACour++;
                if (strtoupper($res->getDipSup()) == 1) {
//KARAMA  en cour D
                    $totalKARAMACourD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//KARAMA  en cour femme
                    $totalKARAMACourF++;
                }
            }
//KARAMA  acheves
            if (strtoupper($res->getIndicateur()) == strtoupper('KARAMA acheves')) {
//KARAMA  acheves
                $totalKARAMAcheve++;
                if (strtoupper($res->getDipSup()) == 1) {
//KARAMA  acheves D
                    $totalKARAMAcheveD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//KARAMA  acheves femme
                    $totalKARAMAcheveF++;
                }
            }

//KARAMA  inser
            if (strtoupper($res->getIndicateur()) == strtoupper('KARAMA inser')) {
//KARAMA  inser
                $totalKARAMAInser++;
                if (strtoupper($res->getDipSup()) == 1) {
//KARAMA  inser D
                    $totalKARAMAInserD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//KARAMA  inser femme
                    $totalKARAMAInserF++;
                }
            }
//ME etudies
            if (strtoupper($res->getIndicateur()) == strtoupper('ME etudies')) {
//ME etudies
                $totalMEEtudies++;
                if (strtoupper($res->getDipSup()) == 1) {
//ME etudies D
                    $totalMEEtudiesD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//ME etudies femme
                    $totalMEEtudiesF++;
                }
            }

//ME finances
            if (strtoupper($res->getIndicateur()) == strtoupper('ME finances')) {
//ME finances
                $totalMEFinances++;
                if (strtoupper($res->getDipSup()) == 1) {
//ME finances D
                    $totalMEFinancesD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//ME etudies femme
                    $totalMEFinancesF++;
                }
            }

//ME BA
            if (strtoupper($res->getIndicateur()) == strtoupper('ME BA')) {
//ME BA
                $totalMEBA++;
                if (strtoupper($res->getDipSup()) == 1) {
//ME BA D
                    $totalMEBAD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//ME BA femme
                    $totalMEBAF++;
                }
            }

//ME Visite
            if (strtoupper($res->getIndicateur()) == strtoupper('ME Visite')) {
//ME Visite
                $totalMEVisite++;
                if (strtoupper($res->getDipSup()) == 1) {
//ME Visite D
                    $totalMEVisiteD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//ME Visite femme
                    $totalMEVisiteF++;
                }
            }


//Action ME SI
            if (strtoupper($res->getIndicateur()) == strtoupper('Action ME SI')) {
//Action ME SI
                $totalActionMESI++;
                if (strtoupper($res->getDipSup()) == 1) {
//Action ME SI D
                    $totalActionMESID++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//Action ME SI femme
                    $totalActionMESIF++;
                }
            }

//Action CEFE
            if (strtoupper($res->getIndicateur()) == strtoupper('Action ME CEFE')) {
//Action CEFE
                $totalActionCEFE++;
                if (strtoupper($res->getDipSup()) == 1) {
//Action CEFE D
                    $totalActionCEFED++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//Action CEFE femme
                    $totalActionCEFEF++;
                }
            }
//Action  CREE
            if (strtoupper($res->getIndicateur()) == strtoupper('Action ME CREE')) {
//Action  CREE
                $totalActionCREE++;
                if (strtoupper($res->getDipSup()) == 1) {
//Action  CREE D
                    $totalActionCREED++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//Action  CREE femme
                    $totalActionCREEF++;
                }
            }

//Action  ME Morraine
            if (strtoupper($res->getIndicateur()) == strtoupper('Action ME Morraine')) {
//Action  ME Morraine
                $totalActionMorraine++;
                if (strtoupper($res->getDipSup()) == 1) {
//Action  ME Morraine D
                    $totalActionMorraineD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//Action ME Morraine femme
                    $totalActionMorraineF++;
                }
            }


        }
        $tab = [];

        $tab['sivp'][0]['Nouv'] = ['total' => $totalSIVPNouveau, 'diplome' => $totalSIVPNouveauD, 'Femme' => $totalSIVPNouveauF];
        $tab['sivp'][0]['inser'] = ['total' => $totalSIVPInser, 'diplome' => $totalSIVPInserD, 'Femme' => $totalSIVPInserF];
        $tab['sivp'][0]['cour'] = ['total' => $totalSIVPCour, 'diplome' => $totalSIVPCourD, 'Femme' => $totalSIVPCourF];
        $tab['civp'][0]['Nouv'] = ['total' => $totalCIVPNouv, 'diplome' => $totalCIVPNouvD, 'Femme' => $totalCIVPNouvF];
        $tab['civp'][0]['inser'] = ['total' => $totalCIVPInser, 'diplome' => $totalCIVPInserD, 'Femme' => $totalCIVPInserF];
        $tab['civp'][0]['cour'] = ['total' => $totalCIVPCour, 'diplome' => $totalCIVPCourD, 'Femme' => $totalCIVPCourF];
        $tab['SCV'][0]['Nouv'] = ['total' => $totalSCVNouv, 'diplome' => $totalSCVNouvD, 'Femme' => $totalSCVNouvF];
        $tab['SCV'][0]['inser'] = ['total' => $totalSCVInser, 'diplome' => $totalSCVInserD, 'Femme' => $totalSCVInserF];
        $tab['SCV'][0]['cour'] = ['total' => $totalSCVCour, 'diplome' => $totalSCVCourD, 'Femme' => $totalSCVCourF];
        $tab['CAIP'][0]['Nouv'] = ['total' => $totalCAIPNouv, 'diplome' => $totalCAIPNouvD, 'Femme' => $totalCAIPNouvF];
        $tab['CAIP'][0]['inser'] = ['total' => $totalCAIPInser, 'diplome' => $totalCAIPInserD, 'Femme' => $totalCAIPInserF];
        $tab['CAIP'][0]['cour'] = ['total' => $totalCAIPCour, 'diplome' => $totalCAIPCourD, 'Femme' => $totalCAIPCourF];
        $tab['CIDES'][0]['Nouv'] = ['total' => $totalCIDESNouv, 'diplome' => $totalCIDESNouvD, 'Femme' => $totalCIDESNouvF];
        $tab['CIDES'][0]['inser'] = ['total' => $totalCIDESInser, 'diplome' => $totalCIDESInserD, 'Femme' => $totalCIDESInserF];
        $tab['CIDES'][0]['cour'] = ['total' => $totalCAIPCour, 'diplome' => $totalCIDESCourD, 'Femme' => $totalCIDESCourF];
        $tab['CRVA'][0]['Nouv'] = ['total' => $totalCRVANouv, 'diplome' => $totalCRVANouvD, 'Femme' => $totalCRVANouvF];
        $tab['CRVA'][0]['inser'] = ['total' => $totalCRVAInser, 'diplome' => $totalCRVAInserD, 'Femme' => $totalCRVAInserF];
        $tab['CRVA'][0]['cour'] = ['total' => $totalCRVACour, 'diplome' => $totalCRVACourD, 'Femme' => $totalCRVACourF];
        $tab['Forsati'][0]['Nouv'] = ['total' => $totalForsatiNouv, 'diplome' => $totalForsatiNouvD, 'Femme' => $totalForsatiNouvF];
        $tab['Forsati'][0]['cour'] = ['total' => $totalForsatiCour, 'diplome' => $totalForsatiCourD, 'Femme' => $totalForsatiCourF];
        $tab['Forsati'][0]['acheves'] = ['total' => $totalForsatiAcheve, 'diplome' => $totalForsatiAcheveD, 'Femme' => $totalForsatiAcheveF];
        $tab['KARAMA'][0]['Nouv'] = ['total' => $totalKARAMANouv, 'diplome' => $totalKARAMANouvD, 'Femme' => $totalKARAMANouvF];
        $tab['KARAMA'][0]['cour'] = ['total' => $totalKARAMACour, 'diplome' => $totalKARAMACourD, 'Femme' => $totalKARAMACourF];
        $tab['KARAMA'][0]['acheves'] = ['total' => $totalKARAMAcheve, 'diplome' => $totalKARAMAcheveD, 'Femme' => $totalKARAMAcheveF];
        $tab['KARAMA'][0]['inser'] = ['total' => $totalKARAMAInser, 'diplome' => $totalKARAMAInserD, 'Femme' => $totalKARAMAInserF];
        $tab['micro'][0]['ME_etudies'] = ['total' => $totalMEEtudies, 'diplome' => $totalMEEtudiesD, 'Femme' => $totalMEEtudiesF];
        $tab['micro'][0]['ME_finances'] = ['total' => $totalMEFinances, 'diplome' => $totalMEFinancesD, 'Femme' => $totalMEFinancesF];
        $tab['micro'][0]['ME_BA'] = ['total' => $totalMEBA, 'diplome' => $totalMEBAD, 'Femme' => $totalMEBAF];
        $tab['micro'][0]['ME_Visite'] = ['total' => $totalMEVisite, 'diplome' => $totalMEVisiteD, 'Femme' => $totalMEVisiteF];
        $tab['micro_entreprise'][0]['ME_SI'] = ['total' => $totalActionMESI, 'diplome' => $totalActionMESID, 'Femme' => $totalActionMESIF];
        $tab['micro_entreprise'][0]['ME_CEFE'] = ['total' => $totalActionCEFE, 'diplome' => $totalActionCEFED, 'Femme' => $totalActionCEFEF];
        $tab['micro_entreprise'][0]['ME_CREE'] = ['total' => $totalActionCREE, 'diplome' => $totalActionCREED, 'Femme' => $totalActionCREEF];
        $tab['micro_entreprise'][0]['ME_Morraine'] = ['total' => $totalActionMorraine, 'diplome' => $totalActionMorraineD, 'Femme' => $totalActionMorraineF];
//   $tab['entreprises_inscrites'][0]['Bureau_emploi'] = ['totalMoins10' => $totalMoins10, 'total10etplus' => $total10etplus];
        return $tab;
    }

//return tab of total inscription emploi
    private function getTotalEmploiInscrit($emploiData)
    {

// total Defm
        $totalDefmNI = 0;
        $totalDefmNIF = 0;
        $totalDefmNID = 0;
        $totalDefmRI = 0;
        $totalDefmRIF = 0;
        $totalDefmRID = 0;

// total Offre Emploi
        $totalOffreEmploiNouvel = 0;
        $totalOffreEmploiNouvelD = 0;
        $totalOffreEmploiNouvelF = 0;
        $totalOffreEmploiCours = 0;
        $totalOffreEmploiCoursD = 0;
        $totalOffreEmploiCoursF = 0;

// total Placement Emploi
        $totalPlacementEmploiPlin = 0;
        $totalPlacementEmploiPlinD = 0;
        $totalPlacementEmploiPlinF = 0;
        $totalPlacementEmploiPld = 0;
        $totalPlacementEmploiPldD = 0;
        $totalPlacementEmploiPldF = 0;

        foreach ($emploiData as $res) {
//total DEFM
            if (strtoupper($res->getIndicateur()) == 'NI') {
//total DEFM NI
                $totalDefmNI++;
                if (strtoupper($res->getDipSup()) == 1) {
///total DEFM NI diplome
                    $totalDefmNID++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//total DEFM NI femme
                    $totalDefmNIF++;
                }
            }
            if (strtoupper($res->getIndicateur()) == 'RI') {
//total DEFM RI
                $totalDefmRI++;
                if (strtoupper($res->getDipSup()) == 1) {
//total DEFM RI Diplome
                    $totalDefmRID++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
//total DEFM RI femme
                    $totalDefmRIF++;
                }
            }
            if (strtoupper($res->getIndicateur()) == 'NOUVELLES OFFRES') {
//total des nouvelles offres d'emploi
                $totalOffreEmploiNouvel++;
                if (strtoupper($res->getDipSup()) == 1) {
//total des nouvelles offres d'emploi diplome
                    $totalOffreEmploiNouvelD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
///total des nouvelles offres d'emploi
                    $totalOffreEmploiNouvelF++;
                }
            }
            if (strtoupper($res->getIndicateur()) == 'OFFRES EN COURS') {
//total des OFFRES d'emploi EN COURS
                $totalOffreEmploiCours++;
//total des OFFRES d'emploi diplome
                if (strtoupper($res->getDipSup()) == 1) {
                    $totalOffreEmploiCoursD++;
                }
//total des OFFRES d'emploi feminin
                if (strtoupper($res->getGenre()) == 'F') {
                    $totalOffreEmploiCoursF++;
                }
            }
//placements en emploi
            if (strtoupper($res->getIndicateur()) == strtoupper('Plins')) {
//total des placements en emploi
                $totalPlacementEmploiPlin++;
                if (strtoupper($res->getDipSup()) == 1) {
//total des nouvelles offres d'emploi diplome
                    $totalPlacementEmploiPlinD++;
                }
                if (strtoupper($res->getGenre()) == 'F') {
///total des nouvelles offres d'emploi
                    $totalPlacementEmploiPlinF++;
                }
            }
            if (strtoupper($res->getIndicateur()) == strtoupper('Pld')) {
//total des OFFRES d'emploi EN COURS
                $totalPlacementEmploiPld++;
//total des OFFRES d'emploi diplome
                if (strtoupper($res->getDipSup()) == 1) {
                    $totalPlacementEmploiPldD++;
                }
//total des OFFRES d'emploi feminin
                if (strtoupper($res->getGenre()) == 'F') {
                    $totalPlacementEmploiPldF++;
                }
            }
        }
        $tab = [];
        $tab['DEFM'][0]['NI'] = ['total' => $totalDefmNI, 'diplome' => $totalDefmNID, 'Femme' => $totalDefmNIF];
        $tab['DEFM'][0]['RI'] = ['total' => $totalDefmRI, 'diplome' => $totalDefmRID, 'Femme' => $totalDefmRIF];
        $tab['Offre_Emploi'][0]['Nouvelles_offres'] = ['total' => $totalOffreEmploiNouvel, 'diplome' => $totalOffreEmploiNouvelD, 'Femme' => $totalOffreEmploiNouvelF];
        $tab['Offre_Emploi'][0]['Offres_en_cours'] = ['total' => $totalOffreEmploiCours, 'diplome' => $totalOffreEmploiCoursD, 'Femme' => $totalOffreEmploiCoursF];
        $tab['demandes_emploi'][0]['NI'] = ['total' => $totalDefmNI, 'diplome' => $totalDefmNID, 'Femme' => $totalDefmNIF];
        $tab['demandes_emploi'][0]['RI'] = ['total' => $totalDefmRI, 'diplome' => $totalDefmRID, 'Femme' => $totalDefmRIF];
        $tab['placements_emploi'][0]['plins'] = ['total' => $totalPlacementEmploiPlin, 'diplome' => $totalPlacementEmploiPlinD, 'Femme' => $totalPlacementEmploiPlinF];
        $tab['placements_emploi'][0]['pld'] = ['total' => $totalPlacementEmploiPld, 'diplome' => $totalPlacementEmploiPldD, 'Femme' => $totalPlacementEmploiPldF];
        return $tab;
    }

//Function return total of emploi information inscrit
    private function getEmploiInformationInscritData($data)
    {
        $em = $this->getDoctrine()->getManager();
        $emploiData = $em->getRepository('MfpeCollectDataBundle:AnetiTable1')->findDataEmploiByFiltre($data);
        $tab = $this->getTotalEmploiInscrit($emploiData);
        return $tab;
    }

//return info emploi inscrit for second period
    private function getEmploiInformationInscritDataP2($data)
    {
        $tab = [];
        $tabP2 = [];
        $em = $this->getDoctrine()->getManager();
        $emploiData = $em->getRepository('MfpeCollectDataBundle:AnetiTable1')->findDataEmploiByFiltreP2($data);
        $tab = $this->getTotalEmploiInscrit($emploiData);
        if (isset($tab) && !empty($tab)) {
            foreach ($tab as $key => $secondary) {
                foreach ($secondary as $k => $sec) {
                    foreach ($sec as $k1 => $objet) {
                        $newkey = $k1 . '_secondary';
                        $tabP2[$key][$k][$newkey] = $objet;
                    }
                }
            }
        }
        return $tabP2;
    }

    //return info emploi inscrit for second period
    private function getNationalEmploiInformationInscritDataP2($data)
    {
        $tab = [];
        $tabP2 = [];
        $em = $this->getDoctrine()->getManager();
        $emploiData = $em->getRepository('MfpeCollectDataBundle:AnetiTable1')->getNationalDataEmploiP2($data);
        $tab = $this->getTotalEmploiInscrit($emploiData);
        if (isset($tab) && !empty($tab)) {
            foreach ($tab as $key => $secondary) {
                foreach ($secondary as $k => $sec) {
                    foreach ($sec as $k1 => $objet) {
                        $newkey = $k1 . '_national';
                        $tabP2[$key][$k][$newkey] = $objet;
                    }
                }
            }
        }
        return $tabP2;
    }

//return info emploi programme for second period
    private function getEmploiInformationProgrammeDataP2($data)
    {
        $tab = [];
        $tabP2 = [];
        $em = $this->getDoctrine()->getManager();
        $emploiData = $em->getRepository('MfpeCollectDataBundle:AnetiTable1')->findDataEmploiByFiltreP2($data);
        $tab = $this->getTotalEmploiProgramme($emploiData);
        if (isset($tab) && !empty($tab)) {
            foreach ($tab as $key => $secondary) {
                foreach ($secondary as $k => $sec) {
                    foreach ($sec as $k1 => $objet) {
                        $newkey = $k1 . '_secondary';
                        $tabP2[$key][$k][$newkey] = $objet;
                    }
                }
            }
        }
        return $tabP2;
    }

    //return national  emploi Programme for second period
    private function getNationalEmploiInformationProgrammeDataP2($data)
    {
        $tab = [];
        $tabP2 = [];
        $em = $this->getDoctrine()->getManager();
        $emploiData = $em->getRepository('MfpeCollectDataBundle:AnetiTable1')->getNationalDataEmploiP2($data);
        $tab = $this->getTotalEmploiProgramme($emploiData);
        if (isset($tab) && !empty($tab)) {
            foreach ($tab as $key => $secondary) {
                foreach ($secondary as $k => $sec) {
                    foreach ($sec as $k1 => $objet) {
                        $newkey = $k1 . '_national';
                        $tabP2[$key][$k][$newkey] = $objet;
                    }
                }
            }
        }
        return $tabP2;
    }
    //get national Emploi
    private function getNationalEmploiP2($data,$tab)
    {
        $tab = [];
        $tabP2 = [];
        $em = $this->getDoctrine()->getManager();
//        $emploiData = $em->getRepository('MfpeCollectDataBundle:AnetiTable1')->findNationalDataEmploiByFiltreP2($data);
//        $tab = $this->getTotalEmploiProgramme($emploiData);
        if (isset($tab) && !empty($tab)) {
            foreach ($tab as $key => $secondary) {
                foreach ($secondary as $k => $sec) {
                    foreach ($sec as $k1 => $objet) {
                        $newkey = $k1 . '_national';
                        $tabP2[$key][$k][$newkey] = $objet;
                    }
                }
            }
        }
        return $tabP2;
    }
//return info emploi programme for first period
    private function getEmploiInformationProgrammeData($data)
    {
        $em = $this->getDoctrine()->getManager();
        $emploiData = $em->getRepository('MfpeCollectDataBundle:AnetiTable1')->findDataEmploiByFiltre($data);
        $tab = $this->getTotalEmploiProgramme($emploiData);
        return $tab;
    }

// return merge between first and second period for inscrit emploi
    private function getMergeEmploiInformation($infoEmploiInformation, $infoEmploiInformationSecondary)
    {
        $tabMerge = [];
        if (isset($infoEmploiInformation) && !empty($infoEmploiInformation) && isset($infoEmploiInformationSecondary) && !empty($infoEmploiInformationSecondary)) {
            foreach ($infoEmploiInformation as $key => $value) {
                foreach ($value as $k => $val) {
                    $tabMerge [$key][$k] = array_merge($val, $infoEmploiInformationSecondary[$key][$k]);
                }
            }
        } elseif (isset($infoEmploiInformation) && !empty($infoEmploiInformation) && empty($infoEmploiInformationSecondary)) {
            $tabMerge = $infoEmploiInformation;
        } elseif (empty($infoEtatiqueProfessionnel) && isset($infoEmploiInformationSecondary) && !empty($infoEmploiInformationSecondary)) {
            $tabMerge = $infoEmploiInformationSecondary;
        }

        $Result = $this->get('jms_serializer')->serialize($tabMerge, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

    public function entreprises_inscrites($data)
    {
        $em = $this->getDoctrine()->getManager();
        //table aneti 2
        $emploiDataTable2 = $em->getRepository('MfpeCollectDataBundle:AnetiTable2')->findDataEmploiTable2ByFiltre($data);

        //parcour table aneti 2
        $totalMoins10 = 0;
        $total10etplus = 0;
        $tab = [];
        foreach ($emploiDataTable2 as $res) {
            //total moins de 10
            if (strtoupper($res->getLibTaille()) == 'MOINS DE 10') {
                $totalMoins10++;
            }
            if (strtoupper($res->getLibTaille()) == '10 ET PLUS') {
                $total10etplus++;
            }
        }
        $tab['entreprises_inscrites'][0]['Bureau_emploi'] = ['totalMoins10' => $totalMoins10, 'total10etplus' => $total10etplus];
        return $tab;
    }

    public function entreprises_inscritesP2($data)
    {
        $em = $this->getDoctrine()->getManager();
        //table aneti 2
        $emploiDataTable2 = $em->getRepository('MfpeCollectDataBundle:AnetiTable2')->findDataEmploiTable2ByFiltreP2($data);
        //parcour table aneti 2
        $totalMoins10 = 0;
        $total10etplus = 0;
        $tab = [];
        foreach ($emploiDataTable2 as $res) {
            //total moins de 10
            if (strtoupper($res->getLibTaille()) == 'MOINS DE 10') {
                $totalMoins10++;
            }
            if (strtoupper($res->getLibTaille()) == '10 ET PLUS') {
                $total10etplus++;
            }
        }
        $tab['entreprises_inscrites'][0]['Bureau_emploi_secondary'] = ['totalMoins10' => $totalMoins10, 'total10etplus' => $total10etplus];
        return $tab;
    }

    public function entreprises_inscrites_nationalP2($data)
    {
        $em = $this->getDoctrine()->getManager();
        //table aneti 2
       $emploiDataTable2 = $em->getRepository('MfpeCollectDataBundle:AnetiTable2')->getNationalDataEmploiP2($data);
        //parcour table aneti 2
        $totalMoins10 = 0;
        $total10etplus = 0;
        $tab = [];
        foreach ($emploiDataTable2 as $res) {
            //total moins de 10
            if (strtoupper($res->getLibTaille()) == 'MOINS DE 10') {
                $totalMoins10++;
            }
            if (strtoupper($res->getLibTaille()) == '10 ET PLUS') {
                $total10etplus++;
            }
        }
        $tab['entreprises_inscrites'][0]['Bureau_emploi_national'] = ['totalMoins10' => $totalMoins10, 'total10etplus' => $total10etplus];
        return $tab;
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"MoeGroup"})
     * @Rest\Get(
     *     path = "/emploi_information_inscription",
     *     name="app_emploi-information-incri-data_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     nullable=true,
     *     description="id gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="delegation",
     *     nullable=true,
     *     description="id delegation to search for."
     * )
     * @Rest\QueryParam(
     *     name="bureau_emploi",
     *     nullable=true,
     *     description="bureau d'emploi to search for."
     * )
     * @Rest\QueryParam(
     *     name="from",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From search for."
     * )
     * @Rest\QueryParam(
     *     name="to",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="To search for."
     * )
     *
     * @Rest\QueryParam(
     *     name="fromSecondary",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="toSecondary",
     *     nullable=true,
     *     default="20-04-2020",
     *     description="To Secondary search for."
     * )
     * @Rest\QueryParam(
     *     name="donnees",
     *     nullable=true,
     *     description="donnee to search for."
     * )
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  all emploi Information  data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailStatGraduateTraining"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getEmploiInformationInscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $total = "";
        $response = [];
        $data = json_decode(json_encode($request->query->all()), true);
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
        $response = self::getEmploiInformationInscritData($data);
        //  dd($response);
        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])
            && isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])
        ) {
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateGouvernorat($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //return result for first period
            $infoEmploiInformation = $this->getEmploiInformationInscritData($data);
            //return result for second period
            $infoEmploiInformationSecondary = $this->getEmploiInformationInscritDataP2($data);
             //return merge for 2 period
            $responseMerge = self::getMergeEmploiInformation($infoEmploiInformation, $infoEmploiInformationSecondary);
            //return national period
            $infoEmploiInformationNational = self::getNationalEmploiInformationInscritDataP2($data);
            //return merge tab with national for second periode
            $response = self::getMergeEmploiInformation($responseMerge, $infoEmploiInformationNational);

        } elseif (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {

            $response = [];
        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"MoeGroup"})
     * @Rest\Get(
     *     path = "/emploi_information_programs",
     *     name="app_emploi-information-programs-data_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     nullable=true,
     *     description="id gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="delegation",
     *     nullable=true,
     *     description="id delegation to search for."
     * )
     * @Rest\QueryParam(
     *     name="bureau_emploi",
     *     nullable=true,
     *     description="bureau d'emploi to search for."
     * )
     * @Rest\QueryParam(
     *     name="from",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From search for."
     * )
     * @Rest\QueryParam(
     *     name="to",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="To search for."
     * )
     * @Rest\QueryParam(
     *     name="fromSecondary",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="toSecondary",
     *     nullable=true,
     *     default="20-04-2020",
     *     description="To Secondary search for."
     * )
     * @Rest\QueryParam(
     *     name="donnees",
     *     nullable=true,
     *     description="donnee to search for."
     * )
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  all emploi Information  data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailStatGraduateTraining"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getEmploiInformationProgramsAction(Request $request)
    {
//        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
//            $message = ApiProblem::TOKEN_JWT_EXPIRED;
//            $errors['token'] = $message;
//            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//        }
//        if (!is_object($user = $token->getUser())) {
//            // e.g. anonymous authentication
//            $message = ApiProblem::TOKEN_JWT_EXPIRED;
//            $errors['token'] = $message;
//            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//        }
        $em = $this->getDoctrine()->getManager();
        $response = [];
        $data = json_decode(json_encode($request->query->all()), true);
        $response = self::getEmploiInformationProgrammeData($data);
        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])
            && isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])
        ) {
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateGouvernorat($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //return result for first period
            $infoEmploiInformation = $this->getEmploiInformationProgrammeData($data);
            //return result for second period
            $infoEmploiInformationSecondary = $this->getEmploiInformationProgrammeDataP2($data);
            //return merge for 2 period
            $responseMerge = self::getMergeEmploiInformation($infoEmploiInformation, $infoEmploiInformationSecondary);
            //return national period
            $infoEmploiInformationNational = self::getNationalEmploiInformationProgrammeDataP2($data);
            //return merge tab with national for second periode
            $response = self::getMergeEmploiInformation($responseMerge, $infoEmploiInformationNational);

        } elseif (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $response = [];
        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"MoeGroup"})
     * @Rest\Get(
     *     path = "/emploi_entreprises_inscrites",
     *     name="app_emploi-entreprises-inscrites_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     nullable=true,
     *     description="id gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="delegation",
     *     nullable=true,
     *     description="id delegation to search for."
     * )
     * @Rest\QueryParam(
     *     name="bureau_emploi",
     *     nullable=true,
     *     description="bureau d'emploi to search for."
     * )
     * @Rest\QueryParam(
     *     name="from",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From search for."
     * )
     * @Rest\QueryParam(
     *     name="to",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="To search for."
     * )
     * @Rest\QueryParam(
     *     name="fromSecondary",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="toSecondary",
     *     nullable=true,
     *     default="20-04-2020",
     *     description="To Secondary search for."
     * )
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  all emploi Information  data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailStatGraduateTraining"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getEmploiInformationTable2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $total = "";
        $response = [];
        $data = json_decode(json_encode($request->query->all()), true);
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
        $response = self::entreprises_inscrites($data);

        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])
            && isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])
        ) {

            $validator = New ValidateEmploi($em);
            $errors = $validator->validateGouvernorat($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }

            //return result for first period
            $infoEmploiInformation = $this->entreprises_inscrites($data);
            //return result for second period
            $infoEmploiInformationSecondary = $this->entreprises_inscritesP2($data);
            //return merge for 2 period
            $responseMerge = self::getMergeEmploiInformation($infoEmploiInformation, $infoEmploiInformationSecondary);
            //return national period
            $infoEmploiInformationNational = self::entreprises_inscrites_nationalP2($data);
            //return merge tab with national for second periode
            $response = self::getMergeEmploiInformation($responseMerge, $infoEmploiInformationNational);

        } elseif (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $response = [];
        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);

    }
}

