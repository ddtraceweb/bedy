<?php

namespace Bedycasa\Bundle\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Basket
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bedycasa\Bundle\ShopBundle\Entity\BasketRepository")
 */
class Basket
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id" )
     *
     * @Assert\Type(type="Bedycasa\ShopBundle\Entity\Product")
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="session_id", type="string")
     */
    private $sessionId;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product = null)
    {
        $this->product = $product;
    }

    /**
     * Set sessionId
     *
     * @param integer $sessionId
     *
     * @return Basket
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return integer
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }
}
