<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;


use Symfony\Component\HttpFoundation\Request;



class HomeController extends AbstractController
{

    

    /**
     * @Route("/", name="home")
     */
    function index(RoomRepository $roomRepository): Response
    {   
        $rooms=$roomRepository->findAll();
        /*
        $pivot=$rooms[0];
        for($i=0;$i<count($rooms);$i++){
            if($rooms[$i].Created>$rooms[$i+1].Created){
                $pivot=$rooms[$i];
            }else{
                $pivot=$rooms[$i+1];
            }
        }
        */
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
            'welcome' => 'Welcome',
            'rooms' => $rooms,
        ]);
    }

    /**
     * @Route("/sign-up", name="sign-up")
     */
    public function index2(): Response
    {
        return $this->render('sign-up.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function index3(): Response
    {
        return $this->render('login.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }



    
}
