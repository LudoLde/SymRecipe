<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CustomerApiController extends AbstractController
{
    #[Route('/customer', name: 'customer.show', methods:['GET'])]
    public function show(CustomerRepository $repository): JsonResponse
    {
        $datacustomers = [];
        $customers = $repository->findAll();
        foreach ($customers as $customer) {
            $datacustomers [] = [
                'firstName'=>$customer->getFirstName(''),
                'lastName'=>$customer->getLastName(''),
                'email'=>$customer->getEmail(''),
                'years'=>$customer->getYears(''),
                'zipCode'=>$customer->getZipCode(''),
            ]
        ;
        }
           
        
        return new JsonResponse($datacustomers);
    }

    #[Route('/customer/new', name: 'customer.new', methods:['POST'])]
    public function new(Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $customer = json_decode($request->getContent(), true);

        $newCustomer = new Customer();
        $newCustomer->setFirstName($customer['firstName'])
        ->setLastName($customer['lastName'])
        ->setemail($customer['email'])
        ->setYears($customer['years'])
        ->setZipCode($customer['zipCode']);

        $manager->persist($newCustomer);
        $manager->flush();

        return new JsonResponse('Customer created');
    }

    #[Route('/customer/edit/{id}', name: 'customer.edit', methods:['PUT'])]
    public function edit(Request $request, EntityManagerInterface $manager, CustomerRepository $repository, $id): JsonResponse
    {
        $customerId = $id;
        $customer = json_decode($request->getContent(), true);

        $editCustomer = $repository->findOneBy(['id'=>$customerId]);

        if(!$editCustomer){
            return new JsonResponse('ID incorrect');
        }else{
            if(isset($customer['firstName']))
            {
                $editCustomer->setFirstName($customer['firstName']);
            }
            if(isset($customer['LastName']))
            {
                $editCustomer->setLastName($customer['LastName']);
            }
            if(isset($customer['email']))
            {
                $editCustomer->setEmail($customer['email']);
            }
            if(isset($customer['years']))
            {
                $editCustomer->setYears($customer['years']);
            }
            if(isset($customer['zipCode']))
            {
                $editCustomer->setZipCode($customer['zipCode']);
            };
   
            $manager->flush();
       
        return new JsonResponse('Customer updated');
    }
        
    }

    #[Route('/customer/delete/{id}', name: 'customer.delete', methods:['DELETE'])]
    public function delete(EntityManagerInterface $manager, CustomerRepository $repository, $id): JsonResponse
    {
        $customerId = $id;
        $customer = $repository->findOneBy(['id'=>$customerId]);
   
        $manager->remove($customer);
        $manager->flush();
        
        return new JsonResponse('Customer delete', 200);
    }
        
    
}
