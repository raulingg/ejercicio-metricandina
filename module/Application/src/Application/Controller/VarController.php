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


/**
 * VarController : Controlador principal para la obtención de datos
 *
 * @package Application\Controller
 * @author Raul Quispe
 */
class VarController extends AbstractActionController
{
    
    /**
     *  usersAction : Obtiene la solicitud GET y POST de los clientes,
     * recibe y procesa los parámetros de filtrado y paginación
     *
     * @return ViewModel
     */
    public function usersAction()
    {
        
        $config = $this->getServiceLocator()->get('Config');
        $userDAO = new UserDao(new DataAccessJsonAdapter($config['JsonAdapterConfig']));
        $cantItemsByPage = $config['JsonAdapterConfig']['cantItemsbyPage'];
        $page = $this->params()->fromRoute('page', 1);

        $postParamsSession = new Container('postParam');
        
        if ($this->getRequest()->isPost()) {
            $postParamsSession->params = $this->getRequest()->getPost();
        }
            
        if ($postParamsSession->params) {
            $queryParams = $this->_createQuery($postParamsSession->params);
            $userDAO->filterDataByQuery($queryParams);
        }

        $cantUsers = $userDAO->getCountUsers();
        $listUsuarios = $userDAO->getUsersByPage($page, $cantItemsByPage);

        
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

    /**
     * @param array $params
     * @return array
     */
    private function _createQuery($params)
    {
        $queryParams = array();
        foreach ($params as $key => $value) {
            if ($value) {
                $queryParams[$key] = $value;
            }
        }
        
        return $queryParams;
    }
    
}
