<?php

namespace   App\Services;

use Faker\Factory;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserServices{

    public function setCommonProperties($request, $encoder, $serializer, $validator, $profil,$manager, $id=null){
        // dd($request->request->all());
        $user = $request->request->all();
        if (!isset($user["profil_id"])) {
            return new JsonResponse('profil obligatoire',Response::HTTP_BAD_REQUEST,[],true);
        }
        $role = $profil -> find($user["profil_id"]);
        $faker = Factory::create('fr_FR');
        if (!isset($user["username"])) {
            $user["username"] = strtolower($faker->name);
        }
        if (!isset($user['adresse'])) {
            $user['adresse'] = $faker->address;
        }
        if (!isset($user['password'])) {
            $user['password'] = 'passe';
        }
        
       if (!isset($id)) {
            $actor = $role -> getLibelle() !== "CM" ? ucfirst(strtolower($role -> getLibelle())):"CM";
            if ($actor==='Admin') {
                $actor = 'User';
            }
            if ($avatar = $request->files->get("avatar")) {
                $avatar = fopen($avatar->getRealPath(),"rb");
                $user['avatar'] = $avatar;
            }

            $user = $serializer->denormalize($user,"App\\Entity\\".$actor);
            $errors = $validator->validate($user);
            if (count($errors)){
                $errors = $serializer->serialize($errors,"json");
                return new JsonResponse($errors,Response::HTTP_BAD_REQUEST,[],true);
            }
        
            $password = $user->getPassword();
            $user->setPassword($encoder->encodePassword($user,$password));
            $user -> setProfil($role);
            $manager ->persist($user);
            $manager ->flush();
            $res = $user;
       }
        elseif ($existedUser = $manager -> getRepository(User::class) -> find($id) ) {
            $existedUser -> setNom($user['nom']);
            $existedUser -> setPrenom($user['prenom']);
            $existedUser -> setUsername($user['username']);
            $existedUser -> setEmail($user['email']);
            $existedUser -> setAdresse($user['adresse']);
            if ($existedUser -> getProfil()!==$role) {
                $existedUser -> setProfil($role);
            }
            if ($avatar = $request->files->get("avatar")) {
                $avatar = fopen($avatar->getRealPath(),"rb");
                $existedUser -> setAvatar($avatar);
            }
            $res = $existedUser;
            $manager ->flush();
        }

        if (isset($avatar)) {
            fclose($avatar);
        }
        return $res;
    }
}
