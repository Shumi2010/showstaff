<?php
// Контроллер на adminboard.php - администраторскую страницу

namespace Acme\ShowStuff\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\ShowStuff\Form\EditBoardForm;
use Acme\ShowStuff\Form\AddBoardForm;
use Acme\ShowStuff\Entity\Companies;


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
         // Выводим форму для редактирования компании
         $repository = $this->getDoctrine()->getRepository('AcmeShowStuff:Companies');
         $em = $this->getDoctrine()->getEntityManager();
         $compan = $repository->find($num);

         $form = $this->createForm(new EditBoardForm(), $compan);
         $request = $this -> getRequest();
          
         return $this->render('AcmeShowStuff:AdminBoard:adminboardedit.html.twig', array('title_name'=>'AdminBoard Redactor', 'txt'=>'Page Text Edit', 'companies'=>$compan, 'form'=>$form->createView()));
      }

      public function editforceAction($num)
      {
        // функция, которая делает update компании и выходит обратно в adminboard
        $compan = new Companies();
        //$compan2 = new Companies();
         $request = $this->getRequest();

        $form = $this->createForm(new EditBoardForm(), $compan);

        $form->bindRequest($request);
        $compan = $form -> getData();

        $em = $this->getDoctrine()->getEntityManager();
        $compan2 = $em-> getRepository( 'AcmeShowStuff:Companies') ->find($num);
        $compan2->setName($compan->getName());
        $compan2->setShortName($compan->getShortName());
        $compan2->setInn($compan->getInn());
        $compan2->setAdminName($compan->getAdminName()); 
        $em->flush();
 
        return $this -> redirect ($this ->generateUrl ( "adminboard" ));

      } 

      public function deletecompanyAction($num_id)
      {
        // функция удаления компании из БД
        $compan = new Companies();
        $em = $this->getDoctrine()->getEntityManager();
        $compan = $em-> getRepository( 'AcmeShowStuff:Companies') ->find($num_id);

        $em->remove($compan); 
        $em->flush();

        return $this -> redirect ($this ->generateUrl ( 'adminboard' ));
      }

      public function addcompanyAction()
      {
      // функция добавления компании - просто открываем страницу-форму для добавления компании
         $repository = $this->getDoctrine()->getRepository('AcmeShowStuff:Companies');
         $em = $this->getDoctrine()->getEntityManager();
         $compan = $repository->find('0');

         $form = $this->createForm(new AddBoardForm(), $compan);
         $request = $this -> getRequest();

         return $this->render('AcmeShowStuff:AdminBoard:adminboardadd.html.twig', array('form' => $form->createView()));

      }

      public function createcompanyAction(Request $request)
      {
        // Функция добавления компании в БД
        
        $compan = new Companies();

        $form = $this->createForm(new AddBoardForm(), $compan);

        $form->bindRequest($request);
        $compan = $form -> getData();

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($compan);
        $em->flush();
 
        return $this -> redirect ($this ->generateUrl ( 'adminboard' ));
      }
     
}


?>

