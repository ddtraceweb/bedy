<?php

namespace Bedycasa\Bundle\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductInBasketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('deletedAt')
            ->add('product')
            ->add('basket')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bedycasa\Bundle\ShopBundle\Entity\ProductInBasket',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'bedycasa_bundle_shopbundle_productinbaskettype';
    }
}
