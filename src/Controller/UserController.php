<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserFormType;

class UserController extends AbstractController
{
    #[Route('/user/new', name: 'user.new')]
    public function userNew(EntityManagerInterface $manager, Request $request, ): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
