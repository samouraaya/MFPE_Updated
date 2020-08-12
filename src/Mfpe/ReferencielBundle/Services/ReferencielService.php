<?php


namespace Mfpe\ReferencielBundle\Services;


use Doctrine\ORM\EntityManager;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;


class ReferencielService
{
    private static $referenceService;

    /**
     * @return ReferencielService
     */
    public static function getInstance()
    {
        if (!ReferencielService::$referenceService)
            ReferencielService::$referenceService = new ReferencielService();
        return ReferencielService::$referenceService;
    }

    public function getAllReferenciel(EntityManager $em, $param)
    {
        if (isset($param) && !empty($param)) {
            $referenciels = $em->getRepository('MfpeReferencielBundle:Referenciel')->findAll($param);
        } else {
            $referenciels = $em->getRepository('MfpeReferencielBundle:Referenciel')->findByEnable(true);

        }

        $categories = Referenciel::getReferencielCategories();
        $response = array();
        $response['categories'] = $categories;
        $response['referenciels'] = array();
//        foreach($categories as $categorie){
//            $array = [];
//            $className = "Mfpe\ReferencielBundle\Entity"."\\".$categorie;
//            $metadata = $em->getClassMetadata($className);
//            $nameMetadata = $metadata->fieldMappings;
//            foreach($nameMetadata as $key =>$value){
//                if($key!="createdAt" and $key!="createdBy" and $key!="updatedAt" and $key!="updatedBy" and $key!="deletedAt" and $key!="deletedBy")
//                $array[$key] = $key;
//            }
//            $response['fields'][$categorie] = $array;
//        }
        foreach ($referenciels as $referenciel) {

            $referenciel->categorie = basename(get_class($referenciel));
            if (!array_key_exists($referenciel->categorie, $response['referenciels']))
                $response['referenciels'][$referenciel->categorie] = array();
            //  $index = $referenciel->categorie;
            array_push($response['referenciels'][$referenciel->categorie], $referenciel);
        }
        return $response;
    }

    public function getReferencielbycategorie(EntityManager $em, $categorie, $data)
    {
        $categories = Referenciel::getReferencielCategories();

        if (!in_array($categorie, $categories->toArray())) {
            $apiProblem = new ApiProblem(
                404,
                ApiProblem::CATEGORIE_NOT_EXIST
            );
            throw new ApiProblemException($apiProblem);
        }
        $entityname = "MfpeReferencielBundle:" . $categorie;

        if ($categorie === "RefSecteur") {

            if (isset($data['typeSecteur']) && !empty($data['typeSecteur'])) {
                $testFormation = $data['typeSecteur'] === 'true' ? true : false;
                $referenciels = $em->getRepository($entityname)->findByTypeSecteur($testFormation);
            } elseif (!isset($data['typeSecteur']) && empty($data['typeSecteur'])) {
                $referenciels = $em->getRepository($entityname)->findByTypeSecteur(true);
            }
        }
        else
            $referenciels = $em->getRepository($entityname)->findAll();
        return $referenciels;
    }


    public function getRefastronomiegouvernorat(EntityManager $em, $lang)
    {


        $categories = Referenciel::getReferencielCategories($lang);

        $referenciels = $em->getRepository('MfpeReferencielBundle:Referenciel')->OrderRefastronomiegouvernorat($lang);

        return $referenciels;

    }


}