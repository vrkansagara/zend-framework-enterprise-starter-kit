<?php


namespace Application\Controller;

use Carbon\Carbon;
use Zend\Form\Element\DateTime;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class PingController extends AbstractActionController
{
    public function indexAction()
    {
        $responseData = [
            'time' => Carbon::now()
        ];
        return new JsonModel($responseData);
    }
}
