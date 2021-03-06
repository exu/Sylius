<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\CartBundle\Twig;

use Sylius\Bundle\CartBundle\Templating\Helper\CartHelper;
use Sylius\Component\Cart\Model\CartInterface;
use Symfony\Component\Form\FormView;

/**
 * Sylius cart engine twig extension.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class CartExtension extends \Twig_Extension
{
    /**
     * @var CartHelper
     */
    private $helper;

    /**
     * Constructor.
     *
     * @param CartHelper $helper
     */
    public function __construct(CartHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
             new \Twig_SimpleFunction('sylius_cart_exists', array($this, 'hasCart')),
             new \Twig_SimpleFunction('sylius_cart_get', array($this, 'getCurrentCart')),
             new \Twig_SimpleFunction('sylius_cart_form', array($this, 'getItemFormView')),
        );
    }

    /**
     * Returns current cart.
     *
     * @return null|CartInterface
     */
    public function getCurrentCart()
    {
        return $this->helper->getCurrentCart();
    }

    /**
     * Check if a cart exists.
     *
     * @return Boolean
     */
    public function hasCart()
    {
        return $this->helper->hasCart();
    }

    /**
     * Returns cart item form view.
     *
     * @param array $options
     *
     * @return FormView
     */
    public function getItemFormView(array $options = array())
    {
        return $this->helper->getItemFormView($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_cart';
    }
}
