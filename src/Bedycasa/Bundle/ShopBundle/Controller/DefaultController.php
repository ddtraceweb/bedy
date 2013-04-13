<?php

namespace Bedycasa\Bundle\ShopBundle\Controller;

use Bedycasa\Bundle\ShopBundle\Entity\Basket;
use Bedycasa\Bundle\ShopBundle\Entity\ProductInBasket;
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
        $session = new Session();
        $session->start();

        $em     = $this->getDoctrine()->getManager();
        $basket = $em->getRepository('BedycasaShopBundle:Basket')->findOneBySessionId($session->getId());

        if (!$basket) {
            $basketEntity = new Basket();
            $basketEntity->setSessionId($session->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($basketEntity);
            $em->flush();
            $basket = $em->getRepository('BedycasaShopBundle:Basket')->findOneBySessionId($session->getId());
        }

        $productInBasket = new ProductInBasket();

        $em                       = $this->getDoctrine()->getManager();
        $productEntitiesInSession = $em->getRepository('BedycasaShopBundle:ProductInBasket')->findByBasket($basket);

        $form = $this->createFormBuilder($productInBasket)
          ->add(
              'product',
              'entity',
              array(
                  'class'    => 'BedycasaShopBundle:Product',
                  'property' => 'name',
                  'required' => true,
                  'expanded' => true,
                  'multiple' => false
              )
          )
          ->getForm();

        return array(
            'productEntitiesInSession' => $productEntitiesInSession,
            'form'                     => $form->createView(),
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

        $productInBasketEntity = new ProductInBasket();

        $em     = $this->getDoctrine()->getManager();
        $basket = $em->getRepository('BedycasaShopBundle:Basket')->findOneBySessionId($session->getId());

        if (!$basket) {
            throw $this->createNotFoundException('Unable to find Basket entity.');
        }

        $productInBasketEntity->setBasket($basket);

        $productInBasketEntity->setCreatedAt(new \DateTime());

        $valuesForm = $request->request->get('form');

        $em            = $this->getDoctrine()->getManager();
        $productEntity = $em->getRepository('BedycasaShopBundle:Product')->find($valuesForm['product']);

        if (!$productEntity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $productInBasketEntity->setProduct($productEntity);

        $em = $this->getDoctrine()->getManager();
        $em->persist($productInBasketEntity);
        $em->flush();

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/delete", name="basket_delete")
     * @Method("GET")
     * @Template()
     */
    public function deleteProductInBasketAction()
    {
        $session = new Session();
        $session->start();

        $em     = $this->getDoctrine()->getManager();
        $basket = $em->getRepository('BedycasaShopBundle:Basket')->findOneBySessionId($session->getId());

        $em                      = $this->getDoctrine()->getManager();
        $productInBasketEntities = $em->getRepository('BedycasaShopBundle:ProductInBasket')->findByBasket($basket);

        $em = $this->getDoctrine()->getManager();

        foreach ($productInBasketEntities as $productInBasketEntity) {
            $em->remove($productInBasketEntity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('index'));
    }
}
