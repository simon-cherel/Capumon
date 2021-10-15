<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Room;
use App\Entity\Client;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/", name="comment_index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="comment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_show", methods={"GET"})
     */
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_delete", methods={"POST"})
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comment_index', [], Response::HTTP_SEE_OTHER);
    }
    
/**
 * @Route("/addtoroom/{id}", name="comment_addtoroom", methods="GET|POST")
 */
public function addToroom(Request $request, Room $room): Response
{
    $comment = new Comment();
    // already set a room, so as to not need add that field in the form (in commentType)
    $comment->setRoom($room);
    $comment->setCompleted(false);

    $form = $this->createForm(CommentType::class, $comment,
    ['display_room' => false]
    );
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $comment->setCreated(new \DateTime());

    $em = $this->getDoctrine()->getManager();
    $em->persist($comment);
    $em->flush();

    $this->get('session')->getFlashBag()->add('message', 'commentaire bien ajouté à la chambre');

    return $this->redirectToRoute('room_show', array('id' => $room->getId() ));
    }

    return $this->render('comment_period/add.html.twig', [
    'room' => $room,
    'comment' => $comment,
    'form' => $form->createView(),
    ]);
}

/**
 * @Route("/addtoclient/{id}", name="comment_addtoclient", methods="GET|POST")
 */
public function addToclient(Request $request, Client $client): Response
{
    $comment = new Comment();
    // already set a client, so as to not need add that field in the form (in commentType)
    $comment->setClient($client);
    $comment->setCompleted(false);

    $form = $this->createForm(CommentType::class, $comment,
    ['display_client' => false]
    );
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $comment->setCreated(new \DateTime());

    $em = $this->getDoctrine()->getManager();
    $em->persist($comment);
    $em->flush();

    $this->get('session')->getFlashBag()->add('message', 'commentaire bien ajouté au client');

    return $this->redirectToRoute('client_show', array('id' => $client->getId() ));
    }

    return $this->render('comment_period/add.html.twig', [
    'client' => $client,
    'comment' => $comment,
    'form' => $form->createView(),
    ]);
}

}
