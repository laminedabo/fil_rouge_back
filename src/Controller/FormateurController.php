<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\PromoRepository;
use App\Repository\GroupeRepository;
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

class FormateurController extends AbstractController
{
    /**
    * @Route(
    *     name="formateur_liste",
    *     path="api/formateurs",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\FormateurController::getFormateur",
    *         "_api_resource_class"=User::class,
    *         "_api_collection_operation_name"="get_formateurs"
    *     }
    * )
    */
    public function getFormateur(UserRepository $repo){
        $formateur = $repo -> findByProfil("FORMATEUR");
        return $this -> json($formateur, Response::HTTP_OK,);
    }
    
    /**
    * @Route(
    *     name="formateur_find",
    *     path="api/formateurs/{id}",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\FormateurController::getFormateurById",
    *         "_api_resource_class"=User::class,
    *         "_api_collection_operation_name"="get_formateur"
    *     }
    * )
    */
    public function getFormateurById(UserRepository $repo, SerializerInterface $serializer, $id){
        if (!($user = $repo -> find($id))) {
            return null;
        }
        $role = $user -> getRoles();
        if ($role[0] == "ROLE_FORMATEUR") {
            $user = $serializer -> serialize($user,"json");
            return $this -> json($user, Response::HTTP_OK,);
        }
        else{
            return $this ->json(null, Response::HTTP_NOT_FOUND,);
        }
    }

    /**
     * @Route(
     *     path="/api/admin/formateurs",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\FormateurController::addFormateur",
     *          "__api_resource_class"=Formateur::class,
     *          "__api_collection_operation_name"="add_formateur"
     *     }
     * )
    */
    public function addFormateur(Request $request,UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,ValidatorInterface $validator,ProfilRepository $profil,EntityManagerInterface $manager)
    {
        $user = $request->request->all();
        $profil = $profil -> find(1);
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(),"rb");
        $user["avatar"] = $avatar;
        $user = $serializer->denormalize($user,"App\Entity\Formateur");
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

    /**
     * @Route("/formateur", name="formateur")
     */
    public function index()
    {
        return $this->render('formateur/index.html.twig', [
            'controller_name' => 'FormateurController',
        ]);
    }
}