<?php

namespace Bedycasa\Bundle\ShopBundle\Controller;

use Bedycasa\Bundle\ShopBundle\Entity\Basket;
use Bedycasa\Bundle\ShopBundle\Form\BasketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        $em = $this->getDoctrine()->getManager();

        $productsArray = $em->getRepository('BedycasaShopBundle:Product')->getProducts();

        $basket = new Basket();

        $form = $this->createFormBuilder($basket)
          ->add(
              'productId',
              'choice',
              array(
                  'choices'  => $productsArray,
                  'required' => false,
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

        $basketEntity = new Basket();
        $basketEntity->setSessionId(1234);

        $valuesForm = $request->request->get('form');

        $basketEntity->setProductId($valuesForm['productId']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($basketEntity);
        $em->flush();

        return $this->redirect($this->generateUrl('index'));
    }
}
