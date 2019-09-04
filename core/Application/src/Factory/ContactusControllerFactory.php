<?php

namespace Application\Factory;

use Application\Controller\ContactusController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Service\MailSender;

class ContactusControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $mailSender = $container->get(MailSender::class);

        // Instantiate the controller and inject dependencies
        return new ContactusController($mailSender);
    }
}