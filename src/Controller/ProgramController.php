<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Form\ProgramType;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
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

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();

        $form = $this->createForm(ProgramType::class, $program);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programRepository->save($program, true);
        }

        return $this->renderForm('program/new.html.twig', ['form' => $form]);
    }

    #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d+'], name: 'show')]
    public function show(Program $program): Response
    {
        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    #[Route('/{programId}/season/{seasonId}/', methods: ['GET'], requirements: ['id' => '\d+'], name: 'season_show')]
    public function showSeason(Program $programId, Season $seasonId): Response
    {
        $episodes = $seasonId->getEpisodes();

        return $this->render('program/season_show.html.twig', ['program' => $programId, 'season' => $seasonId, 'episodes' => $episodes]);
    }

    #[Route('/{programId}/season/{seasonId}/episode/{episodeId}/', methods: ['GET'], name: 'program_episode_show')]
    public function episodeShow(Program $programId, Season $seasonId, Episode $episodeId): Response
    {
        return $this->render('program/episode_show.html.twig', ['program' => $programId, 'season' => $seasonId, 'episode' => $episodeId]);
    }
}
