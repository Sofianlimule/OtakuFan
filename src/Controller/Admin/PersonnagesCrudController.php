<?php

namespace App\Controller\Admin;

use App\Entity\Personnages;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

class PersonnagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Personnages::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name'),
            TextField::new('occupation'),
            TextField::new('ranksCultivations')->hideOnIndex(),
            TextField::new('Alias')->hideOnIndex(),
            TextField::new('Status')->hideOnIndex(),
            TextField::new('Genre')->hideOnIndex(),
            TextField::new('Race')->hideOnIndex(),
            TextField::new('proches')->hideOnIndex(),
            TextField::new('amis')->hideOnIndex(),
            TextField::new('ennemies')->hideOnIndex(),
            TextField::new('profession')->hideOnIndex(),
            TextField::new('premierApparition')->hideOnIndex(),
            ImageField::new('imageName')->setUploadDir('public/assets/image/personnages/')->setBasePath('assets/image/personnages/')->hideOnForm(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->setLabel('Image')->onlyOnForms(),
            AssociationField::new('skills'),
            AssociationField::new('pouvoirs'),
            AssociationField::new('univers'),
            TextEditorField::new('histoire'),
        ];
    }
    
}
