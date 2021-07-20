<?php

namespace App\Controller\Admin;

use App\Entity\Classification;
use App\Entity\Commentaire;
use App\Entity\Style;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Holacine');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Classification', 'fas fa-child', Classification::class);
        yield MenuItem::linkToCrud('Style', 'fas fa-list', Style::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-envelope', Commentaire::class);
    }
}
