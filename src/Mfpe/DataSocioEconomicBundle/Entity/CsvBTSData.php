<?php

namespace Mfpe\DataSocioEconomicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Mfpe\ConfigBundle\Entity\AbstractEntity;
use Mfpe\CollectDataBundle\Entity\UniteRegionale;

/**
 * CsvSocioEconomicData
 *
 * @ORM\Table(name="csv_bts_data")
 * @ORM\Entity(repositoryClass="Mfpe\DataSocioEconomicBundle\Repository\CsvBTSDataRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class CsvBTSData
{

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false, options={"default"="NULL"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $libelle;
    /**
     * @var string
     *
     * @ORM\Column(name="gouvernorat", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $gouvernorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSecteur")
     * @ORM\JoinColumn(name="secteur", referencedColumnName="id", nullable=true)
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $secteur;

    /**
     * @var bigint
     *
     * @ORM\Column(name="nb_cred", type="bigint", nullable=false, options={"default"="0"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $nbCred;

    /**
     * @var float
     *
     * @ORM\Column(name="mt_cred", type="float", nullable=false, options={"default"="0"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $mtCred;

    /**
     * @var float
     *
     * @ORM\Column(name="cout_total_invs", type="float",  nullable=false, options={"default"="0"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $coutTotalInvs;

    /**
     * @var bigint
     *
     * @ORM\Column(name="nb_emploi_creer", type="bigint", nullable=false, options={"default"="0"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $nbEmploiCreer;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_file", type="integer", nullable=false, options={"default"="0"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $typeFile;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="governorat_id", referencedColumnName="id", nullable=true)
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $governoratId;
    /**
     * @var int|null
     *
     * @ORM\Column(name="annee", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $annee;
    

    /**
     * @var int|null
     *
     * @ORM\Column(name="mois", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $mois;

    /**
     * @var string|null
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
     * @Serializer\Groups({"detailsBTS"})
     * @Serializer\Expose()
     */
    private $fileName;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_id", type="integer", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $fileId;
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return CsvBTSData
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set nbCred.
     *
     * @param int $nbCred
     *
     * @return CsvBTSData
     */
    public function setNbCred($nbCred)
    {
        $this->nbCred = $nbCred;

        return $this;
    }

    /**
     * Get nbCred.
     *
     * @return int
     */
    public function getNbCred()
    {
        return $this->nbCred;
    }

    /**
     * Set mtCred.
     *
     * @param float $mtCred
     *
     * @return CsvBTSData
     */
    public function setMtCred($mtCred)
    {
        $this->mtCred = $mtCred;

        return $this;
    }

    /**
     * Get mtCred.
     *
     * @return float
     */
    public function getMtCred()
    {
        return $this->mtCred;
    }

    /**
     * Set coutTotalInvs.
     *
     * @param float $coutTotalInvs
     *
     * @return CsvBTSData
     */
    public function setCoutTotalInvs($coutTotalInvs)
    {
        $this->coutTotalInvs = $coutTotalInvs;

        return $this;
    }

    /**
     * Get coutTotalInvs.
     *
     * @return float
     */
    public function getCoutTotalInvs()
    {
        return $this->coutTotalInvs;
    }

    /**
     * Set nbEmploiCreer.
     *
     * @param int $nbEmploiCreer
     *
     * @return CsvBTSData
     */
    public function setNbEmploiCreer($nbEmploiCreer)
    {
        $this->nbEmploiCreer = $nbEmploiCreer;

        return $this;
    }

    /**
     * Get nbEmploiCreer.
     *
     * @return int
     */
    public function getNbEmploiCreer()
    {
        return $this->nbEmploiCreer;
    }

    /**
     * Set typeFile.
     *
     * @param int $typeFile
     *
     * @return CsvBTSData
     */
    public function setTypeFile($typeFile)
    {
        $this->typeFile = $typeFile;

        return $this;
    }

    /**
     * Get typeFile.
     *
     * @return int
     */
    public function getTypeFile()
    {
        return $this->typeFile;
    }

    /**
     * Set secteur.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSecteur|null $secteur
     *
     * @return CsvBTSData
     */
    public function setSecteur(\Mfpe\ReferencielBundle\Entity\RefSecteur $secteur = null)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSecteur|null
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set gouvernorat.
     *
     * @param string|null $gouvernorat
     *
     * @return CsvBTSData
     */
    public function setGouvernorat($gouvernorat = null)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat.
     *
     * @return string|null
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set annee.
     *
     * @param int|null $annee
     *
     * @return CsvBTSData
     */
    public function setAnnee($annee = null)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee.
     *
     * @return int|null
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set mois.
     *
     * @param int|null $mois
     *
     * @return CsvBTSData
     */
    public function setMois($mois = null)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois.
     *
     * @return int|null
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set governoratId.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $governoratId
     *
     * @return CsvBTSData
     */
    public function setGovernoratId(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $governoratId = null)
    {
        $this->governoratId = $governoratId;

        return $this;
    }

    /**
     * Get governoratId.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGovernoratId()
    {
        return $this->governoratId;
    }

    /**
     * Set fileName.
     *
     * @param string|null $fileName
     *
     * @return CsvBTSData
     */
    public function setFileName($fileName = null)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName.
     *
     * @return string|null
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set fileId.
     *
     * @param int $fileId
     *
     * @return CsvBTSData
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;

        return $this;
    }

    /**
     * Get fileId.
     *
     * @return int
     */
    public function getFileId()
    {
        return $this->fileId;
    }
    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return CsvBTSData
     */
    public function setEnable($enable = null)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable.
     *
     * @return bool|null
     */
    public function getEnable()
    {
        return $this->enable;
    }


}
