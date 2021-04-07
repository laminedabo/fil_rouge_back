<?php

namespace   App\Services;

use App\Entity\Niveau;
use App\Entity\Competence;
use App\Entity\Groupecompetence;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class GroupeCompetenceCompetenceServices
{
    public function setCompetence($Groupecompetence, $Competence_tab,$manager){
        foreach ($Competence_tab as $cmptce) {
            $competence = new Competence();
            if (!isset($cmptce['id'])) {
                if (count($cmptce['niveaux']) != 3) {
                    return new JsonResponse("Erreur: nombre de niveau d'une cmptence must be 3, ".count($cmptce['niveaux'])." donnés", Response::HTTP_BAD_REQUEST);
                }
                foreach ($cmptce['niveaux'] as $niv) {
                    $niveau = new Niveau();
                    $niveau -> setLibelle($niv['libelle']);
                    $niveau -> setCritereEvaluation($niv['critereEval']);
                    $niveau -> setGroupeAction($niv['grpAction']);
                    $competence -> addNiveau($niveau);
                    $manager -> persist($niveau);
                }
                $competence -> setLibelle($cmptce['libelle']);
                $Groupecompetence -> addCompetence($competence);
            }
            else {
                $competence = $manager -> getRepository(Competence::class) -> find($cmptce['id']);
                if (isset($cmptce['action']) && $cmptce['action'] ==='delete') {
                    $Groupecompetence -> removeCompetence($competence);
                }
                else {
                    $Groupecompetence -> addCompetence($competence);
                }
            }
        }
        return $Groupecompetence;
    }


    public function setGroupeCompetence($Referentiel, $Groupecompetence_tab, $manager, $user){
        foreach ($Groupecompetence_tab as $value) {
            $groupecompetences = new Groupecompetence();
            if (isset($value['id'])) 
            {
                if (!($groupecompetences =  $manager -> getRepository(Groupecompetence::class) -> find($value['id']))) {
                    return new JsonResponse(null, Response::HTTP_NOT_FOUND,);
                }
                if (isset($value['libelle'])) {
                    $groupecompetences -> setLibelle($value['libelle']);
                }
                if (isset($value['descriptif'])) {
                    $groupecompetences -> setDescriptif($value['descriptif']);
                }
                if (isset($value['action'])) {
                    if ($value['action']==='delete') {
                        $Referentiel -> removeGroupecompetence($groupecompetences);
                    }
                    else{
                        $Referentiel -> addGroupecompetence($groupecompetences);
                    }
                    
                }
            }
            elseif(isset($value['descriptif']) && isset($value['libelle'])){
                $groupecompetences -> setLibelle($value['libelle']);
                $groupecompetences -> setDescriptif($value['descriptif']);
                if (isset($value['competence'])) {
                    $Competence_tab = $value['competence'];
                    $groupecompetences = $this -> setCompetence($groupecompetences, $Competence_tab,$manager);
                }
                $Referentiel -> addGroupecompetence($groupecompetences);
                $groupecompetences -> setUser($user);
            }
        }
        return $Referentiel;
    }
}
