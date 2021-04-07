<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Promo;
use App\Entity\Groupe;
use DateTimeInterface;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Entity\Referentiel;
use App\Repository\UserRepository;
use App\Repository\PromoRepository;
use App\Repository\GroupeRepository;
use App\Repository\ProfilRepository;
use App\Entity\StatistiquesCompetences;
use App\Repository\ApprenantRepository;
use App\Repository\FormateurRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReferentielRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;





class PromoController extends AbstractController
{
    /**
     * @Route(
     *     path="/api/admin/promos",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::addPromo",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="add_promo"
     *     }
     * )
    */
    public function addPromo(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,FormateurRepository $formateur_repo, ProfilRepository $profil_repo, ApprenantRepository $apprenant_repo, ReferentielRepository $ref_repo,UserRepository $user_repo,\Swift_Mailer $mailer)
    {
        $promo = $request ->request-> get('promo');
        $promo = json_decode($promo, true);
        $apprenants = $promo['apprenants'];

        $Promo = $serializer ->denormalize($promo, 'App\\Entity\\Promo');
        if ($avatar = $request->files->get("avatar")) {
            $avatar = fopen($avatar->getRealPath(),"rb");
            $Promo -> setAvatar($avatar);
            // fclose($avatar);
        }

        
        $Groupe = new Groupe();
        $Groupe -> setNom('Groupe principal');
        $Groupe -> setDateCreation(new \DateTime());
        $Groupe -> setType('principal');
        $profil = $profil_repo -> findOneByLibelle('APPRENANT');
            foreach ($apprenants as $val) {
                $this ->newApprenant($Promo, $Groupe, $val, $profil, $manager, $mailer); 
            }
        $Promo -> addGroupe($Groupe);        

        // importation fichier Exel d'emails
        if ($doc = $request ->files->get('excelFile')) {
            $file= IOFactory::identify($doc);        
            $reader= IOFactory::createReader($file);
            $spreadsheet=$reader->load($doc);
            $emails_exel= $spreadsheet->getActivesheet()->toArray();
        
            $i = 0;
            while (isset($emails_exel[$i])) {
                $j = 0;
                while (isset($emails_exel[$i][$j])) {
                    if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emails_exel[$i][$j]) && $apprenant_repo->findOneByEmail($emails_exel[$i][$j]) === null) {
                        $this ->newApprenant($Promo, $Groupe, $emails_exel[$i][$j],$profil, $manager, $mailer);                           
                    }
                    $j++;
                }
                $i++;
            }
        // return $this->json($groupe_principal,201);
        }
        
        if (!$this -> isGranted("ROLE_FORMATEUR",$Promo)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        $user = $this->getUser(); //current user
        $Promo -> setUser($user);

        $errors = $validator->validate($Promo);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }

        dd($Promo);
        
        $manager->persist($Promo);
        $manager->flush();
        return $this->json($Promo,Response::HTTP_CREATED);
    }

    /**
     * 
     * Ajout des apprenants dans le groupe principal et envoi de mails
     * 
     */
    public function newApprenant($Promo, $Groupe, $val, $profil, $manager, $mailer){
        $random_val = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $apprenant = new Apprenant();
        $apprenant  ->setUsername(substr(str_shuffle(str_repeat($x=$random_val, ceil(15/strlen($x)) )),1,15)) 
                    -> setPassword(substr(str_shuffle(str_repeat($x=$random_val, ceil(10/strlen($x)) )),1,10))
                    -> setEmail(strtolower($val))
                    -> setProfil($profil);
        $Groupe ->addApprenant($apprenant);
        $statistiquesCompetence = new StatistiquesCompetences();
        $statistiquesCompetence ->setApprenant($apprenant)
                                ->setReferentiel($Promo -> getReferentiel())
                                ->setPromo($Promo);
        foreach ($Promo ->getReferentiel() ->getCompetences() as $Competence) {
            $statistiquesCompetence -> setCompetence($Competence);
            $manager->persist($statistiquesCompetence); 
        }
        $manager->persist($apprenant);
        $manager->persist($statistiquesCompetence);

        $message = (new \Swift_Message('Ajout'))
        ->setFrom('admin@gmail.com')
        ->setTo($apprenant->getEmail())
        ->setBody('Bonjour cher(e) séléctionné(e) Utilsez
        ces infos pour vous connecter à votre promo. Username: '.$apprenant->getUsername().'
        password: '.$apprenant->getPassword())
        ;
        // $mailer->send($message); // on envoie
    }

    
    /**
     * @Route(
     *     path="/api/admin/promos/{id}/apprenants/attente",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::apprenantEnAttente",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="apprenants_attente"
     *     }
     * )
    */
    public function apprenantEnAttente(PromoRepository $promo_repo, $id){
        $promo = new Promo();
        if (!($promo = $promo_repo -> find($id))) {
            return $this ->json("Promo introuvable", Response::HTTP_NOT_FOUND,);
        }
        if (!$this -> isGranted("ROLE_CM",$promo)) {
            return $this -> json(["message" => "l'accès à cette ressource vous est interdit"],Response::HTTP_FORBIDDEN);
        }

        $groupes = $promo -> getGroupes();
        foreach ($groupes as $groupe) {
            if ($groupe -> getType() === 'principal') {//on suppose que le grp principal peut prendre n'importe quelle position
                $Apprenants = $groupe -> getApprenants();
                break;
            }
        }
        $apprenant_attente = [];
        $apprenant_attente['ref_promo'] = $promo -> getReferentiel() -> getLibelle();
        $apprenant_attente['liste'] = "Apprenant non encore connectés";
        foreach ($Apprenants as $Apprenant) {
            if (!($Apprenant -> getLastLogin())) {
                $apprenant_attente[] = $Apprenant;
            }
        }
        // dd($Apprenants);
        return $this -> json($apprenant_attente, Response::HTTP_OK,);
    }

    /**
     * @Route(
     *     path="/api/admin/promos/principal",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::promo_gp_principal",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="promo_gprincipal"
     *     }
     * )
    */
    public function promo_gp_principal(PromoRepository $promo_repo,GroupeRepository $groupe_repo){
        $promo = new Promo();
        if (!$this -> isGranted("ROLE_CM",$promo)) {
            return $this -> json(["message" => "l'accès à cette ressource vous est interdit"],Response::HTTP_FORBIDDEN);
        }
        $promo = $promo_repo -> findAll();
        $Promos = [];
        
        foreach ($promo as $value) {
            $groupes = $value -> getGroupes();
            foreach ($groupes as $groupe) {
                if ($groupe -> getType() === 'principal') { //on suppose que le grp principal peut prendre n'importe quelle position
                    $Apprenants = $groupe -> getApprenants();
                    break;
                }
            }

            $pricipal = [];
            $pricipal['ref_promo'] = $value -> getReferentiel() -> getLibelle();
            $pricipal['groupe'] = $groupe;

            foreach ($Apprenants as $Apprenant) {
                if(($Apprenant -> getLastLogin()))
                    $pricipal['apprenants actifs'] = $Apprenant;
            }
            $Promos[] = $pricipal;
        }
        
     
        return $this -> json($Promos, Response::HTTP_OK,);
    }

    /**
     * @Route(
     *     path="/api/admin/promos/{id}/principal",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::promo_id_gp_principal",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="promo_id_gprincipal"
     *     }
     * )
    */
    public function promo_id_gp_principal(PromoRepository $promo_repo, $id,GroupeRepository $groupe_repo){
        $promo = new Promo();
        if (!$this -> isGranted("ROLE_CM",$promo)) {
            return $this -> json(["message" => "l'accès à cette ressource vous est interdit"],Response::HTTP_FORBIDDEN);
        }
        if (!($promo = $promo_repo -> find($id))) {
            return $this ->json("Promo introuvable", Response::HTTP_NOT_FOUND,);
        }
        $groupe_principal = $groupe_repo -> findGroupePrincipal($promo -> getId());
        $Apprenants = $groupe_principal -> getApprenants();

        $pricipal = [];
        $pricipal['ref_promo'] = $promo -> getReferentiel() -> getLibelle();
        $pricipal['groupe principal'] = $groupe_principal;

        foreach ($Apprenants as $Apprenant) {
            if(($Apprenant -> getLastLogin()))
                $pricipal['apprenants actifs'] = $Apprenant;
            }
     
        return $this -> json($pricipal, Response::HTTP_OK,);
    }


    /**
     * @Route(
     *     path="/api/admin/promos/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::updatePromo",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="update_promo"
     *     }
     * )
    */
    public function updatePromo(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,\Swift_Mailer $mailer,EntityManagerInterface $manager,PromoRepository $promo_repo,ReferentielRepository $ref_repo,ApprenantRepository $apprenant_repo, ProfilRepository $profil_repo, $id){
        $Promo_json = $request -> getContent();
        $Promo_tab = $serializer -> decode($Promo_json,"json");
        $Promo = new Promo();
        if (!($Promo = $promo_repo -> find($id))) {
            return $this ->json("Promo intouvable", Response::HTTP_NOT_FOUND,);
        }
        if (isset($Promo_tab['titre'])) {
            $Promo -> setTitre($Promo_tab['titre']);
        }
        if (isset($Promo_tab['langue'])) {
            $Promo -> setLangue($Promo_tab['langue']);
        }
        if (isset($Promo_tab['lieu'])) {
            $Promo -> setLieu($Promo_tab['lieu']);
        }
        if (isset($Promo_tab['fabrique'])) {
            $Promo -> setFabrique($Promo_tab['fabrique']);
        }
        if (isset($Promo_tab['dateDebut'])) {
            $Promo -> setDateDebut(new \DateTime($Promo_tab['dateDebut']));
        }
        if (isset($Promo_tab['dateFinProvisoire'])) {
            $Promo -> setDateFinProvisoire(new \DateTime($Promo_tab['dateFinProvisoire']));
        }
        if (isset($Promo_tab['descriptif'])) {
            $Promo -> getDescription($Promo_tab['descriptif']);
        }
        $Referentiel_id = isset($Promo_tab['referentiel']['id'])?$Promo_tab['referentiel']['id']:'';
        $Referentiel = new Referentiel();

        if (($Referentiel = $ref_repo -> find($Referentiel_id)) && ($Promo -> getReferentiel() !== $Referentiel)) {
            $Promo -> getReferentiel() -> removePromo($Promo);//une promo peut pas avoir deux ref a la fois
            $Promo -> setReferentiel($Referentiel);
        }

        if (isset($Promo_tab['apprenants'])) {
            $profil = $profil_repo -> findOneByLibelle('APPRENANT');
            $groupes = $Promo -> getGroupes(); 
                foreach ($groupes as $groupe) {
                    if ($groupe -> getType() === 'principal') { //on suppose que le grp principal peut prendre n'importe quelle position
                        $groupe_principal = $groupe; 
                        break;
                    }
                }
                
            foreach ($Promo_tab['apprenants'] as $val) {
                if ($apprenant_repo->findOneByEmail($val['email'])===null) {
                    $this ->newApprenant($Promo, $groupe_principal, $val, $profil, $manager, $mailer);
                }
            }
        }

        if (!$this -> isGranted("ROLE_FORMATEUR",$Promo)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        // $user = $this->get('security.token_storage')->getToken()->getUser();
        // if ($Promo -> getUser() !== $user ) {
        //     return $this -> json(["message" => "Vous n'avez pas crée cette promo"],Response::HTTP_FORBIDDEN);
        // }

        $errors = $validator->validate($Promo);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }
        // dd($Promo);
        $manager->persist($Promo);
        $manager->flush();
        return $this->json($Promo,Response::HTTP_CREATED);
    }

    


    /**
     * @Route(
     *     path="/api/admin/promos/{id}/apprenants",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::gerer_apprenant",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="gerer_apprenants"
     *     }
     * )
    */
    public function gerer_apprenant(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,PromoRepository $promo_repo, ApprenantRepository $apprenant_repo,$id){
        $Promo_json = $request -> getContent();
        $Promo_tab = $serializer -> decode($Promo_json,"json");
        $Promo = new Promo();
        if (!($Promo = $promo_repo -> find($id))) {
            return $this ->json("Promo intouvable", Response::HTTP_NOT_FOUND,);
        }
        if (isset($Promo_tab['action']) && isset($Promo_tab['apprenants'])) {
            $apprenant = new Apprenant();
            if ($Promo_tab['action'] === 'delete') {
                foreach ($Promo_tab['apprenants'] as $value) {
                    if ($apprenant = $apprenant_repo -> find($value['id'])) {
                        $apprenant ->setStatut('archived');
                        $groupe -> removeApprenant($apprenant);// on le retire de tous les groupes
                    }
                }
            }
            elseif ($Promo_tab['action'] === 'add') {
                $groupes = $Promo -> getGroupes();
                foreach ($groupes as $groupe) {
                    if ($groupe -> getType() === 'principal') {
                        foreach ($Promo_tab['apprenants'] as $value) {
                            if ($apprenant = $apprenant_repo -> find($value['id'])) {
                                $groupe -> addApprenant($apprenant);
                            }
                        }
                        break;
                    }
                }
            }
        }

        if (!$this -> isGranted("ROLE_FORMATEUR",$Promo)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($Promo -> getUser() !== $user ) {
            return $this -> json(["message" => "Vous n'avez pas crée cette promo"],Response::HTTP_FORBIDDEN);
        }

        $manager->persist($Promo);
        $manager->flush();
        return $this->json($Promo,Response::HTTP_CREATED);
    }


    /**
     * @Route(
     *     path="/api/admin/promos/{id}/formateurs",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::gerer_formateur",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="gerer_formateurs"
     *     }
     * )
    */
    public function gerer_formateur(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,PromoRepository $promo_repo, FormateurRepository $formateur_repo,$id){
        $Promo_json = $request -> getContent();
        $Promo_tab = $serializer -> decode($Promo_json,"json");
        $Promo = new Promo();
        if (!($Promo = $promo_repo -> find($id))) {
            return $this ->json("Promo intouvable", Response::HTTP_NOT_FOUND,);
        }
        if (isset($Promo_tab['action']) && isset($Promo_tab['formateurs'])) {
            $formateur = new Formateur();
            if ($Promo_tab['action'] === 'delete') {
                foreach ($Promo_tab['formateurs'] as $value) {
                    if ($formateur = $formateur_repo -> find($value['id'])) {
                        $groupe -> removeFormateur($formateur);
                        $formateur -> removePromo($Promo);
                    }
                }
            }
            elseif ($Promo_tab['action'] === 'add') {
                $groupes = $Promo -> getGroupes();
                foreach ($groupes as $groupe) {
                    if ($groupe -> getType() === 'principal') {
                        foreach ($Promo_tab['formateurs'] as $value) {
                            if ($formateur = $formateur_repo -> find($value['id'])) {
                                $trouve = false;
                                if (($formateur_groupe = $formateur -> getGroupe())) {
                                    $groupe -> addFormateur($formateur);
                                    $Promo -> addFormateur($formateur);
                                }
                            }
                        }
                        break;
                    }
                }
            }
            
        }

        if (!$this -> isGranted("ROLE_FORMATEUR",$Promo)) {
            return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
        }

        // $user = $this->get('security.token_storage')->getToken()->getUser();
        // if ($Promo -> getUser() !== $user ) {
        //     return $this -> json(["message" => "Vous n'avez pas crée cette promo"],Response::HTTP_FORBIDDEN);
        // }

        $errors = $validator->validate($Promo);
        if (count($errors)){
            $errors = $serializer->serialize($errors,"json");
            return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
        }

        $manager->persist($Promo);
        $manager->flush();
        return $this->json($Promo,Response::HTTP_CREATED);
    }

    /**
     * @Route(
     *     path="/api/admin/promos/{id}/groupes",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\PromoController::gerer_groupe",
     *          "__api_resource_class"=Promo::class,
     *          "__api_collection_operation_name"="gerer_groupes"
     *     }
     * )
    */
    public function gerer_groupe(Request $request,SerializerInterface $serializer,ValidatorInterface $validator,EntityManagerInterface $manager,PromoRepository $promo_repo, GroupeRepository $groupe_repo, $id){
        $Groupe_json = $request -> getContent();
        $Groupe_tab = $serializer -> decode($Groupe_json,"json");
        $Promo = new Promo();
        if (!($Promo = $promo_repo -> find($id))) {
            return $this ->json("Promo intouvable", Response::HTTP_NOT_FOUND,);
        }

        $Groupe = new Groupe();

        if (isset($Groupe_tab['action'])) {
            switch ($Groupe_tab['action']) {
                case 'archiver':
                    if ($Groupe = $groupe_repo -> find($Groupe_tab['id'])) {
                        $Groupe -> setStatut('archived');
                    }
                    break;
                case 'delete':
                    if ($Groupe = $groupe_repo -> find($Groupe_tab['id'])) {
                        $Groupe -> setStatut('deleted');
                        $Promo -> removeGroupe($Groupe);
                    }
                    break;    
                default:
                    $Groupe ->setNom($Groupe_tab['nom']);
                    $Groupe -> setDateCreation(new DateTime('now'));
                    $Promo ->addGroupe($Groupe);
                    if ($this ->getUser() ->getProfil() ->getLibelle() ==='FORMATEUR') {
                        $Groupe ->addFormateur($this ->getUser());
                    }
                    break;
            }
            if (!$this -> isGranted("ROLE_FORMATEUR",$Promo)) {
                return $this -> json(["message" => "Cette action vous est interdite"],Response::HTTP_FORBIDDEN);
            }
    
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if ($Promo -> getUser() !== $user ) {
                return $this -> json(["message" => "Vous n'avez pas crée cette promo"],Response::HTTP_FORBIDDEN);
            }
            return $this->json('eeeeee');
            $manager->persist($Promo);
            $manager->flush();
            return $this->json($Groupe,Response::HTTP_CREATED);
        }
    }

    /**
     * @Route("/promo", name="promo")
     */
    public function index()
    {
        return $this->render('promo/index.html.twig', [
            'controller_name' => 'PromoController',
        ]);
    }
}
