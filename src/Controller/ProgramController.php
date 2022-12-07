<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);


        return $this->render('program/show.html.twig', ['id' => $id, 'program' => $program]);
    }

    #[Route('/{programId}/season/{seasonId}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository)
    {
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        $program = $programRepository->findOneBy(['id' => $programId]);
        $episodes = $episodeRepository->findAll();

        return $this->render('program/season_show.html.twig', ['programId' => $programId, 'seasonId' => $seasonId, 'season' => $season, 'program' => $program, 'episodes' => $episodes]);
    }
}
