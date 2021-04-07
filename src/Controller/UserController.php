<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Profil;
use App\Services\UserServices;
use App\Repository\UserRepository;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route(
     *     path="/api/admin/users",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::addUser",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="add_user"
     *     }
     * )
    */
    public function addUser(Request $request,UserServices $userService, UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,ValidatorInterface $validator,ProfilRepository $profil,EntityManagerInterface $manager)
    {
        return $this->json($userService -> setCommonProperties($request, $encoder, $serializer, $validator, $profil,$manager),Response::HTTP_CREATED,[],['groups'=>['user_read']]);

    }
    
    
     /**
     * @Route(
     *     path="/api/admin/users/{id}",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::UpdateUser",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="update_user"
     *     }
     * )
    */
    public function UpdateUser(Request $request,UserServices $userService, UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,ValidatorInterface $validator,ProfilRepository $profil,EntityManagerInterface $manager, $id)
    {
        return $this->json($userService -> setCommonProperties($request, $encoder, $serializer, $validator, $profil,$manager, $id),Response::HTTP_CREATED,[],['groups'=>['user_read']]);
    }

    /**
     * @Route(
     *     path="/api/admin/users/count",
     *     methods={"PATCH"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::getCount",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="getCount_user"
     *     }
     * )
    */
    public function getCount(Request $req, UserRepository $user_repo, SerializerInterface $serializer){
        $req = $serializer -> decode($req -> getContent(),"json");
        if ($req['profil']===0) {
            return $this->json($user_repo -> getCount(),Response::HTTP_OK);
        }
        return $this->json($user_repo -> getCountByProfil($req['profil']),Response::HTTP_OK);
    }

    /**
     * @Route(
     *     path="/api/admin/users/search",
     *     methods={"PATCH"},
     *     defaults={
     *          "__controller"="App\Controller\UserController::searchTerm",
     *          "__api_resource_class"=User::class,
     *          "__api_collection_operation_name"="search_user"
     *     }
     * )
    */
    public function searchTerm(Request $request, UserRepository $user_repo){
        return $this->json($user_repo -> searchTerm($request->getContent()),Response::HTTP_OK,[],['groups'=>['user_read']]);
    }
}
