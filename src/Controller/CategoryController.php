<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(CategoryRepository $categoryRepository, ProgramRepository $programRepository, ?string $categoryName): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);
        $programs = $programRepository->findBy(['category' => $category], ['id' => 'DESC'], 3, 0);

        return $this->render('category/show.html.twig', ['programs' => $programs, 'category' => $category]);
    }
}