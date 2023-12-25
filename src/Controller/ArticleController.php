<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/blog/new', name: 'blog_create')]
    public function create(Request $request ,EntityManagerInterface $manager): Response
    {    
        if ($request->request->count()>0){
            $article = new Article;
            $article->setTitle($request->request->get('title'))
                    ->setContent($request->request->get('content'))
                    ->setImage($request->request->get('image'))
                    ->setCreatedAt(new \DateTimeImmutable());
                    $manager->persist($article);
                    $manager->flush();
                    return  $this->redirectToRoute('blog_show',['id' => $article->getId()]);
        }
        return $this->render('article/create_blog.html.twig', [
            'controller_name' => 'ArticleController',
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
