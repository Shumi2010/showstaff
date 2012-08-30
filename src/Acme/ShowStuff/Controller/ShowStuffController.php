<?php
// Контроллер на index.php - стартовую страницу

namespace Acme\ShowStuff\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ShowStuffController extends Controller
{
      public function indexAction()
      {

         return $this->render('AcmeShowStuff::index.html.twig', array('title_name'=>'Start List Name', 'txt'=>'Start List Text'));
      }

}


?>
