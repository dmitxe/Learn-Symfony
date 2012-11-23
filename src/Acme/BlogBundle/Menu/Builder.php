<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace Acme\BlogBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

/*        $url1 = $this->get('router')->generate('acme_demo', array());
        $url2 = $this->get('router')->generate('acme_blog_default_show', array('id' => 1));
        $menu->addChild('Home', array('route' => $url1));
        $menu->addChild('About Me', $url2);*/
        $menu->addChild('Главная', array('route' => 'acme_demo'));
        $menu->addChild('About Me', array(
            'route' => 'acme_blog_default_show',
            'routeParameters' => array('id' => 1)
        ));
        // ... add more children

        return $menu;
    }
}