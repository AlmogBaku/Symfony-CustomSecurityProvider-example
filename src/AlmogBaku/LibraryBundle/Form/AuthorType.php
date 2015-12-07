<?php

namespace AlmogBaku\LibraryBundle\Form;

use AlmogBaku\ApiBundle\Form\RestFormSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('full_name')
            ->add('birthday', "datetime", ['widget'=>'single_text'])
            ->add('genere')
        ;
        $builder->addEventSubscriber(new RestFormSubscriber());
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_extra_fields' => true,
            'data_class' => 'AlmogBaku\LibraryBundle\Entity\Author',
            'csrf_protection'   => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
