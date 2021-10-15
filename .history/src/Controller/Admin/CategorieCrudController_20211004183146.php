<!-- <?php

namespace App\Controller\Admin;

use App\Entity\banque\Categorie;
use App\Entity\banque\SousCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PropertyInfo\PropertyListExtractorInterface;

class CategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
            ->setSearchFields(['nomCategorie'])
            ->setDefaultSort(['nomCategorie' => 'ASC'])
            // ...
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('nomCategorie', 'Nom de la Catégorie'),
            AssociationField::new('sousCategorie'),
        ];
    }
} 