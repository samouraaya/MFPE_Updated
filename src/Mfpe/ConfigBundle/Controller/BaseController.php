<?php
/**
 * Created by PhpStorm.
 * User: Nagui
 * Date: 22/12/2017
 * Time: 18:21
 */

namespace Mfpe\ConfigBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Mfpe\PrevisionLocaleBundle\Services\FtpService;




class BaseController extends FOSRestController
{

    /**
     * @var
     */
    public $ftpService;

    /**
     * @return \Doctrine\ORM\EntityManager|object
     */
    public function em()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    /**
     * @return \JMS\Serializer\Serializer|object|\Symfony\Component\Serializer\Serializer
     */
    public function serializer($data, $format = 'json', $groupe = "default")
    {
        return $this->container->get('jms_serializer')
            ->serialize($data, $format);
    }

    /**
     * @param $data
     * @param int $statusCode
     * @param string $msg
     * @return JsonResponse
     */
    protected function createApiResponse($data, $statusCode = 200, $msg = "ok")
    {
        $message = [];
        $message["message"] = $msg;
        $response['code'] = $statusCode;
        $response['message'] = $message;
        $response['data'] = json_decode($this->serializer($data));
        return new JsonResponse($response, $statusCode);
    }

    public function serializerGroup($data, $format = 'json', $groups)
    {
        return $this->container->get('jms_serializer')
            ->serialize($data, $format, SerializationContext::create()->setGroups(array($groups)));
    }

//    public function deserializerGroup($data, $format = 'json', $groups)
//    {
//        return $this->container->get('jms_serializer')
//            ->deserialize($data, $format, SerializationContext::create()->setGroups(array($groups)));
//    }

    protected function createApiResponseGroup($data, $statusCode = 200, $groups)
    {
        $json = $this->serializerGroup($data, 'json', $groups);
        return new Response($json, $statusCode, array(
            'Content-Type' => 'application/json'
        ));
    }

    public function throwProblem($object, $code, $msgRef, $operator = "==", $val = null)
    {
        if (!$object && $val . ' ' . $operator . ' ' . $object) {
            $apiProblem = new ApiProblem(
                $code,
                $msgRef
            );
            throw new ApiProblemException($apiProblem);
        }
    }

    public function tryDelete($object)
    {
        try {
            $this->em()->remove($object);
            $this->em()->flush();
            return $this->createApiResponse("Suppression effectuée avec succès", 200);
        } catch (DBALException $e) {
            $apiProblem = new ApiProblem(409, ApiProblem::DELETE_ERROR);
            throw new ApiProblemException($apiProblem);
        }
    }


    public function tryPersist($object)
    {
        try {
            $this->em()->persist($object);
            $this->em()->flush();
        } catch (\Throwable $exception) {
            $this->throwProblem(null, $exception->getCode(), $exception->getMessage(), "==", null);
        }
    }

    protected function audit()
    {
        $auditReader = $this->container->get('simplethings_entityaudit.reader');
        return $auditReader;
    }



    public function createJsonResponse($code = 200, $message = "success", $errors = null, $result, $file=null, $ftp = false, $date = null, $marge = null)
    {
        $response = array(
            'ftp' => $ftp,
            'message' => $message,
            'errors' => $errors,
            'file' => $file,
            'result' => $result,
            'date' => $date,
            'marge' => $marge
        );
        return new JsonResponse($response, $code);
    }

    public function returnJsonResponse($code, $message, $errors, $result, $array = NUll)
    {
        $response = array(
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
            'result' => $result
        );
        if (!empty($array))
            foreach ($array as $key => $ligne)
                $response[$key] = $ligne;
        return new JsonResponse($response, $code);

    }

    public function returndate($date)
    {
        $jour = substr($date, 0, 2);
        $mois = substr($date, 2, 2);
        $annee = substr($date, 4, 4);
        $mydate = date("Y-m-d", mktime(0, 0, 0, $mois, $jour, $annee));
        return $mydate;
    }

    public function validatedata($errors)
    {

        $repr = $this->get('jms_serializer')->serialize($errors, 'json');
        return JsonResponse::fromJsonString($repr, 400);

    }

    public function returndatetime($date)
    {
        $jour = substr($date, 0, 2);
        $mois = substr($date, 2, 2);
        $annee = substr($date, 4, 4);
        $mydate = date("Y-m-d  H:i:s", mktime(0, 0, 0, $mois, $jour, $annee));
        return $mydate;
    }


    public function desactiveentity($entity){

        $entity->setDeleted(1);
        $entity->setEnable(false);
        $entity->setDeletedBy($this->getUser()->getID());
        $entity->setDeletedAt(new \datetime("now"));
        $this->em()->persist($entity);
        $this->em()->flush();
    }

}
