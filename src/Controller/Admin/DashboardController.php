<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\UniversCrudController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\PersonnagesCrudController;
use App\Entity\Personnages;
use App\Entity\Pouvoirs;
use App\Entity\Skills;
use App\Entity\Univers;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PersonnagesCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Otakufan');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Personnages', 'fas fa-users', Personnages::class);
        yield MenuItem::linkToCrud('Skills', 'fas fa-save', Skills::class);
        yield MenuItem::linkToCrud('Pouvoirs', 'fas fa-fire', Pouvoirs::class);
        yield MenuItem::linkToCrud('Univers', 'fas fa-plane', Univers::class);
        yield MenuItem::linkToRoute('Return to website', 'fa fa-sign-out', 'app_home');
    }
}
