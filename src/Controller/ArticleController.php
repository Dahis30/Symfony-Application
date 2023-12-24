<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/blog', name: 'app_article')]
    public function index(ArticleRepository $repo): Response
    {

        $articles = $repo->findAll();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles'=> $articles ,
        ]);
    }
    #[Route('/blog/{id}', name: 'blog_show')]
    public function show($id , ArticleRepository $repo): Response
    {
        $article = $repo->find($id);
        return $this->render('article/show.html.twig', [
            'controller_name' => 'ArticleController',
            'article'=> $article ,
        ]);
    }
}
