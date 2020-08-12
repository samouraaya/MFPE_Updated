<?php

namespace Mfpe\AttestationBundle\Services;

use Doctrine\ORM\EntityManager;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Entity\Demande;
use Symfony\Bundle\FrameworkBundle\Controller;
use \DateTime;
use PhpOffice\PhpWord\PhpWord;

class DocService extends \PhpOffice\PhpWord\PhpWord
{
    private $em = null;
    private $tmp;
    private $container;

    public function __construct(EntityManager $em, $templating, $tmp, Container $container)
    { //Son constructeur avec l'entity manager en paramètre
        $this->em = $em;
        $this->tmp = $tmp;
        $this->templating = $templating;
        $this->container = $container;
    }

    public function returnPDFResponseFromHTMLvig($dir, $lang, $demande)
    {
        $html = $this->templating->render('Demande/pdf1.html.twig', ["demande" => $demande, "lang" => $lang]);
        $html1 = $this->templating->render('Demande/pdf2.html.twig', ["demande" => $demande, "lang" => $lang]);
        $pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setFontSubsetting(true);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        // Font Arabe
        $pdf->SetFont('dejavusans', '', 13);
        $pdf->AddPage('R', 'A4');
        $date = new DateTime();
        $fileurl = "/uploads/" . $date->getTimestamp() . "_" . $lang . ".pdf";
        $filename = $dir . "/uploads/" . $date->getTimestamp() . "_" . $lang . ".pdf";
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '150', $y = '13.5', '<p>' . $date->format('Y/d/m') . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        if ($demande->getGouvernorat()) {
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '76', $y = '22.1', '<p>' . $demande->getGouvernorat()->getIntituleAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '48', '<h2 style="letter-spacing: 11px;">' . $demande->getCode() . '</h2>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '73.5', '<p>' . $demande->getUser()->getPrenomFr() . " " . $demande->getUser()->getNomFr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        if ($demande->getUser()) {
            if ($demande->getUser()->getDateNaissance()) {
                $dateNaissance = $demande->getUser()->getDateNaissance();
                $result1 = $dateNaissance->format('Y/d/m');
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '120', $y = '84.5', '<p>' . $demande->getUser()->getlieuNaissance() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '84.5', '<p>'  . $result1 . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

            }
            if ($demande->getUser()->getNumCin()) {
                if ($demande->getUser()->getDateDelivranceCin()) {
                    $dateDelivranceCin = $demande->getUser()->getDateDelivranceCin();
                    $result2 = $dateDelivranceCin->format('Y/d/m');
                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '100', $y = '96', '<p  style="letter-spacing: 7px;">' . $demande->getUser()->getNumCin() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '160', $y = '96', '<p>' . $result2 . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
                }

            } else if ($demande->getUser()->getNumCarteSejour()) {
                if ($demande->getUser()->getDateDelivrancePassport()) {
                    $dateDelivrancePassport = $demande->getUser()->getDateDelivrancePassport();
                    $result3 = $dateDelivrancePassport->format('Y/d/m');
                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '100', $y = '96', '<p  style="letter-spacing: 7px;">' . $demande->getUser()->getNumCarteSejour() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '160', $y = '96', '<p>' . $result3 . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
                }
            }
            if ($demande->getAdresseResidenceActuelle()) {
                $pdf->writeHTMLCell($w = 79, $h = 0, $x = '65', $y = '108', '<p>' . $demande->getAdresseResidenceActuelle() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            }
            if ($demande->getUser()->getTel()) {
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '160', $y = '108', '<p>' . $demande->getUser()->getTel() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

            }
            if ($demande->getNomEmployeur()) {
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '118', '<p>' . $demande->getNomEmployeur() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

            }
            if ($demande->getAdresseEntreprise()) {
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '129', '<p>' . $demande->getAdresseEntreprise() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

            }
            if ($demande->getSpecialiteCitoyen()) {
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '60', $y = '172', '<p>' . $demande->getSpecialiteCitoyen() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            }
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html1, $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            $pdf->Output($filename, 'F'); // Force Générate PDF
            $servername = $_SERVER['HTTP_HOST'];
            return $servername . $fileurl;
        }
    }

    public function returnConvocationPDFResponseFromHTML($dir, $lang, $demande, $dateExamen)
    {
        $html = $this->templating->render('Demande/convocation.html.twig', ["demande" => $demande, "lang" => $lang]);
        $pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setFontSubsetting(true);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        // Font Arabe
        $pdf->SetFont('dejavusans', '', 12);

        $pdf->AddPage('R', 'A4');
        $date = new DateTime();
        $fileurl = "/uploads/" . $date->getTimestamp() . "_" . $lang . ".pdf";
        $filename = $dir . "/uploads/" . $date->getTimestamp() . "_" . $lang . ".pdf";
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $date = $date->format('d-m-Y');
        $date = $this->container->get("mfpe_configbundle.services.convert_date")->convertDate($date, "ar");
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '155', $y = '31', '<p>' . $date . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        if ($demande->getCentreFormation()) {
            $pdf->SetFont('dejavusans', '', 10);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '50', $y = '32.1', '<p>' . $demande->getCentreFormation()->getIntituleAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }
        if ($demande->getCentreFormation()) {
            $pdf->SetFont('dejavusans', '', 12);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '113', $y = '64.1', '<p>' . $demande->getCentreFormation()->getIntituleAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }

        if ($demande->getUser()->getNomAr()) {
            $pdf->SetFont('dejavusans', '', 13);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '72.3', '<p>' . $demande->getUser()->getNomAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }
        if ($demande->getUser()->getPrenomAr()) {
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '95', $y = '72.3', '<p>' . $demande->getUser()->getPrenomAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }
        if ($demande->getUser()->getNumCin()) {
            $pdf->SetFont('dejavusans', '', 12);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '95', $y = '80.2', '<p>' . $demande->getUser()->getNumCin() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }

        if ($demande->getUser()->getDateDelivranceCin()) {
            $pdf->SetFont('dejavusans', '', 12);
            $dateDelivranceCin = $demande->getUser()->getDateDelivranceCin();
            $result2 = $dateDelivranceCin->format('d-m-Y');
            $date = $this->container->get("mfpe_configbundle.services.convert_date")->convertDate($result2, "ar");
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '145', $y = '80.2', '<p>' . $date . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }
        if ($demande->getCentreFormation()) {
            $pdf->SetFont('dejavusans', '', 11);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '145', $y = '149.5', '<p>' . $demande->getCentreFormation()->getIntituleAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '157', $y = '222.5', '<p>' . $demande->getCentreFormation()->getIntituleAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '42.5', $y = '47.2', '<p>' . $demande->getCodeConvocation() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        }


        if ($dateExamen) {
            $dateExamen1 = $dateExamen->getDateExam();
            $resulat = $dateExamen1->format('d-m-Y');
            $date = $this->container->get("mfpe_configbundle.services.convert_date")->convertDate($resulat, "ar");
            $pdf->SetFont('dejavusans', '', 11);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '60', $y = '161.7', '<p>' . $date . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '135', $y = '161.7', '<p>' . $dateExamen1->format('H:i') . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        }
        if ($demande->getSpecialite()) {
            $pdf->SetFont('dejavusans', '', 11);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '100', $y = '174.5', '<p>' . $demande->getSpecialite()->getIntituleAr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }
        if ($dateExamen) {

            $material = $dateExamen->getMaterial();
            $pdf->SetFont('dejavusans', '', 11);
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '70', $y = '187', '<p>' . $material . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        }
//        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '48', '<h2 style="letter-spacing: 11px;">' . $demande->getCode() . '</h2>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '73.5', '<p>' . $demande->getUser()->getPrenomFr() . " " . $demande->getUser()->getNomFr() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//
//        if ($demande->getUser()) {
//            if ($demande->getUser()->getDateNaissance()) {
//                $dateNaissance = $demande->getUser()->getDateNaissance();
//                $result1 = $dateNaissance->format('d-m-Y');
//                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '84.5', '<p>' . $result1 . " " . $demande->getUser()->getlieuNaissance() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//            }
//
//            if ($demande->getUser()->getNumCin()) {
//                if ($demande->getUser()->getDateDelivranceCin()) {
//                    $dateDelivranceCin = $demande->getUser()->getDateDelivranceCin();
//                    $result2 = $dateDelivranceCin->format('d-m-Y');
//                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '100', $y = '96', '<p  style="letter-spacing: 7px;">' . $demande->getUser()->getNumCin() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '160', $y = '96', '<p>' . $result2 . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//                }
//
//            } else if ($demande->getUser()->getNumCarteSejour()) {
//                if ($demande->getUser()->getDateDelivrancePassport()) {
//                    $dateDelivrancePassport = $demande->getUser()->getDateDelivrancePassport();
//                    $result3 = $dateDelivrancePassport->format('d-m-Y');
//                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '100', $y = '96', '<p  style="letter-spacing: 7px;">' . $demande->getUser()->getNumCarteSejour() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//                    $pdf->writeHTMLCell($w = 0, $h = 0, $x = '160', $y = '96', '<p>' . $result3 . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//                }
//            }
//            if ($demande->getAdresseResidenceActuelle()) {
//                $pdf->writeHTMLCell($w = 79, $h = 0, $x = '65', $y = '108', '<p>' . $demande->getAdresseResidenceActuelle() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//            }
//            if ($demande->getUser()->getTel()) {
//                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '160', $y = '108', '<p>' . $demande->getUser()->getTel() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//
//            }
//            if ($demande->getNomEmployeur()) {
//                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '118', '<p>' . $demande->getNomEmployeur() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//
//            }
//            if ($demande->getAdresseEntreprise()) {
//                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '80', $y = '129', '<p>' . $demande->getAdresseEntreprise() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//
//            }
//
//            if ($demande->getSpecialiteCitoyen()) {
//                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '60', $y = '172', '<p>' . $demande->getSpecialiteCitoyen() . '</p>', $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
//            }


        $pdf->Output($filename, 'F'); // Force Générate PDF
        $servername = $_SERVER['HTTP_HOST'];

        return $servername . $fileurl;
    }


//        $html = $this->templating->render('Demande/convocation.html.twig', ["demande" => $demande, "lang" => $lang, "dateExamen" => $dateExamen]);
//        $pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//        $pdf->setFontSubsetting(true);
//        $lg = Array();
//        $lg['a_meta_charset'] = 'UTF-8';
//        if ($lang == "fr" || $lang == "en")
//            $lg['a_meta_dir'] = 'ltr';
//        else
//            $lg['a_meta_dir'] = 'rtl';
//
//        $lg['a_meta_language'] = 'fa';
//        $lg['w_page'] = 'page';
//        $pdf->setLanguageArray($lg);
//        // Font Arabe
//        $pdf->SetFont('dejavusans', '', 12);
//        $pdf->AddPage('R', 'A4');
//        $date = new DateTime();
//        $fileurl = "/uploads/" . $date->getTimestamp() . "_" . $lang . ".pdf";
//        $filename = $dir . "/uploads/" . $date->getTimestamp() . "_" . $lang . ".pdf";
//        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 4, $fill = 0,  $reseth = true, $align = '', $autopadding = true);
//        $pdf->Output($filename, 'F'); // Force Générate PDF
//        $servername = $_SERVER['HTTP_HOST'];
//        return $servername . $fileurl;

//    }


    public function returnRefusCentreFormationPDFResponseFromHTMLvig($dir, $lang, $demande)
    {
        $html = $this->templating->render('Demande/refus_demande_centre_formation.html.twig', ["demande" => $demande, "lang" => $lang]);

        $pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setFontSubsetting(true);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        // Font Arabe
        $pdf->SetFont('dejavusans', '', 13);

        $pdf->AddPage('R', 'A4');
        $date = new DateTime();

//        //$pdf->addImage($path);
//        //$pdf->addImage($path, array('width'=>459, 'height'=>174, 'align'=>'left'));
        $fileurl = "/uploads/refus_demande/" . $date->getTimestamp() . "_" . $lang . ".pdf";
        $filename = $dir . "/uploads/refus_demande/" . $date->getTimestamp() . "_" . $lang . ".pdf";
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '90', $y = '47', $demande->getCentreFormation()->getGouvernorat()->getIntituleAr(), $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $date = $dt = new DateTime();
        $dateNow = $date->format('Y-m-d');
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '151', $y = '47', $dateNow, $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '132', $y = '70', $demande->getGouvernorat()->getIntituleAr(), $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '91', $y = '78', $demande->getUser()->getNomAr(), $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '108', $y = '117', $demande->getCode(), $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $createdAt = $demande->getCreatedAt();
        $createdAt = $createdAt->format('Y/m/d');
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '146', $y = '117', $createdAt, $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '50', $y = '129', $demande->getSpecialiteCitoyen(), $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '33', $y = '163', substr($demande->getSpecialiteCitoyen(), 0, 25), $border = 0, $ln = 4, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $pdf->Output($filename, 'F'); // Force Générate PDF
        $servername = $_SERVER['HTTP_HOST'];

        return $servername . $fileurl;
    }
}
