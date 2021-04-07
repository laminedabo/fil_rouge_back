<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Entity\Competence;
use App\Entity\Groupecompetence;
use App\Repository\NiveauRepository;
use Symfony\Component\Mercure\Update;
use App\Controller\CompetenceController;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GroupecompetenceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class CompetenceController extends AbstractController
{
    /**
     * @Route(
     *     path="/api/admin/competences",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\CompetenceController::addCompetence",
     *          "__api_resource_class"=Competence::class,
     *          "__api_collection_operation_name"="add_competence"
     *     }
     * )
    */
    public function addCompetence(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager, GroupecompetenceRepository $grpcmp)
    {
        $competence_json = $request -> getContent();

        $Competence_tab = $serializer -> decode($competence_json,"json");
        $Competence = new Competence();
        $Competence -> setLibelle($Competence_tab['libelle']);
        $Niveau_tab = $Competence_tab['niveaux'];
        if (!isset($Competence_tab['groupecompetences']) || empty($Competence_tab['groupecompetences'])) {
            return $this -> json(["message" => "Une nouvelle compétence doit etre liée à un groupe de compétences"],Response::HTTP_BAD_REQUEST);
        }

        foreach ($Competence_tab['groupecompetences'] as $grpcmptce) {
            if ($Groupecompetence = $grpcmp -> find($grpcmptce['id'])) {
                $Competence -> addGroupecompetence($Groupecompetence );
            }
        }
        
        if (count($Niveau_tab)!=3)
        {
            return $this -> json(["message" => "Chaque compétence devrait avoir exactement 3 niveaux"],Response::HTTP_BAD_REQUEST);
        }
        
        foreach ($Niveau_tab as $value) {
            $niveau = new Niveau();
            $niveau -> setLibelle($value['libelle']);
            $niveau -> setcritereEvaluation($value['critereEval']);
            $niveau -> setgroupeAction($value['grpAction']);
            $Competence->addNiveau($niveau);
        }

        if (!$this -> isGranted("EDIT",$Competence)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        

        $errors = $validator->validate($Competence);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        dd($Competence);
        $manager->persist($Competence);
        $manager->flush();
        return $this->json($Competence,Response::HTTP_CREATED,[],['groups'=>['competence_read']] );
    }



    /**
     * @Route(
     *     path="/api/admin/competences/{id}",
     *     methods={"PUT","PATCH"},
     *     defaults={
     *          "__controller"="App\Controller\CompetenceController::updateCompetence",
     *          "__api_resource_class"=Competence::class,
     *          "__api_collection_operation_name"="update_competence"
     *     }
     * )
    */
    public function updateCompetence(MessageBusInterface $bus,Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager, $id, CompetenceRepository $rep_cmp,NiveauRepository $rep_niveau)
    {
        $Competence_json = $request -> getContent();
        $Competence_tab = $serializer -> decode($Competence_json,"json");
        $Competence = new Competence();
        if (!($Competence = $rep_cmp -> find($id))) {
            return $this ->json(null, Response::HTTP_NOT_FOUND,);
        }
        if (isset($Competence_tab['libelle'])) {
            $Competence -> setLibelle($Competence_tab['libelle']);
        }
        
        if (isset($Competence_tab['to_remove']) && $Groupecompetence = $manager -> getRepository(Groupecompetence::class) -> find($Competence_tab['to_remove'][0]['id'])) {
            $Competence -> removeGroupecompetence($Groupecompetence);
        }

        if (isset($Competence_tab['to_add'])) {
            foreach ($Competence_tab['to_add'] as $grpcmptce) {
                if ($Groupecompetence = $manager -> getRepository(Groupecompetence::class) -> find($grpcmptce['id'])) {
                    $Competence -> addGroupecompetence($Groupecompetence);
                }
            }
        }

        $Niveau_tab = isset($Competence_tab['niveaux'])?$Competence_tab['niveaux']:[];
        if (!empty($Niveau_tab)) {
            foreach ($Niveau_tab as $value) {
                $niveau = new Niveau();
                if (isset($value['id'])) 
                {
                    if (!($niveau =  $rep_niveau-> find($value['id']))) {
                        return $this ->json(null, Response::HTTP_NOT_FOUND,);
                    }
                    if (isset($value['libelle'])) {
                        $niveau -> setLibelle($value['libelle']);
                    }
                    if (isset($value['critereEvaluation'])) {
                        $niveau -> setcritereEvaluation($value['critereEvaluation']);
                    }
                    if (isset($value['groupeAction'])) {
                        $niveau -> setGroupeAction($value['groupeAction']);
                    }
                    $manager->persist($niveau);
                }
            }
        }
        
        if (!$this -> isGranted("EDIT",$Competence)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }


        $errors = $validator->validate($Competence);
        if (count($errors))
        {
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        $manager->persist($Competence);
        $manager->flush();

        // mercure
        $update = new Update(
            'competence'.$id,
            json_encode(['id' => $id])
        );
        $bus->dispatch($update);
        // End mercure

        return $this->json($Competence,Response::HTTP_CREATED,[],['groups'=>['competence_read']] );
    }


    /**
     * @Route(
     *     path="/api/admin/Competences",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\CompetenceController::showCompetence",
     *          "__api_resource_class"=Competence::class,
     *          "__api_collection_operation_name"="show_Competence"
     *     }
     * )
    */
    public function showCompetence(CompetenceRepository $Competence){

        if (!$this -> isGranted("VIEW",$Competence)) 
        {
            return $this -> json(["message" => "l'accès à cette ressource vous est interdit"],Response::HTTP_FORBIDDEN);
        }
        $Competence = $Competence -> findAll();
        
        return $this -> json($Competence, Response::HTTP_OK,[],['groups'=>['competence_read']] );
    }
}
