<?php

namespace Blogwithorm\Factory;

use Blogwithorm\Controller\WriteController;
use Blogwithorm\Form\PostForm;
use Blogwithorm\Model\PostCommandInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Blogwithorm\Model\PostRepositoryInterface;

class WriteControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return WriteController|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formManager = $container->get('FormElementManager');

        return new WriteController(
            $container->get(PostCommandInterface::class),
            $formManager->get(PostForm::class),
            $container->get(PostRepositoryInterface::class)
        );
    }
}
