<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/program', name: 'program')]
class ProgramController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

    #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: '_show')]
    public function show(int $id): Response
    {
        return $this->render('program/show.html.twig', ['id' => $id]);
    }
}
