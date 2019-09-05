<?php

namespace Blogwithorm\Controller;

use Blogwithorm\Model\PostRepositoryInterface;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Zend\Barcode\Barcode;
use function Couchbase\defaultDecoder;

class ListController extends AbstractActionController
{

    private $postRepository;

    /**
     * We override the parent class' onDispatch() method to
     * set an alternative layout for all actions in this controller.
     */
    public function onDispatch(MvcEvent $e)
    {
        // Call the base class' onDispatch() first and grab the response
        $response = parent::onDispatch($e);

        // Set alternative layout
        $this->layout()->setTemplate('layout/layout');
        $layoutData = [
            'company' => 'XYZ Co.'
        ];
        $this->layout()->setVariables($layoutData);

        // Return the response
        return $response;
    }


    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $currentEvent = $this->getEvent();
        return new ViewModel([
            'posts' => $this->postRepository->findAllPosts(true),
        ]);
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');
        try {
            $post = $this->postRepository->findPost($id);
        } catch (\InvalidArgumentException $ex) {
//            throw new \Exception($ex->getMessage());
            return $this->redirect()->toRoute('blog');
        }
        return new ViewModel([
            'post' => $post
        ]);
    }

    // The "barcode" action
    public function barcodeAction()
    {
        // Get parameters from route.
        $type = $this->params()->fromRoute('type', 'code39');
        $label = $this->params()->fromRoute('label', 'VRKANSAGARA');

        // Set barcode options.
        $barcodeOptions = ['text' => $label];
        $rendererOptions = [];

        // Create barcode object
        $barcode = Barcode::factory($type, 'image', $barcodeOptions, $rendererOptions);

        // The line below will output barcode image to standard
        // output stream.
        $barcode->render();

        // Return Response object to disable default view rendering.
        return $this->getResponse();
    }
}
