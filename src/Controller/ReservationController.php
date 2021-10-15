<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Client;
use App\Entity\UnavailablePeriod;
use App\Entity\Room;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    /**
     * @Route("/", name="reservation_index", methods={"GET"})
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
    }
      
/**
 * @Route("/addtoroom/{id}", name="reservation_addtoroom", methods="GET|POST")
 */
public function addToroom(Request $request, Room $room): Response
{
    $reservation = new Reservation();
    // already set a room, so as to not need add that field in the form (in reservationType)
    $reservation->setRoom($room);
    $reservation->setCompleted(false);

    $form = $this->createForm(ReservationType::class, $reservation,
    ['display_room' => false]
    );
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $reservation->setCreated(new \DateTime());

    $em = $this->getDoctrine()->getManager();
    $em->persist($reservation);
    $em->flush();

    $this->get('session')->getFlashBag()->add('message', 'tâche bien ajoutée au projet');

    return $this->redirectToRoute('room_show', array('id' => $room->getId() ));
    }

    return $this->render('reservation_period/add.html.twig', [
    'room' => $room,
    'reservation' => $reservation,
    'form' => $form->createView(),
    ]);
}

/**
 * @Route("/addtounavailable/{id}", name="reservation_addtounavailable", methods="GET|POST")
 */
public function addTounavailable(Request $request, UnavailablePeriod $unavailable): Response
{
    $reservation = new Reservation();
    // already set an unavailability, so as to not need add that field in the form (in reservationType)
    $reservation->setUnavailablePeriod($unavailable);
    $reservation->setCompleted(false);

    $form = $this->createForm(ReservationType::class, $reservation,
    ['display_unavailable' => false]
    );
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $reservation->setCreated(new \DateTime());

    $em = $this->getDoctrine()->getManager();
    $em->persist($reservation);
    $em->flush();

    $this->get('session')->getFlashBag()->add('message', 'indisponibilité bien ajoutée a Reservation');

    return $this->redirectToRoute('unavailable_show', array('id' => $unavailable->getId() ));
    }

    return $this->render('reservation_period/add.html.twig', [
    'unavailable' => $unavailable,
    'reservation' => $reservation,
    'form' => $form->createView(),
    ]);
}

/**
 * @Route("/addtoclient/{id}", name="reservation_addtoclient", methods="GET|POST")
 */
public function addToclient(Request $request, Client $client): Response
{
    $reservation = new Reservation();
    // already set a client, so as to not need add that field in the form (in reservationType)
    $reservation->setClient($client);
    $reservation->setCompleted(false);

    $form = $this->createForm(ReservationType::class, $reservation,
    ['display_client' => false]
    );
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $reservation->setCreated(new \DateTime());

    $em = $this->getDoctrine()->getManager();
    $em->persist($reservation);
    $em->flush();

    $this->get('session')->getFlashBag()->add('message', 'reservation bien ajoutée au client');

    return $this->redirectToRoute('client_show', array('id' => $client->getId() ));
    }

    return $this->render('reservation_period/add.html.twig', [
    'client' => $client,
    'reservation' => $reservation,
    'form' => $form->createView(),
    ]);
}

}
