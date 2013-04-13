<?php

namespace Bedycasa\Bundle\ShopBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BedycasaShopBundle extends Bundle
{
    public function boot()
    {
        $doctrine = $this->container->get('doctrine');
        $doctrine->getEntityManager()->getConfiguration()->addFilter(
            'soft-deleteable',
            'Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter'
        );

        $em = $doctrine->getEntityManager();
        $em->getFilters()->enable('soft-deleteable');
    }
}
