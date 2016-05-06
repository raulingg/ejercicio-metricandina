<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\Adapter\DataAccessJsonAdapter;
use Application\Model\DAO\UserDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class VarController extends AbstractActionController
{
    
    
    public function usersAction()
    {
        
        $config = $this->getServiceLocator()->get('Config');
        $cantItemsPorPage = $config['JsonAdapterConfig']['cantItemsbyPage'];
        $page = $this->params()->fromRoute('page') ? : 1;
        $adapter = new DataAccessJsonAdapter();
        $adapter->setConfig($config['JsonAdapterConfig']);
        $userDAO = new UserDao($adapter);
        $session = new Container('sesion');
        
        if ($this->getRequest()->isPost()) {
            
            $postParams = $this->getRequest()->getPost();
            $queryParams = $this->_createQuery($postParams);
            
            if ($queryParams){
                $listUsuarios = $userDAO->getUserByQuery($queryParams);
                $cantUsers = count($listUsuarios);
                $session->post = $postParams;
            } else{
                $listUsuarios = $userDAO->getUsersForPage($page, $cantItemsPorPage);
                $cantUsers = $userDAO->getCountUsers();
                $session->post = null;
            }
            
        } else {
            
            if ($session->post) {
                $queryParams = $this->_createQuery($session->post);
                $listUsuarios = $userDAO->getUserByQuery($queryParams);
                $cantUsers = count($listUsuarios);
            } else {
                $listUsuarios = $userDAO->getUsersForPage($page, $cantItemsPorPage);
                $cantUsers = $userDAO->getCountUsers();
            }
           
        }
        

        if ($cantUsers % $cantItemsPorPage == 0) {
            $cantPages = $cantUsers / $cantItemsPorPage;
        } else {
            $cantPages = $cantUsers / $cantItemsPorPage + 1;
        }
        
        return new ViewModel(
            array(
                "usuarios" => $listUsuarios ? : null,
                "cantPages" => $cantPages ? : 1,
                'post' => $session->post ? : array()
            )
        );
        
    }
    
    private function _createQuery($postParams)
    {
        $queryParams  = array();
        foreach ($postParams as $key => $value) {
            if ($value) {
               $queryParams[$key] =  $value;
            }
        }
        
        return $queryParams;
    }
    
}
