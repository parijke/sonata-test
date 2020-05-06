<?php

// src/Admin/CategoryAdmin.php

namespace App\Controller\Admin;

use KunicMarko\SonataAutoConfigureBundle\Annotation as Sonata;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Sonata\AdminOptions(showInDashboard=false)
 */
final class InvoiceItemAdmin extends AbstractAdmin
{
    // There's no need for a direct route to list invoice-items outside the scope
    // of an invoice
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('list');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('description', TextType::class);
        $formMapper->add('count', NumberType::class);
        $formMapper->add('price', MoneyType::class);
        $formMapper->add('vat', PercentType::class);
        $formMapper->add('total', MoneyType::class,[
            'attr' => ['readonly' => true],
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('description');
    }


}