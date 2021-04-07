<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Controller\ApprenantController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route(
     *     name="admin_liste",
     *     path="api/admins",
     *     methods={"GET"},
     *     defaults={
     *         "_controller"="\app\Controller\AdminController::getAdmin",
     *         "_api_resource_class"=User::class,
     *         "_api_collection_operation_name"="get_admins"
     *     }
     * )
     * @param UserRepository $repo
     * @return JsonResponse
     */
    public function getAdmin(UserRepository $repo): JsonResponse
    {
        $admin = $repo -> findByProfil("ADMIN");
        return $this -> json($admin, Response::HTTP_OK);
    }
    
    /**
    * @Route(
    *     name="admin_find",
    *     path="api/admins/{id}",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\AdminController::getAdminById",
    *         "_api_resource_class"=User::class,
    *         "_api_collection_operation_name"="get_admin"
    *     }
    * )
    */
    public function getAdminById(UserRepository $repo, SerializerInterface $serializer, $id){
        if (!($user = $repo -> find($id))) {
            return null;
        }
        $role = $user -> getRoles();
        if ($role[0] == "ROLE_ADMIN") {
            $user = $serializer -> serialize($user,"json");
            return $this -> json($user, Response::HTTP_OK,);
        }
        else{
            return $this ->json(null, Response::HTTP_NOT_FOUND,);
        }
    }

    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
