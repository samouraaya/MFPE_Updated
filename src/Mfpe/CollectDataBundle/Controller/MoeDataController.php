<?php


namespace Mfpe\CollectDataBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use http\Client;
use Mfpe\AttestationBundle\Validator\validateUniteRegional;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Mfpe\ConfigBundle\Services\EntityMerger;
use Mfpe\ConfigBundle\Services\PermissionService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;

use Mfpe\CollectDataBundle\Entity\AnetiTable1;
use Mfpe\CollectDataBundle\Entity\AnetiTable2;
use Mfpe\CollectDataBundle\Validator\ValidateEmploi;


/**
 * Description of ProjectDataController
 *
 * @author wiem hadiji
 */
class MoeDataController extends BaseController
{
    use ControllerTrait;


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={""})
     * @Rest\Get(
     *     path = "/",
     *     defaults={"_format"="xml"},
     *     name="app_MOA-attestation_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"MOA Data"},
     *  summary="Get  all MOA Data",
     *  description ="",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectData::class, groups={"publicProject","cooperateProject"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getAction(Request $request)
    {

        //  result de l'api soap ExecuterRequeteAttestationAnneeGouvernorat
        $resultAttestation = $this->getAttestationAnneeGouvernorat($request);
        if (array_key_exists("Fault", $resultAttestation)) {
            $resultAttestation['code'] = $resultAttestation['Fault']['faultcode'];
            $resultAttestation['error'] = $resultAttestation['Fault']['faultstring'];
        }
        if (array_key_exists("ExecuterRequeteAttestationAnneeGouvernoratResponse", $resultAttestation)) {
            $resultAttestation = $resultAttestation['ExecuterRequeteAttestationAnneeGouvernoratResponse']['ExecuterRequeteAttestationAnneeGouvernoratResult']['diffgrdiffgram']['NewDataSet']['Table'];
        }

        //result de l'api soap ExecuterRequeteContratAnneeGouvernorat
        $resultContrat = $this->getContratAnneeGouvernorat($request);
        if (array_key_exists("Fault", $resultContrat)) {
            $resultContrat['code'] = $resultContrat['Fault']['faultcode'];
            $resultContrat['error'] = $resultContrat['Fault']['faultstring'];
        }
        $resultContrat = $resultContrat['ExecuterRequeteContratAnneeGouvernoratResponse']['ExecuterRequeteContratAnneeGouvernoratResult']['diffgrdiffgram']['NewDataSet']['Table'];

        //result de l'api soap ExecuterRequeteEntreprise
        $resultEntreprise = $this->getEntreprise($request);
        if (array_key_exists("Fault", $resultEntreprise)) {
            $resultEntreprise['code'] = $resultEntreprise['Fault']['faultcode'];
            $resultEntreprise['error'] = $resultEntreprise['Fault']['faultstring'];
        }
        $resultEntreprise = $resultEntreprise['ExecuterRequeteEntrepriseResponse']['ExecuterRequeteEntrepriseResult']['diffgrdiffgram']['NewDataSet']['Table'];

        //result de l'api soap ExecuterRequetePersonne
        $resultPersonne = $this->getPersonne($request);
        if (array_key_exists("Fault", $resultPersonne)) {
            $resultPersonne['code'] = $resultPersonne['Fault']['faultcode'];
            $resultPersonne['error'] = $resultPersonne['Fault']['faultstring'];
        }
        $resultPersonne = $resultPersonne['ExecuterRequetePersonneResponse']['ExecuterRequetePersonneResult']['diffgrdiffgram']['NewDataSet']['Table'];

        $tabMoa = ['attestation' => $resultAttestation, 'contrat' => $resultContrat, 'entreprise' => $resultEntreprise, 'personne' => $resultPersonne];
        $tabMoa = $this->get('jms_serializer')->serialize($tabMoa, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $response = json_decode($tabMoa, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);

    }

    private function getAttestationAnneeGouvernorat(Request $request)
    {

        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
        <ExecuterRequeteAttestationAnneeGouvernorat xmlns="http://tempuri.org/" />
        </soap:Body>
        </soap:Envelope>';
        $rest = $this->getParsingSoapApi($xml, $request);
        return $rest;

    }

    private function getPersonne(Request $request)
    {

        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
              <soap:Body>
                <ExecuterRequetePersonne xmlns="http://tempuri.org/" />
              </soap:Body>
            </soap:Envelope>';
        $rest = $this->getParsingSoapApi($xml, $request);
        return $rest;

    }

    private function getContratAnneeGouvernorat(Request $request)
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <ExecuterRequeteContratAnneeGouvernorat xmlns="http://tempuri.org/" />
          </soap:Body>
        </soap:Envelope>';
        $rest = $this->getParsingSoapApi($xml, $request);
        return $rest;
    }

    private function getEntreprise(Request $request)
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>
        <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
          <soap12:Body>
            <ExecuterRequeteEntreprise xmlns="http://tempuri.org/" />
          </soap12:Body>
        </soap12:Envelope>';
        $rest = $this->getParsingSoapApi($xml, $request);

        return $rest;
    }

    private function getParsingSoapApi($xml, Request $request)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'http://193.95.63.187/wsmoejiha/service1.asmx', [
                'headers' => [
                    'Content-Type' => 'text/xml; charset=UTF8',
                    "accept" => "*/*",
                    "accept-encoding" => "gzip, deflate"
                ],
                'body' => $xml
            ]);
            $res = $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
            //$code = $response->getStatusCode();

            $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $res);
            $xml = new \SimpleXMLElement($response);
            $body = $xml->xpath('soapBody')[0];

            $array = json_decode(json_encode((array)$body), TRUE);
            // $result = $array['ExecuterRequeteAttestationAnneeGouvernoratResponse']['ExecuterRequeteAttestationAnneeGouvernoratResult']['diffgrdiffgram']['NewDataSet']['Table'];
            return $array;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }

    }

}