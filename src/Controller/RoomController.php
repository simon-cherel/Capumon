<?php

namespace App\Controller;

use App\Entity\Room;
use App\Entity\Region;
use App\Entity\Owner;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room")
 */
class RoomController extends AbstractController
{
    /**
     * @Route("/", name="room_index", methods={"GET"})
     */
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('room/index.html.twig', [
            'rooms' => $roomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="room_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Change content-type according to image's
            $imagefile = $room->getImageFile();
            if($imagefile) {
                $mimetype = $imagefile->getMimeType();
                $room->setContentType($mimetype);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('room/new.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_show", methods={"GET"})
     */
    public function show(Room $room): Response
    {
        return $this->render('room/show.html.twig', [
            'room' => $room,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="room_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Room $room): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('room/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_delete", methods={"POST"})
     */
    public function delete(Request $request, Room $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room);
            $entityManager->flush();
        }

        return $this->redirectToRoute('room_index', [], Response::HTTP_SEE_OTHER);
    }

    
/**
 * @Route("/addtoowner/{id}", name="room_addtoowner", methods="GET|POST")
 */
    public function addToowner(Request $request, Owner $owner): Response
    {
    $room = new Room();
    // already set an owner, so as to not need add that field in the form (in RoomType)
    $room->setOwner($owner);

    $form = $this->createForm(RoomType::class, $room,
    ['display_owner' => false]
    );
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $room->setCreated(new \DateTime());

    $em = $this->getDoctrine()->getManager();
    $em->persist($room);
    $em->flush();

    $this->get('session')->getFlashBag()->add('message', 'chambre bien ajoutée au propriétaire');

    return $this->redirectToRoute('owner_show', array('id' => $owner->getId() ));
    }

    return $this->render('room/add.html.twig', [
    'owner' => $owner,
    'room' => $room,
    'form' => $form->createView(),
    ]);
}

/**
 * @Route("/addtoregion/{id}", name="room_addtoregion", methods="GET|POST")
 */
public function addToregion(Request $request, Region $region): Response
{
$room = new Room();
// already set an region, so as to not need add that field in the form (in RoomType)
$room->setRegion($region);

$form = $this->createForm(RoomType::class, $room,
['display_region' => false]
);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$room->setCreated(new \DateTime());

$em = $this->getDoctrine()->getManager();
$em->persist($room);
$em->flush();

$this->get('session')->getFlashBag()->add('message', 'chambre bien ajoutée à la region');

return $this->redirectToRoute('region_show', array('id' => $region->getId() ));
}

return $this->render('room/add.html.twig', [
'region' => $region,
'room' => $room,
'form' => $form->createView(),
]);
}

}
