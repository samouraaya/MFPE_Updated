<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 04/07/18
 * Time: 01:21 م
 */

namespace Mfpe\CollectDataBundle\Services;

use Mfpe\CollectDataBundle\Controller\AnetiDataController;
use Doctrine\ORM\EntityManager;
use Mfpe\CollectDataBundle\Entity\AnetiTable1;
use Mfpe\CollectDataBundle\Entity\AnetiTable2;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class AnetiService
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function insertAnetiTable2()
    {
        $fileName = "aneti2" . '.' . 'txt';
        $fileNom = "perr_2.txt";
        $fileAnetiFtp = $this->container->getParameter('ftp_path_aneti') . $fileNom;
        $txtFile = $this->container->getParameter('txt_aneti_directory') . $fileName;
        $var = copy($fileAnetiFtp, $txtFile);
        if (file_exists($txtFile)) {
            if (false !== $handle = @fopen($txtFile, 'r')) {
                while (($word = fgets($handle)) !== false) {
                    $value = explode("|", $word);
                    if (count($value) == 14) {
                        $this->CreateAnetiTable2($value);
                        $text = "Table perr_2 created successfully";
                    }

                    $this->container->get('doctrine.orm.entity_manager')->flush();
                }

                fclose($handle);
                unlink($txtFile);
                return $text;
            }
        }
    }

    public function insertAnetiTable1()
    {
        $fileName = "aneti1" . '.' . 'txt';
        $fileNom = "perr_1.txt";
        $fileAnetiFtp = $this->container->getParameter('ftp_path_aneti') . $fileNom;
        $txtFile = $this->container->getParameter('txt_aneti_directory') . $fileName;
        $var = copy($fileAnetiFtp, $txtFile);
        if (file_exists($txtFile)) {
            if (false !== $handle = @fopen($txtFile, 'r')) {
                while (($word = fgets($handle)) !== false) {
                    $value = explode("|", $word);
                    if (count($value) == 13) {
                        $this->CreateAnetiTable1($value);
                        $text = "Table perr_1 created successfully";
                    }

                    $this->container->get('doctrine.orm.entity_manager')->flush();
                }

                fclose($handle);
                unlink($txtFile);
                return $text;
            }
        }
    }


    public function CreateAnetiTable1($value)
    {
        try {
            $aneti = new AnetiTable1();
            $aneti->setAnnee($value[0]);
            $aneti->setMois($value[1]);
            $aneti->setIdGouvernorat($value[2]);
            $aneti->setLibGouvernorat($value[3]);
            $libgouvernorat = $value[3];
            $gouvernorat = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => $libgouvernorat]);
            $aneti->setGouvernorat($gouvernorat);
            $aneti->setIdDelegation($value[4]);
            $libDelegation = $value[5];
            $delegation = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => $libDelegation]);
            $aneti->setDelegation($delegation);
            $aneti->setLibDelegation($libDelegation);
            $aneti->setBureau($value[6]);
            $aneti->setLibBureau($value[7]);
            $aneti->setGenre($value[8]);
            $aneti->setDipSup($value[9]);
            $aneti->setIndicateur($value[10]);
            $aneti->setNombre($value[11]);
            $aneti->setCreatedAt(new \DateTime());
            $aneti->setUpdatedAt(new \DateTime());
            $this->container->get('doctrine.orm.entity_manager')->persist($aneti);
            $this->container->get('doctrine.orm.entity_manager')->flush();
        } catch (\Throwable $e) {
            return $e;
            //echo "Captured Throwable: " . $e->getMessage() . 'status:' . $e->getCode();
            //return new JsonResponse(['status' => "error", 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    public function CreateAnetiTable2($value)
    {
        try {
            $aneti = new AnetiTable2();
            $aneti->setAnnee($value[0]);
            $aneti->setMois($value[1]);
            $aneti->setIdGouvernorat($value[2]);
            $aneti->setLibGouvernorat($value[3]);
            $libgouvernorat = $value[3];
            $gouvernorat = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => $libgouvernorat]);
            $aneti->setGouvernorat($gouvernorat);
            $aneti->setIdDelegation($value[4]);
            $libDelegation = $value[5];
            $delegation = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => $libDelegation]);
            $aneti->setDelegation($delegation);
            $aneti->setLibDelegation($libDelegation);
            $aneti->setBureau($value[6]);
            $aneti->setLibBureau($value[7]);
            $aneti->setIdSector($value[8]);
            $aneti->setLibSector($value[9]);
            $libSecteur = $value[9];
            $secteur = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(['intituleFr' => $libSecteur]);
            $aneti->setSector($secteur);
            $aneti->setTaille($value[10]);
            $aneti->setLibTaille($value[11]);
            $aneti->setNombre($value[12]);
            $aneti->setCreatedAt(new \DateTime());
            $aneti->setUpdatedAt(new \DateTime());
            $this->container->get('doctrine.orm.entity_manager')->persist($aneti);
            $this->container->get('doctrine.orm.entity_manager')->flush();
        } catch (\Throwable $e) {
            return $e;
            //echo "Captured Throwable: " . $e->getMessage() . 'status:' . $e->getCode();
            //return new JsonResponse(['status' => "error", 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

}
