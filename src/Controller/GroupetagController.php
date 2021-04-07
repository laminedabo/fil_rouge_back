<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Groupetag;
use App\Repository\TagRepository;
use App\Controller\GroupetagController;
use App\Repository\GroupetagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupetagController extends AbstractController

{
    /**
     * @Route("/groupetag", name="groupetag")
     */
    public function index()
    {
        return $this->render('groupetag/index.html.twig', [
            'controller_name' => 'GroupetagController',
        ]);
    }

    /**
     * @Route(
     *     path="/api/admin/groupetags",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\GroupetagController::addGroupetag",
     *          "__api_resource_class"=Groupetag::class,
     *          "__api_collection_operation_name"="add_groupetags"
     *     }
     * )
    */
    public function addGroupetag(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager, TagRepository $tag_rep)
    {
        $Groupetag_json = $request -> getContent();

        $Groupetag_tab = $serializer -> decode($Groupetag_json,"json");
        
        $Groupetag = new Groupetag();

        $Groupetag -> setLibelle($Groupetag_tab['libelle']);
        if (isset($Groupetag_tab['tag']) && !empty($Groupetag_tab['tag'])) {
            $tag_tab = $Groupetag_tab['tag'];
        }
        else {
            return new JsonResponse("il faut au moins un tag",Response::HTTP_BAD_REQUEST,[],true);
        } 
        foreach ($tag_tab as $value) 
        {
            $tag = new Tag();
            if (isset($value['id'])){
                $tag =  $tag_rep -> find($value['id']);
            }
            else {
                $tag -> setLibelle($value['libelle']);
                $tag -> setDescriptif($value["descriptif"]);
            }  
            
            $Groupetag -> addtag($tag);          
        }

        if (!$this -> isGranted("EDIT",$Groupetag)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        $errors = $validator->validate($tag);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }

        $errors = $validator->validate($Groupetag);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        $manager->persist($Groupetag);
        $manager->flush();
        return $this->json($Groupetag,Response::HTTP_CREATED);
    }

    /**
     * @Route(
     *     path="/api/admin/groupetags",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\GroupetagController::showGroupetag",
     *          "__api_resource_class"=Groupetag::class,
     *          "__api_collection_operation_name"="show_groupetagss"
     *     }
     * )
    */
    public function showGroupetag(GroupetagRepository $Groupetag){

        if (!$this -> isGranted("ROLE_FORMATEUR",$Groupetag)) 
        {
            return $this -> json(["message" => "l'accès à cette ressource vous est interdite"],Response::HTTP_FORBIDDEN);
        }
        $Groupetag = $Groupetag -> findAll();
        
        
        return $this -> json($Groupetag, Response::HTTP_OK,[],['groups'=>['Grptags_tags_read']] );
    }

    

    /**
     * @Route
     * (
     *     path="/api/admin/groupetags/{id}",
     *     methods={"PUT","PATCH"},
     *     defaults={
     *          "__controller"="App\Controller\GroupetagController::updateGroupetag",
     *          "__api_resource_class"=Groupetag::class,
     *          "__api_collection_operation_name"="update_Groupetag"
     *     }
     * )
    */
    public function updateGroupetag(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager, $id, GroupetagRepository $grptag_repo, TagRepository $tag_rep)
    {
        $Groupetag_json = $request -> getContent();
        $Groupetag_tab = $serializer -> decode($Groupetag_json,"json");
        
        $Groupetag = new Groupetag();
        if (!($Groupetag = $grptag_repo -> find($id))) 
        {
            return $this ->json(null, Response::HTTP_NOT_FOUND,);
        }
        if (isset($Groupetag_tab['libelle'])) 
        {
            $Groupetag -> setLibelle($Groupetag_tab['libelle']);
        }
        
        $tag_tab = isset($Groupetag_tab['tag'])?$Groupetag_tab['tag']:[];
    
        if (!empty($tag_tab)) 
        {
            foreach ($tag_tab as $key => $value) {
                $tag = new Tag();
                if (isset($value['id']) && $tag =  $tag_rep -> find($value['id'])) 
                {
                    if (isset($value['action'])) {
                        if ($value['action'] === 'delete') {
                            $Groupetag -> removeTag($tag);
                        }
                        else {
                            $Groupetag -> addTag($tag);
                        }
                    }
                    else {
                        if (isset($value['libelle'])) {
                            $tag -> setLibelle($value['libelle']);
                        }
    
                        if (isset($value['descriptif'])) 
                        {
                            $tag -> setDescriptif($value['descriptif']);
                        }
                    }
                }
                else
                {
                    if(isset($value['libelle'])) 
                    {
                        $tag -> setLibelle($value['libelle']);
                    }

                    if(isset($value['descriptif'])) 
                    {
                        $tag -> setDescriptif($value['descriptif']);
                    }

                    $Groupetag -> addTag($tag);
                }
            }
        }
        
        $errors = $validator->validate($tag);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        if (!$this -> isGranted("EDIT",$Groupetag)) 
        {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        

        $errors = $validator->validate($Groupetag);
        if (count($errors))
        {
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        $manager->persist($Groupetag);
        $manager->flush();
        return $this->json($Groupetag,Response::HTTP_CREATED);
    }



}
