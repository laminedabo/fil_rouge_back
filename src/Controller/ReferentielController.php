<?php

namespace App\Controller;

use App\Entity\Referentiel;
use App\Entity\Groupecompetence;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReferentielRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GroupecompetenceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\GroupeCompetenceCompetenceServices;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReferentielController extends AbstractController
{



    /**
     * @Route(
     *     path="/api/admin/referentiels",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\ReferentielController::addReferentiel",
     *          "__api_resource_class"=Referentiel::class,
     *          "__api_collection_operation_name"="add_referentiel"
     *     }
     * )
    */
    public function addReferentiel(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager, CompetenceRepository $cmp_repo){
        $referentiel = $request->request->all();
        $competences  = json_decode($referentiel['competences_tab'], true);
        $programme = $request->files->get("programme");
        $programme = fopen($programme->getRealPath(),"rb");
        $referentiel["programme"]=$programme;
        $referentiel = $serializer->denormalize($referentiel,"App\\Entity\\Referentiel");
        foreach ($competences as  $value) {
            if ($cmp = $cmp_repo -> findOneByLibelle($value)) {
                $referentiel -> addCompetence($cmp);
            }
        }
        dd($referentiel);

        $manager->persist( $referentiel);
        $manager->flush();
        return new JsonResponse( $referentiel, Response::HTTP_CREATED);
    }


    /**
     * @Route("/referentiel", name="referentiel")
     */
    public function index()
    {
        return $this->render('referentiel/index.html.twig', [
            'controller_name' => 'ReferentielController',
        ]);
    }

    /// Ancienne methode
    public function addReferentiel_OLD(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,GroupeCompetenceCompetenceServices $grpcmpService)
    {
        $Referentiel_json = $request -> getContent();
        //dd($Referentiel_json);
        $Referentiel_tab = $serializer -> decode($Referentiel_json,"json");
        $Referentiel = new Referentiel();
        $Referentiel -> setLibelle($Referentiel_tab['libelle']);
        $Referentiel -> setPresentation($Referentiel_tab['presentation']);
        if (isset($Referentiel_tab['programme']) ) {
            $Referentiel -> setProgramme($Referentiel_tab['programme']);
        }
        $Referentiel -> setCritereAdmission($Referentiel_tab['critereAdmission']);
        $Referentiel -> setCritereEvaluation($Referentiel_tab['critereEvaluation']);
        
        $Groupecompetence_tab = $Referentiel_tab['groupecompetence'];
        if (!empty($Groupecompetence_tab)) {
            // envoyer au service pour affecter le groupecompetence
            $user = $this->getUser();//user connecté
            $Referentiel = $grpcmpService -> setGroupeCompetence($Referentiel,$Groupecompetence_tab,$manager,$user);
        }
        if (!$this -> isGranted("EDIT",$Referentiel)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

       
        $errors = $validator->validate($Referentiel);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        dd($Referentiel);
        $manager->persist($Referentiel);
        $manager->flush();
        
        return $this->json($Referentiel,Response::HTTP_CREATED,[],['groups'=>['referentiel_read']] );
    }

     /**
     * @Route(
     *     path="/api/admin/referentiels/{id}",
     *     methods={"PUT","PATCH"},
     *     defaults={
     *          "__controller"="App\Controller\ReferentielController::updateReferentiel",
     *          "__api_resource_class"=Referentiel::class,
     *          "__api_collection_operation_name"="update_referentiel"
     *     }
     * )
    */
    public function updateReferentiel(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager, $id, GroupecompetenceRepository $cmp, ReferentielRepository $grpcmp,GroupeCompetenceCompetenceServices $grpcmpService)
    {
        $Referentiel_json = $request -> getContent();
        $Referentiel_tab = $serializer -> decode($Referentiel_json,"json");
        $Referentiel = new Referentiel();
        if (!($Referentiel = $grpcmp -> find($id))) {
            return $this ->json(null, Response::HTTP_NOT_FOUND,);
        }
        if (isset($Referentiel_tab['libelle'])) {
            $Referentiel -> setLibelle($Referentiel_tab['libelle']);
        }
        if (isset($Referentiel_tab['presentation'])) {
            $Referentiel -> setPresentation($Referentiel_tab['presentation']);
        }
        if (isset($Referentiel_tab['programme'])) {
            $Referentiel -> setProgramme($Referentiel_tab['programme']);
        }
        if (isset($Referentiel_tab['critereAdmission'])) {
            $Referentiel -> setCritereAdmission($Referentiel_tab['critereAdmission']);
        }
        if (isset($Referentiel_tab['critereEvaluation'])) {
            $Referentiel -> setcritereEvaluation($Referentiel_tab['critereEvaluation']);
        }
        $Groupecompetence_tab = isset($Referentiel_tab['groupecompetence'])?$Referentiel_tab['groupecompetence']:[];
        if (!empty($Groupecompetence_tab)) {
            $user = $this->getUser();
            $Referentiel = $grpcmpService -> setGroupeCompetence($Referentiel,$Groupecompetence_tab,$manager,$user);
        }
        
        if (!$this -> isGranted("EDIT",$Referentiel)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        
       

        $errors = $validator->validate($Referentiel);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        
        $manager->persist($Referentiel);
        $manager->flush();
        return $this->json($Referentiel,Response::HTTP_CREATED,[],['groups'=>['referentiel_groupecompetence_read']] );
    }
}
