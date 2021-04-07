<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ProfilRepository;
use App\Controller\ApprenantController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantController extends AbstractController
{
    /**
    * @Route(
    *     name="apprenant_liste",
    *     path="api/apprenants",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\ApprenantController::getApprenant",
    *         "_api_resource_class"=User::class,
    *         "_api_collection_operation_name"="get_apprenants"
    *     }
    * )
    */
    public function getApprenant(UserRepository $repo){
        $apprenant = $repo -> findByProfil("APPRENANT");
        return $this -> json($apprenant, Response::HTTP_OK,);
    }
    
    /**
    * @Route(
    *     name="apprenant_find",
    *     path="api/apprenants/{id}",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\ApprenantController::getApprenantById",
    *         "_api_resource_class"=User::class,
    *         "_api_item_operation_name"="get_apprenant"
    *     }
    * )
    */
    public function getApprenantById(UserRepository $repo, SerializerInterface $serializer, $id){
        if (!($user = $repo -> find($id))) {
            return null;
        }
        $role = $user -> getRoles();
        if ($role[0] == "ROLE_APPRENANT") {
            $user = $serializer -> serialize($user,"json");
            return $this -> json($user, Response::HTTP_OK,);
        }
        else{
            return $this ->json(null, Response::HTTP_NOT_FOUND,);
        }
    }


    /**
     * @Route(
     *     path="/api/admin/apprenants",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\ApprenantController::addApprenant",
     *          "__api_resource_class"=Apprenant::class,
     *          "__api_collection_operation_name"="add_apprenant"
     *     }
     * )
    */
    public function addApprenant(Request $request,UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,ValidatorInterface $validator,ProfilRepository $profil,EntityManagerInterface $manager)
    {
        $user = $request->request->all();
        $profil = $profil -> find(3);
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(),"rb");
        $user["avatar"] = $avatar;
        $user = $serializer->denormalize($user,"App\Entity\Apprenant");
        $errors = $validator->validate($user);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        $user -> setProfil($profil);
        $password = $user->getPassword();
        $user->setPassword($encoder->encodePassword($user,$password));
        // dd($user);
        $manager->persist($user);
        $manager->flush();
        fclose($avatar);
        return $this->json($user,Response::HTTP_CREATED);
    }



    public function index()
    {
        return $this->render('apprenant/index.html.twig', [
            'controller_name' => 'ApprenantController',
        ]);
    }
}