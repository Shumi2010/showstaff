<?php
// Контроллер на adminboard.php - администраторскую страницу

namespace Acme\ShowStuff\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminBoardController extends Controller
{
      public function indexAction()
      {

         return $this->render('AcmeShowStuff:AdminBoard:adminboard.html.twig', array('title_name'=>'Start List Name', 'txt'=>'Start List Text'));
      }

}


?>

