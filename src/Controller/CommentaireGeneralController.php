<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use App\Repository\FilDeDiscussionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentaireGeneralRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireGeneralController extends AbstractController
{
    /**
     * @Route(
     *     path="/api/users/promo/{idp}/apprenant/{ida}/chats",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\CommentaireGeneralController::envoyerCommentaire",
     *          "__api_resource_class"=CommentaireGeneral::class,
     *          "__api_collection_operation_name"="add_commentaire"
     *     }
     * )
    */
    public function envoyerCommentaire(int $idp,int $ida,Request $request,PromoRepository $promo_repo,FilDeDiscussionRepository $filDeDiscussion_repo,ApprenantRepository $apprenant_repo,SerializerInterface $serializer)
    {
        $promo=null;

        if(!$promo = $promo_repo->find($idp))
        { 
            return $this->json("Attention verifiez l'id:$idp de la promotion!!!", Response::HTTP_NOT_FOUND);
        }

        if(! $apprenant=$apprenant_repo->find($ida))
        { 
            return $this->json("Attention verifiez l'id:$ida de lapprenant!!", Response::HTTP_NOT_FOUND);
          
        }
       
        
         if(!$FilDeDiscussion = $promo->getFilDeDiscussion())
         {
            $FilDeDiscussion=new FilDeDiscussion();
            $FilDeDiscussion
                    ->setTitre('Discutions promo '.$promo->getId())
                    ->setDate(new \DateTime())
                    ->setPromo($promo);
                    $this->em->persist($FilDeDiscussion);
         }
         $commentaireData=$request->request->all();
         $pieceJointe=$request->files->get('pj');
         $commentaire=$serializer->denormalize($commentaireData,"App\Entity\CommentaireGeneral",true);
         $commentaire->setDate(new \DateTime()); 
         $commentaire->setUser($apprenant);
         if($pieceJointe)                    
         {
             $pieceJointe=fopen($pieceJointe->getRealPath(),'rb');
             $commentaire->setPj($pieceJointe);
         }
         $commentaire->setFilDeDiscussion($FilDeDiscussion);
         $this->em->persist($commentaire);
         $this->em->flush();

        return $this->json("succes",200);
           
    }

    /**
     * @Route(
     *     path="/api/users/promo/{idp}/apprenant/{ida}/chats",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\CommentaireGeneralController::afficherCommentaire",
     *          "__api_resource_class"=CommentaireGeneral::class,
     *          "__api_collection_operation_name"="get_commentaire"
     *     }
     * )
    */
    public function afficherCommentaire(int $idp,int $ida,PromoRepository $promo_repo,ApprenantRepository $apprenant_repo,CommentaireGeneralRepository $commentaire_repo)
    {
        $promo=null;

        if(!$promo = $promo_repo->find($idp))
        { 
            return $this->json("Attention verifiez l'id:$idp de la promotion!!!", Response::HTTP_NOT_FOUND);
        }

        if(! $apprenant=$apprenant_repo->find($ida))
        { 
            return $this->json("Attention verifiez l'id:$ida de lapprenant!!", Response::HTTP_NOT_FOUND);
          
        }
       
        $commentaires = $commentaire_repo->findChatByApprenantAndPromo($idp, $ida);
        return $this -> json($commentaires,Response::HTTP_OK);           
    }

    /**
     * @Route("/commentaire/general", name="commentaire_general")
     */
    public function index()
    {
        return $this->render('commentaire_general/index.html.twig', [
            'controller_name' => 'CommentaireGeneralController',
        ]);
    }
}
