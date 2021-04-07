<?php

namespace App\Controller;

use App\Entity\Promo;
use App\Entity\Groupe;
use DateTimeInterface;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Repository\PromoRepository;
use App\Repository\GroupeRepository;
use App\Repository\ApprenantRepository;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeController extends AbstractController
{

    /**
     * @Route(
     *     path="/api/admin/groupes",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\GroupeController::addGroupe",
     *          "__api_resource_class"=Groupe::class,
     *          "__api_collection_operation_name"="add_groupe"
     *     }
     * )
    */
    public function addGroupe(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,FormateurRepository $formateur_repo, PromoRepository $promo_repo, ApprenantRepository $apprenant_repo)
    {
        $Groupe_jspon = $request -> getContent();
       

        $Groupe_tab = $serializer -> decode($Groupe_jspon,"json");

        if (!$Groupe_tab['promo']['id']) {
            return $this -> json(["message" => "Un nouveau groupe doit etre lié à une Promo"],Response::HTTP_FORBIDDEN);
        }
        $Promo_id = $Groupe_tab['promo']['id'];
        $Promo = new Promo();
        if (!($Promo = $promo_repo -> find($Promo_id))) {
            return $this ->json("Promo introuvable", Response::HTTP_NOT_FOUND,);
        }

        if (!isset($Groupe_tab['nom'])) {
            return $this -> json(["message" => "Veillez donner un nom à ce groupe"],Response::HTTP_FORBIDDEN);
        }
        $Groupe = new Groupe();
        $Groupe -> setNom($Groupe_tab['nom']);
        $Groupe -> setDateCreation(new \DateTime());
        $Groupe -> setType('secondaire');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user -> getRoles()[0] === "ROLE_FORMATEUR") {
            $Groupe -> addFormateur($user);
            $Groupe -> setIdFormateurPrincipal($user -> getUsername());
        }
        
        if (isset($Groupe_tab['apprenants'])) {
            foreach ($Groupe_tab['apprenants'] as $key => $val) {
                $Apprenant = new Apprenant();
                if ($Apprenant = $apprenant_repo -> find($val['id'])) {
                    $Groupe -> addApprenant($Apprenant);
                }
            }
        }
        
        if (isset($Groupe_tab['formateurs'])) {
            foreach ($Groupe_tab['formateurs'] as $key => $val) {
                $Formateur = new Formateur();
                if ($Formateur = $formateur_repo -> find($val['id'])) {
                    $Groupe -> addFormateur($Formateur);
                }
            }
        }

        $Promo -> addGroupe($Groupe);
            
                
        if (!$this -> isGranted("ROLE_FORMATEUR",$Groupe)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        $errors = $validator->validate($Groupe);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        // dd($Groupe);
        $manager->persist($Groupe);
        $manager->flush();
        return $this->json($Groupe,Response::HTTP_CREATED);
    }


    /**
     * @Route(
     *     path="/api/admin/groupes/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\GroupeController::updateGroupe",
     *          "__api_resource_class"=Groupe::class,
     *          "__api_collection_operation_name"="update_groupe"
     *     }
     * )
    */
    public function updateGroupe(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,FormateurRepository $formateur_repo, PromoRepository $promo_repo, ApprenantRepository $apprenant_repo, GroupeRepository $groupe_repo, $id)
    {
        $Groupe_jspon = $request -> getContent();
       

        $Groupe_tab = $serializer -> decode($Groupe_jspon,"json");

        
        $Groupe = new Groupe();
        if (!($Groupe = $groupe_repo -> find($id))) {
            return $this ->json("Groupe introuvable", Response::HTTP_NOT_FOUND,);
        }

        if (isset($Groupe_tab['nom'])) {
            $Groupe -> setNom($Groupe_tab['nom']);
        }

        
        if (isset($Groupe_tab['statut'])) {
            $Groupe -> setStatut($Groupe_tab['statut']);
        }
    
        
        if (isset($Groupe_tab['apprenants'])) {
            foreach ($Groupe_tab['apprenants'] as $key => $val) {
                $Apprenant = new Apprenant();
                if ($Apprenant = $apprenant_repo -> find($val['id'])) {
                    $trouve = false;
                    if (isset($val['action'])) {
                        if ($val['action'] === 'add') {
                            $Groupe -> addApprenant($Apprenant);
                        }
                        elseif($val['action'] === 'delete'){
                            $Groupe -> removeApprenant($Apprenant);
                        }
                    }
                }
            }
        }
        
        if (isset($Groupe_tab['formateurs'])) {
            foreach ($Groupe_tab['formateurs'] as $key => $val) {
                $Formateur = new Formateur();
                if ($Formateur = $formateur_repo -> find($val['id'])) {
                    $trouve = false;
                    if (isset($val['action'])) {
                        if ($val['action'] === 'add') {
                            $Groupe -> addFormateur($Formateur);
                        }
                        elseif($val['action'] === 'delete'){
                            
                            if ($Groupe -> getIdFormateurPrincipal() === $Formateur -> getUsername()) {
                                return $this -> json(["message" => "Le formateur principal ne peut etre retiré du groupe"],Response::HTTP_FORBIDDEN);
                            }
                            $Groupe -> removeFormateur($Formateur);
                        }
                    }
                }
            }
        }
            
        if (!$this -> isGranted("ROLE_FORMATEUR",$Groupe)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        $errors = $validator->validate($Groupe);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        // dd($Groupe);
        $manager->persist($Groupe);
        $manager->flush();
        return $this->json($Groupe,Response::HTTP_CREATED);
    }

     /**
     * @Route(
     *     path="/api/admin/groupes/{id}/apprenants/{ida}",
     *     methods={"DELETE"},
     *     defaults={
     *          "__controller"="App\Controller\GroupeController::deleteApprenant",
     *          "__api_resource_class"=Groupe::class,
     *          "__api_item_operation_name"="delete_apprenant"
     *     }
     * )
    */
    public function deleteApprenant($id,$ida, GroupeRepository $groupe_repo, ApprenantRepository $apprenant_repo, EntityManagerInterface $manager){
        if (($groupe = $groupe_repo -> find($id)) && ($apprenant = $apprenant_repo -> find($ida))) {
            $groupe -> removeApprenant($apprenant);
            if ($groupe -> getType() === "principal") {
                $apprenant -> setStatut("archived");
            }
            $manager -> flush();
            return $this->json($groupe,Response::HTTP_OK);
        }
        return $this->json("données invalides",Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/groupe", name="groupe")
     */
    public function index()
    {
        return $this->render('groupe/index.html.twig', [
            'controller_name' => 'GroupeController',
        ]);
    }
}
