<?php

// src/Admin/CategoryAdmin.php

namespace App\Controller\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class TodoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('startdate', DateType::class,['widget'=>'single_text', 'input_format' => 'd-m-Y']);
        $formMapper->add('enddate', DateType::class,['widget'=>'single_text', 'input_format' => 'd-m-Y']);
        $formMapper->add('status', TextType::class);
        $formMapper->add('description', TextareaType::class,
            [
                'attr' => ['style' => 'height: 300px'],
            ]
        );
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