<?php

namespace App\Controller\Admin;

use App\Entity\Univers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UniversCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Univers::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
