<?php

// src/Admin/CategoryAdmin.php

namespace App\Controller\Admin;
use KunicMarko\SonataAutoConfigureBundle\Annotation as Sonata;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;


/**
 * @Sonata\AdminOptions(
 *     label="Invoice",
 *     group="Invoices"
 * )
 */
final class InvoiceAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('invoicedate', DateType::class, [
                'widget'=>'single_text',
                'input_format' => 'd-m-Y',
                'attr' => [
                    'style' => 'width: 150px'
                ]
            ])
            ->add('total', MoneyType::class, [
                'attr' => ['readonly' => true],
            ])
            ->add('invoiceitems', CollectionType::class, [
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
                'limit'=>20,
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('invoicedate');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('invoicedate')
            ->add('total', 'currency' , [
                'currency' => '',
                'locale' => 'nl'
        ]);
    }
}