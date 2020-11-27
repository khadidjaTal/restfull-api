<?php

namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use  App\Entity\Invitation;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/*invitations controller.
*@Route("/invitations",name="api_")
*/
class InvitationController extends AbstractFOSRestController
{
    /**
     * @Route("/", name="invitation")
     */
    public function index(): Response
    {
        return $this->render('invitation/index.html.twig', [
            'controller_name' => 'InvitationController',
        ]);
    }
     /**
     * @Route("/test", name="home")
     */
    public function getInvitationRecieved(){
        return new response('hello');
    }

    /**list of invitation sent.
    *@Route("/sent", name="sent")
    *@Rest\Get(path="/invitations/sent")
    *@return Response
    */
    public function getMovieAction(){

        $repository=$this->getDoctrine()->getRepository(Invitation::class);
        $sent=$repository->findall();
        return $this->handleView($this->view($sent));
        }
   /**
   *@Rest\Get(path="/new")
   *@Rest\View()
   **/
   public function test(): View  {
         $repository=$this->getDoctrine()->getRepository(Invitation::class);
        $sent=$repository->findall();
        return $this->view($sent);
          //return View::create($sent, Response::HTTP_OK);
         //return new JsonResponse($sent);
        //return $this->handleView($this->view($sent));
   }     
}


