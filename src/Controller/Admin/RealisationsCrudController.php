<?php

namespace App\Controller\Admin;

use App\Entity\Realisations;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RealisationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Realisations::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Titre'),
            TextField::new('Soustitre'),
            ImageField::new('Image')
            ->setBasePath('img/') // cherche dans ce dossier
            ->setUploadDir('public/img/') //
            ->setUploadedFileNamePattern('[randomhash].[extension]') // maniere d'encodage du nom dans ma bdd
            ->setRequired(false), 

        ];
    }
}
