<?php

namespace Bedycasa\Bundle\ShopBundle\Controller;

use Bedycasa\Bundle\ShopBundle\Entity\Basket;
use Bedycasa\Bundle\ShopBundle\Entity\Product;
use Bedycasa\Bundle\ShopBundle\Form\BasketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $basket = new Basket();

        $form = $this->createFormBuilder($basket)
          ->add(
              'product',
              'entity',
              array(
                  'class'  => 'BedycasaShopBundle:Product',
                  'property' => 'name',
                  'required' => true,
                  'expanded' => true,
                  'multiple' => false
              )
          )
          ->getForm();

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/", name="basket_add")
     * @Method("POST")
     * @Template()
     */
    public function basketAddAction(Request $request)
    {
        $session = new Session();
        $session->start();

        $basketEntity = new Basket();
        $basketEntity->setSessionId($session->getId());

        $valuesForm = $request->request->get('form');

        $em = $this->getDoctrine()->getManager();
        $productEntity = $em->getRepository('BedycasaShopBundle:Product')->find($valuesForm['product']);

        if (!$productEntity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $basketEntity->setProduct($productEntity);

        $em = $this->getDoctrine()->getManager();
        $em->persist($basketEntity);
        $em->flush();

        return $this->redirect($this->generateUrl('index'));
    }
}
