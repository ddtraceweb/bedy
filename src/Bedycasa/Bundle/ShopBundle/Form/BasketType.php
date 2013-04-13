<?php

namespace Bedycasa\Bundle\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BasketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productId')
            ->add('sessionId')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bedycasa\Bundle\ShopBundle\Entity\Basket'
        ));
    }

    public function getName()
    {
        return 'bedycasa_bundle_shopbundle_baskettype';
    }
}
