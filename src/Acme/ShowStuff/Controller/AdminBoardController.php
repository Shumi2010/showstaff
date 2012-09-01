<?php
// Контроллер на adminboard.php - администраторскую страницу

namespace Acme\ShowStuff\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\ShowStuff\Form\EditBoardForm;


class AdminBoardController extends Controller
{
      public function indexAction()
      {

         $repository = $this->getDoctrine()->getRepository('AcmeShowStuff:Companies');
         $em = $this->getDoctrine()->getEntityManager();
         $compan = $repository->findAll();
         //$compan = $repository->find('0');
         //$query = $em->createQuery('SELECT shortName FROM AcmeShowStuff:Companies');
         //$compan = $query->getResult();  

         return $this->render('AcmeShowStuff:AdminBoard:adminboard.html.twig', array('title_name'=>'Page Title', 'txt'=>'Page Text', 'companies'=>$compan));
      }

      public function editAction($num)
      {
         $repository = $this->getDoctrine()->getRepository('AcmeShowStuff:Companies');
         $em = $this->getDoctrine()->getEntityManager();
         $compan = $repository->find($num);

         $form = $this->createForm(new EditBoardForm(), $compan);
         $request = $this -> getRequest();
          
         return $this->render('AcmeShowStuff:AdminBoard:adminboardedit.html.twig', array('title_name'=>'AdminBoard Redactor', 'txt'=>'Page Text Edit', 'companies'=>$compan, 'form'=>$form->createView()));
      }
     
}


?>

