<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ProjectCrudController extends AbstractCrudController

{
        public function configureCrud(Crud $crud): Crud
        {
            return $crud->setFormOptions([
                'csrf_protection' => false,
            ]);
        }
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('body'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('image')
                ->setBasePath('/uploads/projects/')
                ->onlyOnIndex(),
            UrlField::new('githubLink')->setLabel('GitHub Link'),
            UrlField::new('link')->setLabel('Project Link')->hideOnIndex(),
        ];
    }
}
