<?php


namespace User\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserProfileController extends AbstractActionController
{
    /**
     * The "profile" action displays the info about currently logged in user.
     */
    public function indexAction()
    {
        // Use the CurrentUser controller plugin to get the current user.
        $user = $this->currentUser();

        if ($user == null) {
            throw new \Exception('Not logged in');
        }

        return new ViewModel([
            'user' => $user
        ]);
    }

}