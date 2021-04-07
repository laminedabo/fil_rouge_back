<?php

namespace App\Controller;

use App\Entity\Brief;
use App\Repository\UserRepository;
use App\Repository\BriefRepository;
use App\Repository\PromoRepository;
use App\Repository\GroupeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use DateTime;
use App\Entity\Niveau;
use App\Entity\Ressource;
use App\Entity\PromoBrief;
use App\Entity\LivrableAttendu;
use App\Repository\TagRepository;
use App\Entity\PromoBriefApprenant;
use App\Entity\BriefLivrableAttendu;
use App\Entity\Livrable;
use App\Repository\NiveauRepository;
use App\Repository\ApprenantRepository;
use App\Repository\RessourceRepository;
use App\Repository\PromoBriefRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReferentielRepository;
use App\Repository\LivrableAttenduRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BriefController extends AbstractController
{


    /**
    * @Route(
    *     name="brief_groupe_promo",
    *     path="api/formateur/promos/{idp}/groupes/{idg}/briefs",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\BriefController::briefs_groupe_promo",
    *         "_api_resource_class"=Brief::class,
    *         "_api_collection_operation_name"="brief_groupe_promo"
    *     }
    * )
    */
    public function briefs_groupe_promo(PromoRepository $promo_repo, GroupeRepository $groupe_repo, $idp, $idg){
        if (!$promo = $promo_repo -> find($idp)) {
            return $this -> json("Promo introuvable", Response::HTTP_NOT_FOUND);
        }
        if (!$groupe_a_rechercher = $groupe_repo -> find($idg)) {
            return $this -> json("Groupe introuvable", Response::HTTP_NOT_FOUND);
        }
        $result = [];
        foreach ($promo -> getGroupes() as $key => $groupe) {
            if ($groupe -> getId() === $groupe_a_rechercher -> getId()) {
                foreach ($groupe -> getBriefs() as $key => $brief) {
                    foreach ($brief -> getGroupes() as $key => $groupe) {
                        if ($groupe -> getStatut() !== 'encours') {
                            $brief -> removeGroupe($groupe);
                        }
                    }
                }
                $result[] = $brief;
            }
        }
        return $result;
    }

    /**
    * @Route(
    *     name="brief_promo",
    *     path="api/formateurs/promos/{idp}/briefs/{id}",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\BriefController::brief_promo",
    *         "_api_resource_class"=Brief::class,
    *         "_api_collection_operation_name"="brief_promo"
    *     }
    * )
    */
    public function brief_promo(PromoRepository $promo_repo, BriefRepository $brief_repo, $idp, $id){
        
        if (!$promo = $promo_repo -> find($idp)) {
            return $this -> json("Promo introuvable", Response::HTTP_NOT_FOUND);
        }
        if (!$brief = $brief_repo -> find($id)) {
            return $this -> json("Brief introuvable", Response::HTTP_NOT_FOUND);
        }
        if (!$this -> isGranted("VIEW",$brief)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }
        foreach ($brief -> getPromoBriefs() as $key => $promobrief) {
            if ($promobrief -> getPromo() === $promo) {
                return $brief;
            }
        }
        return $this -> json("Brief introuvable dans cette promo", Response::HTTP_NOT_FOUND);
    }


    /**
    * @Route(
    *     name="promo_id_brief",
    *     path="api/formateurs/promos/{idp}/briefs",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\App\Controller\BriefController::promo_id_briefs",
    *         "_api_resource_class"=Brief::class,
    *         "_api_collection_operation_name"="promo_id_brief"
    *     }
    * )
    */
    public function promo_id_briefs(PromoRepository $promo_repo, $idp){
        if (!$promo = $promo_repo -> find($idp)) {
            return $this -> json("Promo introuvable", Response::HTTP_NOT_FOUND);
        }
        $briefs =[];
        foreach ($promo -> getPromoBriefs() as $key => $promobrief) {
            $brief = $promobrief -> getBrief();
            foreach ( $brief -> getGroupes() as $key => $groupe) {
                if ($groupe -> getStatut() !== 'encours') {
                    $brief -> removeGroupe($groupe);
                }
            }
            $briefs[] = $brief;
        }
        return $briefs;
    }


    /**
    * @Route(
    *     name="promo_apprenant_brief",
    *     path="api/apprenants/promos/{id}/briefs",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\BriefController::promo_apprenant_brief",
    *         "_api_resource_class"=Brief::class,
    *         "_api_collection_operation_name"="promo_apprenant_brief"
    *     }
    * )
    */
    public function promo_apprenant_brief(PromoRepository $promo_repo, $id){
        if (!$promo = $promo_repo -> find($id)) {
            return $this -> json("Promo introuvable", Response::HTTP_NOT_FOUND);
        }
        $briefs =[];
        foreach ($promo -> getGroupes() as $key => $groupe) {
            foreach ($groupe -> getBriefs() as $key => $brief) {
                if (!in_array($brief,$briefs)) {
                    foreach ( $brief -> getGroupes() as $key => $groupe) {
                        if ($groupe -> getStatut() !== 'encours') {
                            $brief -> removeGroupe($groupe);
                        }
                    }
                    $briefs[] = $brief;
                }
            }
            
        }
        return $briefs;
    }


    /**
    * @Route(
    *     name="apprenant_promo_brief",
    *     path="api/apprenants/promos/{idp}/briefs/{idb}",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\App\Controller\BriefController::apprenant_promo_brief",
    *         "_api_resource_class"=Brief::class,
    *         "_api_collection_operation_name"="apprenant_promo_brief"
    *     }
    * )
    */
    public function apprenant_promo_brief(PromoRepository $promo_repo, BriefRepository $brief_repo, $idp, $idb, Request $request = null, UserRepository $apprenant_repo, SerializerInterface $serializer){
        
        if (!$promo = $promo_repo -> find($idp)) {
            return $this -> json("Promo introuvable", Response::HTTP_NOT_FOUND);
        }
        if (!$brief = $brief_repo -> find($idb)) {
            return $this -> json("Brief introuvable", Response::HTTP_NOT_FOUND);
        }
        if (!$this -> isGranted("VIEW_APPRENANT",$brief)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }
        if ($appUser = $request -> getContent()) {
            $appUser = $serializer -> decode($appUser, "json");
            $apprenant = $apprenant_repo -> findOneByUsername($appUser['username']);
        }
        elseif ($this -> get('security.token_storage') -> getToken() -> getUser() -> getRoles()[0] === 'ROLE_APPRENANT') {
            $apprenant = $this -> get('security.token_storage') -> getToken() -> getUser();
        }
        if (isset($apprenant)) {
            foreach ($brief -> getPromoBriefs() as $key => $promobrief) {
                if ($promobrief -> getPromo() === $promo) {
                    foreach ($brief -> getGroupes() as $key => $groupe) {
                        foreach ($apprenant -> getGroupe() as $key => $groupe_appr) {
                            if ($groupe === $groupe_appr) {
                                $brief -> setGroupe(new ArrayCollection());
                                $brief -> addGroupe($groupe_appr);
                                $groupe_appr -> viderGroupe();
                                $groupe_appr -> addApprenant($apprenant);
                            }
                        }
                    }
                    return $brief;
                }
            }
        }
        return $this -> json("infos incorrectes", Response::HTTP_NOT_FOUND);
    }

    /**
    * @Route(
    *     name="briefs_brouillon",
    *     path="api/formateur/briefs/brouillons",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\BriefController::briefs_brouillon",
    *         "_api_resource_class"=Brief::class,
    *         "_api_collection_operation_name"="briefs_brouillon"
    *     }
    * )
    */
    public function briefs_brouillon(){
        if ($this->get('security.token_storage')->getToken()->getUser() -> getRoles()[0] !== "ROLE_FORMATEUR") {
            return $this -> json("Vous n'etes pas formateur...", Response::HTTP_FORBIDDEN);
        }
        $briefs = $this->get('security.token_storage')->getToken()->getUser() -> getBriefs();
        $result = [];
        foreach ($briefs as $key => $brief) {
            if ($brief -> getstatut() === 'brouillon') {
                $result[] = $brief;
            }
        }
        return !empty($result) ? $result : $this -> json("Vous n'avez aucun brief brouillon", Response::HTTP_NOT_FOUND);
    }

    /**
    * @Route(
    *     name="briefs_valide",
    *     path="api/formateur/briefs/valides",
    *     methods={"GET"},
    *     defaults={
    *         "_controller"="\app\Controller\BriefController::briefs_valide",
    *         "_api_resource_class"=Brief::class,
    *         "_api_collection_operation_name"="briefs_valide"
    *     }
    * )
    */
    public function briefs_valide(){
        if ($this->get('security.token_storage')->getToken()->getUser() -> getRoles()[0] !== "ROLE_FORMATEUR") {
            return $this -> json("Vous n'etes pas formateur...", Response::HTTP_FORBIDDEN);
        }
        $briefs = $this->get('security.token_storage')->getToken()->getUser() -> getBriefs();
        $result = [];
        foreach ($briefs as $key => $brief) {
            if ($brief -> getstatut() === 'valide') {
                $result[] = $brf;
            }
        }
        return !empty($result) ? $result : $this -> json("Vous n'avez aucun brief validé", Response::HTTP_NOT_FOUND);
    }

    
    /**
     * @Route("/brief", name="brief")
     */
    public function index()
    {
        return $this->render('brief/index.html.twig', [
            'controller_name' => 'BriefController',
        ]);
    }

    /**
     * @Route(
     *     path="api/formateur/briefs",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\BriefController::addBrief",
     *          "__api_resource_class"=Brief::class,
     *          "__api_collection_operation_name"="add_briefs"
     *     }
     * )
    */
        public function addBrief (Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,ReferentielRepository $ref,TagRepository $tag,NiveauRepository $niveau,GroupeRepository $groupe,PromoBriefRepository $promo,\Swift_Mailer $mailer)
        
        {
            $Brief_json = $request -> getContent();
            $Brief_tab = $serializer -> decode($Brief_json,"json");
            $Brief = new Brief();

            if (isset($Brief_tab["langue"]) && !empty ($Brief_tab["langue"]))
            {
                $Brief->setLangue($Brief_tab["langue"]);
                
                if (isset($Brief_tab["titre"]) && !empty ($Brief_tab["titre"]))
                {
                    
                    $Brief->setTitre($Brief_tab["titre"]);   
                    if ( isset($Brief_tab["contexte"]) && !empty($Brief_tab["contexte"]))
                    {
                           
                        $Brief->setContexte($Brief_tab["contexte"]);
                        
                        if (isset ($Brief_tab["modalitePedagogiques"]) && !empty ($Brief_tab["modalitePedagogiques"]))
                        {
                            $Brief->setModalitesPedagogiques($Brief_tab["modalitePedagogiques"]);
                            
                            if (isset ($Brief_tab["criterePerformance"]) && !empty ($Brief_tab["criterePerformance"])) 
                            {
                                $Brief->setCriteresDePerformance($Brief_tab["criterePerformance"]);
                                
                                if (isset ($Brief_tab["modaliteEvaluation"]) && !empty ($Brief_tab["modaliteEvaluation"]))
                                {
                                    $Brief->setModalitesEvaluation($Brief_tab["modaliteEvaluation"]);
                                    
                                    if (isset($Brief_tab["description"]) && !empty ($Brief_tab["description"]))
                                    {
                                        $Brief->setDescription($Brief_tab["description"]);
                                        
                                        if (isset ($Brief_tab["statut"]) && !empty ($Brief_tab["statut"]))
                                        {
                                            $Brief->setStatut($Brief_tab["statut"]);

                                            if (isset ($Brief_tab["livrablesAttendus"]) && !empty ($Brief_tab["livrablesAttendus"]))
                                            {
                                                $Brief->setLivrablesAttendus($Brief_tab["livrablesAttendus"]);
                                                
                                                
                                                if ( isset($Brief_tab["referentiel"]["id"]) && !empty ($Brief_tab["referentiel"]["id"]) )
                                                {
                                                        if ($ref->find($Brief_tab["referentiel"]["id"]));
                                                        {
                                                            $referentiel=$ref->find($Brief_tab["referentiel"]["id"]);
                                                            $Brief->setReferentiel($referentiel); 

                                                            if (isset ($Brief_tab["tags"]) && !empty ($Brief_tab["tags"]))
                                                            {
                                                                foreach ($Brief_tab["tags"] as $key => $value) 
                                                                {
                                                                    if ($tag->find($value))
                                                                    {
                                                                        $Tag=$tag->find($value);
                                                                        $Brief->addTag($Tag);
                                                                        
                                                                    }                                                                                 
                                                                }
                                                                
                                                                    if (isset ($Brief_tab["niveaux"]) && !empty ($Brief_tab["niveaux"]))
                                                                    {
                                                                        foreach ($Brief_tab["niveaux"] as $key => $value) 
                                                                        {
                                                                            if ($niveau->find($value))
                                                                            {
                                                                                $Niveau=$niveau->find($value);
                                                                                //$grp=$Niveau->getCompetence()->getGroupecompetences();
                                                                                $Brief->addNiveau($Niveau);
                                                                                
                                                                            }                                                                                 
                                                                        }
                                                                        
                                                                        if (isset ($Brief_tab["ressources"]) && !empty ($Brief_tab["ressources"]))
                                                                        {   
                                                                                foreach ($Brief_tab["ressources"] as $key => $value) 
                                                                                {
                                                                                     if (!empty ($value) && $value["type"]=="url")
                                                                                     {
                                                                                        $Resource=new Ressource();
                                                                                        $Resource->setTitre($value["titre"]);
                                                                                        $Resource->setUrl($value["url"]);
                                                                                        $Brief->addRessource($Resource);
                                                                                    
                                                                                     }
                                                                                    
                                                                                                                                                          
                                                                                }

                                                                                if (isset ($Brief_tab["livrablesattendus"]) && !empty ($Brief_tab["livrablesattendus"]))
                                                                                {   
                                                                                        foreach ($Brief_tab["livrablesattendus"] as $key => $value) 
                                                                                        {
                                                                                            $livrablesattendus=new LivrableAttendu();
                                                                                            $livrablesattendus->setLibelle($value["libelle"]);   
                                                                                            $BriefLivrableAttendu=new BriefLivrableAttendu();
                                                                                            $BriefLivrableAttendu->setBrief($Brief);
                                                                                            $BriefLivrableAttendu->setLivrableAttendu($livrablesattendus);
                                                                                            $Brief->addBriefLivrableAttendu($BriefLivrableAttendu);   
                                                                                            
                                                                                        }
                                                                                            

                                                                           
                                                                           if (isset ($Brief_tab["groupes"]) && !empty ($Brief_tab["groupes"]))
                                                                           {
                                                                                foreach ($Brief_tab["groupes"] as $key => $value) 
                                                                                {
                                                                                    if ($groupe->find($value))
                                                                                    {
                                                                                        
                                                                                        $Groupe=$groupe->find($value);
                                                                                        $Brief->addGroupe($Groupe);
                                                                                        $Promo=$Groupe->getPromo();
                                                                                        $PromoBrief=new PromoBrief();
                                                                                        $PromoBrief->setBrief($Brief);
                                                                                        $PromoBrief->setPromo($Promo);
                                                                                        $PromoBrief->setStatut("en cours");
                                                                                        $Brief->addPromoBrief($PromoBrief);
                                                                                        $PromoBriefApprenant=new PromoBriefApprenant();
                                                                                        $PromoBriefApprenant->setStatut("validé");
                                                                                        $PromoBriefApprenant->addPromoBrief($PromoBrief);
                                                                                        $tab=$Groupe->getApprenants();
                                                                                        foreach ($tab as $key => $apprenant) 
                                                                                        {
                                                                                            $PromoBriefApprenant->addApprenant($apprenant);
                                                                                            
                                                                                            $message = (new \Swift_Message('Ajout'))
                                                                                            ->setFrom('admin@gmail.com')
                                                                                            ->setTo($apprenant->getEmail())
                                                                                            ->setBody('Bonjour cher(e) apprenant(e), vous avez été assigné au brief '.$Brief->getTitre());
                                                                                                // $mailer->send($message); // on envoie
                                                                                            
                                                                                        }
                                                                                        
                                                                                    }                                                                                 
                                                                                }
                                                                           }     

                                                                        }
                                                            
                                                                    }
                                                                
                                                                }

                                                            }

                                                        }                    
                                                
                                                }                                            
                                            }
                                        }
                                    }    
                                }   
                        }
                    }
                }
                
                    $errors = $validator->validate($Brief);
                    if (count($errors))
                    {
                        $errors = $serializer->serialize($errors,"json");
                        return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
                    }

                    $Brief->setDatecreation(new \DateTime());
                    $user = $this->get('security.token_storage')->getToken()->getUser();
                    $Brief->setFormateur($user);
                    $manager->persist($Brief);
                    $manager->flush();
                    
                    return $this->json($Brief,Response::HTTP_CREATED);
    }
                }
    }



    /**
     * @Route(
     *     path="api/formateur/briefs/{id}",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\BriefController::addBrief",
     *          "__api_resource_class"=Brief::class,
     *          "__api_collection_operation_name"="duplique_briefs",
     *          
     *     }
     * )
    */

    public function dupliqueBrief(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,BriefRepository $brief,$id)
    {
        
        $Brief=$brief->find($id);
        $duplique=clone $Brief;
        //Suppression de l'id
        $duplique->setId(null);
        //Suppression de la collection de PromoBrief dans Brief
        $duplique->setPromoBrief(new ArrayCollection());
        //Suppression de la collection de Groupes dans Brief
        $duplique->setGroupe(new ArrayCollection());
        //Suppression de la collection de Niveaux dans Brief
        $duplique->setNiveaux(new ArrayCollection());
        //Reccupération de la collection de livrables attendus du Brief à dupliquer
        $tab_Brieflivrableatt=$duplique->getBriefLivrableAttendus();
        //Suppression du lien entre le brief dupliqué et les livrables attendus
        $duplique->setBriefLivrableAttendu(new ArrayCollection());
        //Duplication du brief dans la BD
        $manager->persist($duplique);
        $manager->flush();
        //Reccupération de chaque livrable attendu du Brief à dupliquer
        foreach ($tab_Brieflivrableatt as $key => $BriefLivrableatt) 
        {
            //Création nouvelle objet BriefLivrableAttendu
            $BriefLivrableAttendu=new BriefLivrableAttendu();
            $livrableAttendu=$BriefLivrableatt->getLivrableAttendu();
            //Affectation du livrableAttendu
            $BriefLivrableAttendu->setLivrableAttendu($livrableAttendu);
            //Affectation du brief dupliqué
            $BriefLivrableAttendu->SetBrief($duplique);
            // Enregistrement du lien entre le brief dupliqué et le livrable attendu
            $manager->persist($BriefLivrableAttendu);
            $manager->flush();
        }
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $duplique->setFormateur($user);
        $duplique->setDateCreation(new \DateTime());
        $manager->persist($duplique);
        $manager->flush();  
        return $this->json($duplique,Response::HTTP_CREATED);  
    }

    /**
     * @Route(
     *     path="api/formateur/promo/{idpromo}/brief/{idbrief}/assignation",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\BriefController::assignationBrief",
     *          "__api_resource_class"=Brief::class,
     *          "__api_collection_operation_name"="assignation_briefs",
     *     }
     * )
    */
    
    

    public function assignationBrief (Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,BriefRepository $brief,PromoRepository $promo,GroupeRepository $groupe,$idpromo,$idbrief)
    {
        $Brief_json = $request -> getContent();
        $Brief_tab = $serializer -> decode($Brief_json,"json");
        if($promo->find($idpromo))
        {
            $Promo=$promo->find($idpromo);
            if ($brief->find($idbrief))
            {
                $Brief=$brief->find($idbrief);
                if (isset ($Brief_tab["groupes"]) && !empty($Brief_tab["groupes"]))
                {
                    foreach ($Brief_tab["groupes"] as $key => $value) 
                    {
                        if (!empty ($value["id"]) && $groupe->find($value["id"])!=null)
                        {
                            if(isset ($value["action"]) && $value["action"]=="affecter")
                            {

                               $Brief->addGroupe($groupe->find($value["id"]));
                               $Promo=$groupe->find($value["id"])->getPromo();
                               $PromoBrief=new PromoBrief();
                               $PromoBrief->setBrief($Brief);
                               $PromoBrief->setPromo($Promo);
                               $PromoBrief->setStatut("assigné");
                               $Brief->addPromoBrief($PromoBrief);
                               $manager->persist($Brief);
                               $manager->flush();
                               $PromoBriefApprenant=new PromoBriefApprenant();
                               $PromoBriefApprenant->setStatut("en cours");
                               $PromoBriefApprenant->addPromoBrief($PromoBrief);
                               $tab=$groupe->find($value["id"])->getApprenants();
                               foreach ($tab as $key => $value) 
                               {
                                   $PromoBriefApprenant->addApprenant($value);
                                   $manager->persist($PromoBriefApprenant);
                                   $manager->flush();
                               }
                                
                            }
                            else
                                if (isset($value["action"]) && $value["action"]=="desaffecter")
                                {
                                    $Promo=$groupe->find($value["id"])->getPromo();
                                    $PromoBriefs=$Brief->getPromoBriefs();
                                    foreach ($PromoBriefs as $key => $PB) {
                                        
                                        if ($PB->getBrief()==$Brief && $PB->getPromo()==$Promo)
                                        {
                                            //("desassigné");
                                            $PromoBrief=$PB;
                                            $PromoBrief->setStatut("désassigné");
                                            break;
                                        }
                                        
                                        
                                    }
                                    
                                    $manager->persist($PromoBrief);
                                    $manager->flush();
                                }
                            
                        }

                    }
                }


            }
        }   
        return $this->json($Brief,Response::HTTP_CREATED);
    }



    /**
     * @Route("/brief", name="brief")
     * @Route(
     *     path="api/formateur/promo/{idpromo}/brief/{idbrief}",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\BriefController::UpdateBrief",
     *          "__api_resource_class"=Brief::class,
     *          "__api_collection_operation_name"="update_briefs",
     *     }
     * )
    */

    public function UpdateBrief(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,BriefRepository $brief,PromoRepository $promo,GroupeRepository $groupe,$idpromo,$idbrief,NiveauRepository $niveaux,TagRepository $tags,RessourceRepository $ress,LivrableAttenduRepository $livrableattendu)
    {
        $Brief_json = $request->getContent();
        $Brief_tab = $serializer->decode($Brief_json,"json");
        if($promo->find($idpromo))
        {
            $Promo=$promo->find($idpromo);
            if ($brief->find($idbrief))
            {
                $Brief=$brief->find($idbrief);
                $PromoBriefs=$Promo->getPromoBriefs();
                $test=0;
                //Test si la promo est liée au brief
                foreach ($PromoBriefs as $key => $PB) 
                {
                    if ($PB->getBrief()==$Brief)
                    {
                        $test=1;
                    }
                    
                }
                // Arrete le prog si ils ne sont pas liés
                if ($test==0)
                {
                        return $this -> json(["message" => "Ce Brief n'est pas lié à la promo donnée"],Response::HTTP_FORBIDDEN);
                }

                if (isset ($Brief_tab["action"]) && !empty ($Brief_tab["action"]))
                {
                    $Brief->setStatut(($Brief_tab["action"]));
                    if (isset ($Brief_tab["niveaux"]) && !empty ($Brief_tab["niveaux"]))
                    {
                        foreach ($Brief_tab["niveaux"] as $key => $niveau) 
                        {
                            if ($niveau["action"]=="ajouter")
                            {
                                $Niveau=$niveaux->find($niveau["id"]);
                                $Brief->addNiveau($Niveau);
                            }
                            else
                                if ($niveau["action"]=="supprimer")
                                {
                                    $Niveau=$niveaux->find($niveau["id"]);
                                    $Brief->RemoveNiveau($Niveau);
                                }
                        }
                    }

                    if (isset ($Brief_tab["tags"]) && !empty ($Brief_tab["tags"]))
                    {
                        foreach ($Brief_tab["tags"] as $key => $tag) 
                        {
                            if ($tag["action"]=="ajouter")
                            {
                                $Tag=$tags->find($tag["id"]);
                                $Brief->addTag($Tag);
                            }
                            else
                                if ($tag["action"]=="supprimer")
                                {
                                    $Tag=$tags->find($tag["id"]);
                                    $Brief->RemoveTag($Tag);
                                }
                        }
                    }

                    if (isset ($Brief_tab["ressources"]) && !empty ($Brief_tab["ressources"]))
                    {
                        foreach ($Brief_tab["ressources"] as $key => $ressource) 
                        {
                            if ($ressource["action"]=="ajouter")
                            {
                                $Ressource=$ress->find($ressource["id"]);
                                $Brief->addRessource($Ressource);
                            }
                            else
                                if ($ressource["action"]=="supprimer")
                                {
                                    $Ressource=$ress->find($ressource["id"]);
                                    $Brief->RemoveRessource($Ressource);
                                }
                        }
                    }

                    if (isset ($Brief_tab["livrableAttendus"]) && !empty ($Brief_tab["livrableAttendus"]))
                    {
                        foreach ($Brief_tab["livrableAttendus"] as $key => $LA) 
                        {
                            
                            if ($LA["action"]=="ajouter")
                            {
                                
                                $livrableAttendu=$livrableattendu->find($LA["id"]);
                                $BriefLivrableAttendu=new BriefLivrableAttendu();
                                //Création du lien dans la table d'association BriefLivrableAttendu
                                $BriefLivrableAttendu->setBrief($Brief);
                                $BriefLivrableAttendu->setLivrableAttendu($livrableAttendu);
                                $Brief->addBriefLivrableAttendu($BriefLivrableAttendu);
                                $manager->persist($BriefLivrableAttendu);
                                $manager->flush();
                            }
                            else
                                if ($LA["action"]=="supprimer")
                                {
                                    $livrableAttendu=$livrableattendu->find($LA["id"]);
                                    $tab=$livrableAttendu->getBriefLivrableAttendus();
                                    foreach ($tab as $key => $briefLA) 
                                    {
                                        
                                        // Vérifie la liaison entre le Brief et le LivrableAttendu
                                        if ($briefLA->getBrief()==$Brief && $briefLA->getLivrableAttendu()==$livrableAttendu)
                                        {
                                            //$Brief->removeBriefLivrableAttendu($briefLA);
                                            //$livrableAttendu->removeBriefLivrableAttendu($briefLA);
                                            $manager->remove($briefLA);
                                            //$manager->persist($briefLA);
                                            $manager->flush();
                                            break;    
                                        }    
                                    }
                                }
                        }
                    }
                }
            $manager->persist($Brief);
            $manager->flush();
            $serializer ->encode($Brief,"json");
            return $this->json($Brief,Response::HTTP_CREATED);
            }
        }

    }

    /**
     * @Route(
     *     path="api/apprenants/{idapp}/groupe/{idgrp}/livrables",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\BriefController::AddLivrable",
     *          "__api_resource_class"=Brief::class,
     *          "__api_collection_operation_name"="add_livrable",
     *     }
     * )
    */

    public function AddLivrable(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,ApprenantRepository $app,LivrableAttenduRepository $livrableattendu,GroupeRepository $grp,$idapp,$idgrp)
    {
        $livrable_json = $request->getContent();
        $livrable_tab = $serializer->decode($livrable_json,"json");
        //Reccupération id Apprenant
        if($app->find($idapp))
        {
            $Apprenant=$app->find($idapp);
        //Reccupération id Groupe
            if($grp->find($idgrp))
            {
                $Groupe=$grp->find($idgrp);
                //Test si l'apprenant fait partie du groupe
                $test=0;
            
                $tab_groupes=$Apprenant->getGroupe();
                foreach ($tab_groupes as $key => $groupe) 
                {
                    if ($groupe==$Groupe)
                    {
                        $test=1;
                        break;
                    }    
                }
                if ($test!=1)
                {
                    return $this -> json (["message" => "Cet apprenant ne fait pas partie du groupe donné"],Response::HTTP_FORBIDDEN);
                }
                else
                
                    if (isset($livrable_tab["livrables"]) && !empty($livrable_tab["livrables"]))
                    {
                        
                        foreach ($livrable_tab as $key => $livrable) 
                        {
                            foreach ($livrable as $key => $value) {
                                
                            
                            if ($livrableattendu->find($value["id"]))
                            {
                                //Reccupération de tous les étudiants du groupe
                                $tab_apprenants=$Groupe->getApprenants();
                                foreach ($tab_apprenants as $key => $apprenant) 
                                {
                                    $Livrable=New Livrable();
                                    $Livrable->setUrl($value["url"]);
                                    //Affecter le livrable à chaque apprenant du groupe
                                    $Livrable->setApprenant($apprenant);
                                    $LivrableAttendu=$livrableattendu->find($value["id"]);
                                    $Livrable->setLivrableAttendu($LivrableAttendu);
                                    $LivrableAttendu->addLivrable($Livrable);
                                    $tab_livrables[]=$Livrable;
                                    $manager->persist($Livrable);
                                    $manager->persist($LivrableAttendu);
                                    $manager->flush();
                                }
                            }
                        }
                    }
                }
                                 
            }
                return $this -> json ($tab_livrables,Response::HTTP_CREATED);
        }
        
    }

    private function Assignation($Brief,$Promo,$Groupe,EntityManagerInterface $manager,\Swift_Mailer $mailer)
    {
        $PromoBrief=new PromoBrief();
        $PromoBrief->setBrief($Brief);
        $PromoBrief->setPromo($Promo);
        $PromoBrief->setStatut("assigné");
        $Brief->addPromoBrief($PromoBrief);
        $manager->persist($Brief);
        $manager->flush();
        $PromoBriefApprenant=new PromoBriefApprenant();
        $PromoBriefApprenant->setStatut("en cours");
        $PromoBriefApprenant->addPromoBrief($PromoBrief);
        $tab=$Groupe->getApprenants();
        foreach ($tab as $key => $apprenant) 
        {
            $PromoBriefApprenant->addApprenant($apprenant);
            
            $message = (new \Swift_Message('Ajout'))
            ->setFrom('admin@gmail.com')
            ->setTo($apprenant->getEmail())
            ->setBody('Bonjour cher(e) apprenant(e) de la Sonatel Academy '.$Promo->getTitre().', vous avez été assigné au brief '.$Brief->getTitre());
                // $mailer->send($message); // on envoie
        }
    }
}
