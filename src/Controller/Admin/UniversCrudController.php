<?php

namespace App\Controller\Admin;

use App\Entity\Univers;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UniversCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Univers::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextEditorField::new('Description'),
            ImageField::new('imageName')->setUploadDir('public/assets/image/univers/')->setBasePath('assets/image/univers/')->hideOnForm(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->setLabel('Image')->onlyOnForms(),
        ];
    }
    
}
