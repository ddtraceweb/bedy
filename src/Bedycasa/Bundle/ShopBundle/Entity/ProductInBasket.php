<?php
namespace Bedycasa\Bundle\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as GEDMO;

/**
 * ProductInBasket
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bedycasa\Bundle\ShopBundle\Entity\ProductInBasketRepository")
 * @GEDMO\SoftDeleteable(fieldName="deletedAt")
 */
class ProductInBasket
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
     * @var Basket
     *
     * @ORM\ManyToOne(targetEntity="Basket", cascade={"all"})
     * @ORM\JoinColumn(name="basket_id", referencedColumnName="id" )
     *
     * @Assert\Type(type="Bedycasa\ShopBundle\Entity\Product")
     */
    private $basket;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;
    }

    /**
     * @return Basket
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param Basket $basket
     */
    public function setBasket(Basket $basket = null)
    {
        $this->basket = $basket;
    }

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

}