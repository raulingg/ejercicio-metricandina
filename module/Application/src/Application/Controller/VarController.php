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
    
    /**
     * 
     * @return ViewModel
     */
    public function usersAction()
    {
        
        $config = $this->getServiceLocator()->get('Config');
        $cantItemsByPage = $config['JsonAdapterConfig']['cantItemsbyPage'];
        $page = $this->params()->fromRoute('page') ? : 1;
        $adapter = new DataAccessJsonAdapter();
        $adapter->setConfig($config['JsonAdapterConfig']);
        $userDAO = new UserDao($adapter);
        $postParamsSession = new Container('postParam');
        
        if ($this->getRequest()->isPost()) {
            $postParams = $this->getRequest()->getPost();
            $queryParams = $this->_createQuery($postParams);
            $postParamsSession->params = $postParams;
        }
            
        if ($postParamsSession->params) {
            $queryParams = $this->_createQuery($postParamsSession->params);
            $userDAO->filterDataByQuery($queryParams);
        } 
        
        $listUsuarios = $userDAO->getUsersByPage($page, $cantItemsByPage);   
        $cantUsers = count($listUsuarios);
        
        if ($cantUsers % $cantItemsByPage == 0) {
            $cantPages = $cantUsers / $cantItemsByPage;
        } else {
            $cantPages = $cantUsers / $cantItemsByPage + 1;
        }
        
        return new ViewModel(
            array(
                "usuarios" => $listUsuarios ? : null,
                "cantPages" => $cantPages ? : 1,
                'post' => $postParamsSession->params ?  : null
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
