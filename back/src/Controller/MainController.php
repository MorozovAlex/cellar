<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->session->start();
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig',
            [
                'title' => 'Главная страница',
            ]
        );
    }

    #[Route('/list', name: 'shopList')]
    public function shopList(): Response
    {
        return $this->render('index/index.html.twig');
    }

    #[Route('/item/{slug}', name: 'shopItem')]
    public function shopItem(): Response
    {
        return $this->render('index/index.html.twig');
    }
}