<?php

namespace Mfpe\CollectDataBundle\Repository;

/**
 * AnetiTable1Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnetiTable1Repository extends \Doctrine\ORM\EntityRepository
{
    public function findDataEmploiByFiltre($data)
    {
        $query = $this->createQueryBuilder('AnetiTable1');
        $query->select("AnetiTable1");
        if (isset($data["governorate"]) && !empty($data["governorate"])) {

            $governorat = trim(($data["governorate"]));
            $query->leftJoin('AnetiTable1.gouvernorat', 'gouvernorat');
            $query
                ->where('gouvernorat.id = :gouvernate')
                //      ->orWhere('gouvernorat.code = :gouvernate')
                ->setParameter('gouvernate', $governorat);
        }
        if (isset($data["delegation"]) && !empty($data["delegation"])) {
            $delegation = trim(($data["delegation"]));
            $query->leftJoin('AnetiTable1.delegation', 'delegation');
            $query
                ->andwhere('delegation.id = :delegation')
                ->setParameter('delegation', $delegation);
        }
        if (isset($data["bureau_emploi"]) && !empty($data["bureau_emploi"])) {
            $bureauEmploi = strtoupper($data["bureau_emploi"]);
            $query
                ->andWhere('UPPER(AnetiTable1.libBureau) LIKE :bureau')
                ->setParameter('bureau', "{$bureauEmploi}%");

        }
        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])) {
            $du = date("Y-m-d H:i:s", strtotime($data["from"]));
            $au = date("Y-m-d H:i:s", strtotime($data["to"]));
            $query->andWhere('AnetiTable1.dateAneti BETWEEN :du AND :au')

                ->setParameter('du', $du)
                ->setParameter('au', $au);
        }
        return $query->getQuery()->getResult();
    }

    public function findDataEmploiByFiltreP2($data)
    {
        $query = $this->createQueryBuilder('AnetiTable1');
        $query->select("AnetiTable1");
        if (isset($data["governorate"]) && !empty($data["governorate"])) {

            $governorat = trim(($data["governorate"]));
            $query->leftJoin('AnetiTable1.gouvernorat', 'gouvernorat');
            $query
                ->where('gouvernorat.id = :gouvernate')
                //      ->orWhere('gouvernorat.code = :gouvernate')
                ->setParameter('gouvernate', $governorat);
        }
        if (isset($data["delegation"]) && !empty($data["delegation"])) {
            $delegation = trim(($data["delegation"]));
            $query->leftJoin('AnetiTable1.delegation', 'delegation');
            $query
                ->andwhere('delegation.id = :delegation')
                ->setParameter('delegation', $delegation);
        }
        if (isset($data["bureau_emploi"]) && !empty($data["bureau_emploi"])) {
            $bureauEmploi = strtoupper($data["bureau_emploi"]);
            $query
                ->andWhere('UPPER(AnetiTable1.libBureau) LIKE :bureau')
                ->setParameter('bureau', "%{$bureauEmploi}%");

        }

        if (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"]))
        {
            $du = date("Y-m-d H:i:s", strtotime($data["fromSecondary"]));
            $au = date("Y-m-d H:i:s", strtotime($data["toSecondary"]));
            $query->andWhere("AnetiTable1.dateAneti > :du")
                ->andWhere("AnetiTable1.dateAneti < :au")
                ->setParameter('du', $du)
                ->setParameter('au', $au);
        }
        return $query->getQuery()->getResult();
    }

    public function getNationalDataEmploiP2($data)
    {
        $query = $this->createQueryBuilder('AnetiTable1');
        $query->select("AnetiTable1");
        if (isset($data["bureau_emploi"]) && !empty($data["bureau_emploi"])) {
            $bureauEmploi = strtoupper($data["bureau_emploi"]);

            $query
                ->andWhere('UPPER(AnetiTable1.libBureau) LIKE :bureau')
                ->setParameter('bureau', "%{$bureauEmploi}%");

        }
        if (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $du = date("Y-m-d H:i:s", strtotime($data["fromSecondary"]));
            $au = date("Y-m-d H:i:s", strtotime($data["toSecondary"]));
            $query->andWhere("AnetiTable1.dateAneti > :du")
                ->andWhere("AnetiTable1.dateAneti < :au")
                ->setParameter('du', $du)
                ->setParameter('au', $au);
        }
        return $query->getQuery()->getResult();
    }

    public function findTotalDataEmploiByFiltre($data)
    {
        $listIndicateur = ['SIVP NOUV', 'SIVP INSER', 'SIVP EN COUR', 'CIVP NOUV', 'CIVP inser', 'CIVP en cour', 'SCV Nouv', 'SCV inser',
            'SCV en cour', 'CAIP Nouv', 'CAIP inser', 'CAIP en cour', 'CIDES Nouv', 'CIDES inser', 'CIDES en cour', 'CRVA Nouv', 'CRVA inser',
            'CRVA en cour', 'Forsati Nouv', 'Forsati en cour', 'Forsati acheves', 'KARAMA Nouv', 'KARAMA en cour', 'KARAMA acheves', 'KARAMA inser',
            'ME etudies', 'ME finances', 'ME BA', 'ME Visite', 'Action ME SI', 'Action ME CEFE', 'Action ME CREE', 'Action ME Morraine'
        ];
        $query = $this->createQueryBuilder('AnetiTable1');
        $query->select('count(AnetiTable1) as totalBenefitsProgram');
        $query->where('AnetiTable1.indicateur IN (:listIndicateur)')
            ->setParameter('listIndicateur', $listIndicateur);

        if (isset($data["gouvernorat"]) && !empty($data["gouvernorat"])) {

            $governorat = trim($data["gouvernorat"]);
            $query->leftJoin('AnetiTable1.gouvernorat', 'gouvernorat');
            $query
                ->andwhere('gouvernorat.code = :gouvernate')
                //      ->orWhere('gouvernorat.code = :gouvernate')
                ->setParameter('gouvernate', $governorat);
        }
        if (isset($data["annee"]) && !empty($data["annee"])) {
            $query->andWhere('AnetiTable1.annee = :year')
                ->setParameter('year', $data["annee"]);
        }
        return $query->getQuery()->getOneOrNullResult();
    }

    public function findTotalOffreEmploiByFiltre($data)
    {
        $listIndicateur = ['Nouvelles offres', 'Offres en cours'];
        $query = $this->createQueryBuilder('AnetiTable1');
        $query->select('count(AnetiTable1) as totalJobOffer');
        $query->where('AnetiTable1.indicateur IN (:listIndicateur)')
            ->setParameter('listIndicateur', $listIndicateur);

        if (isset($data["gouvernorat"]) && !empty($data["gouvernorat"])) {

            $governorat = trim($data["gouvernorat"]);
            $query->leftJoin('AnetiTable1.gouvernorat', 'gouvernorat');
            $query
                ->andwhere('gouvernorat.code = :gouvernate')
                //      ->orWhere('gouvernorat.code = :gouvernate')
                ->setParameter('gouvernate', $governorat);
        }
        if (isset($data["annee"]) && !empty($data["annee"])) {
            $query->andWhere('AnetiTable1.annee = :year')
                ->setParameter('year', $data["annee"]);
        }
        return $query->getQuery()->getOneOrNullResult();
    }

    public function findTotalDemandeEmploiByFiltre($data)
    {
        $listIndicateur = ['NI', 'RI'];
        $query = $this->createQueryBuilder('AnetiTable1');
        $query->select('count(AnetiTable1) as totalJobApplication');
        $query->where('AnetiTable1.indicateur IN (:listIndicateur)')
            ->setParameter('listIndicateur', $listIndicateur);

        if (isset($data["gouvernorat"]) && !empty($data["gouvernorat"])) {

            $governorat = trim($data["gouvernorat"]);
            $query->leftJoin('AnetiTable1.gouvernorat', 'gouvernorat');
            $query
                ->andwhere('gouvernorat.code = :gouvernate')
                //      ->orWhere('gouvernorat.code = :gouvernate')
                ->setParameter('gouvernate', $governorat);
        }
        if (isset($data["annee"]) && !empty($data["annee"])) {
            $query->andWhere('AnetiTable1.annee = :year')
                ->setParameter('year', $data["annee"]);
        }
        return $query->getQuery()->getOneOrNullResult();
    }
}