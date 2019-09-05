<?php

namespace Blogwithorm\Factory;

use Blogwithorm\Controller\DeleteController;
use Blogwithorm\Model\PostCommandInterface;
use Blogwithorm\Model\PostRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class DeleteControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return DeleteController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DeleteController(
            $container->get(PostCommandInterface::class),
            $container->get(PostRepositoryInterface::class)
        );
    }
}
