<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('account/calendar', name: 'app_calendar')]
    public function index(): Response
    {
        return $this->render('account/calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
}
