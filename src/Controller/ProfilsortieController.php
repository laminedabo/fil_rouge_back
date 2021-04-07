<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use App\Repository\ProfilsortieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProfilsortieController extends AbstractController
{
    /**
     * @Route(
     *     path="/api/admin/promos/{id}/profilsorties",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\ProfilsortieController::profilsortie_collection",
     *          "__api_resource_class"=Profilsortie::class,
     *          "__api_collection_operation_name"="profilsortie_promo"
     *     }
     * )
    */
    public function profilsortie_collection(PromoRepository $repopromo,int $id, ProfilsortieRepository $profilsortierepo)
    {
        if(!$promo=$repopromo->find($id))
        { 
            return $this->json("error", Response::HTTP_NOT_FOUND);
        
        }
        $profilsorties=$profilsortierepo->findAll();
        // $profilsorties=$profilsortierepo->getApprenantByProfilSorite($id);
        foreach ($profilsorties as $profilsortie) {

        
            foreach ($profilsortie -> getApprenants() as $key => $apprenant) {
                if ( $apprenant->getGroupe()[0] ->getPromo()  !== $promo ) {

                    $profilsortie->removeApprenant($apprenant);

                }
                

            }
        }
        return $this->json($profilsorties,Response::HTTP_OK,[],['groups'=>['profilsortie_apprenants_read']] );
    }

    /**
     * @Route(
     *     path="/api/admin/promos/{idp}/profilsorties/{id}",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\ProfilsortieController::profilsortie_item",
     *          "__api_resource_class"=Profilsortie::class,
     *          "__api_collection_operation_name"="profilsortie_item"
     *     }
     * )
    */
    public function profilsortie_item(PromoRepository $repopromo,int $id,int $idp, profilSortieRepository $profilsortierepo)
    {
        if(!$promo=$repopromo->find($idp))
        { 
            return $this->json("error", Response::HTTP_NOT_FOUND);
        
        }
        if(! $profilsortie=$profilsortierepo->find($id))
        { 
            return $this->json("error", Response::HTTP_NOT_FOUND);
        
        }
        foreach ($profilsortie -> getApprenants() as $key => $apprenant) {
            if ( $apprenant->getGroupe()[0] ->getPromo()  !== $promo ) {

                $profilsortie->removeApprenant($apprenant);


            }
           
        }
        return $this->json($profilsortie,Response::HTTP_OK,[],['groups'=>['profilsortie_apprenants_read']]);
    }

}
