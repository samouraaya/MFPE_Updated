<?php
/**
 * Created by PhpStorm.
 * User: Nagui
 * Date: 23/02/2018
 * Time: 01:31
 */

namespace Mfpe\ConfigBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use Mfpe\ConfigBundle\Entity as Entity;

class ListServices
{
    /**
     * @var EntityManagerInterface em
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
