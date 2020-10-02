<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Http\Exception\NotFoundException;
use Cake\I18n\I18n;
use Cake\Utility\Hash;

class AppController extends Controller
{
    // Funcion para cargar componentes
    public function initialize()
    {
        parent::initialize();

        try {
            $this->loadComponent('RequestHandler', [
                'enableBeforeRedirect' => false,
            ]);

            $this->loadComponent('Flash');
            
            $this->loadComponent('Cookie');

            if (strpos($this->request->getParam('_matchedRoute'), 'api') === false) {
                $this->loadComponent('Security');
            }

            $this->loadComponent('Auth', [
                'authError' => __('No has iniciado sesión!'),
                'authorize' => ['Controller'],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password',
                        ],
                    ],
                ],
                'loginRedirect' => [
                    'controller' => 'home',
                    'action' => 'index',
                ],
                'logoutRedirect' => [
                    'controller' => 'users',
                    'action' => 'login',
                ],
            ]);
        } catch (\Exception $e) {
            throw new NotFoundException($e->getMessage());
        }

        //Comprobamos si existe locale en la sesion
        if ($this->request->getSession()->check('Config.locale')) {
            //Establecemos idioma por defecto leyendo de la sesion
            I18n::setLocale($this->request->getSession()->read('Config.locale'));
        }
    }

    // Autorizacion por roles
    public function isAuthorized($user)
    {
        // Default all
        return true;
    }

    // Comprobar si esta logeado
    public function isLogin()
    {
        $login = false;
        if ($this->request->getSession()->check('Auth.User')) {
            $login = true;
        }
        return $login;
    }

    // Acciones antes y despues de guardar
    public function begin()
    {
        $this->{$this->modelClass}->getConnection()->begin();
    }

    public function commit()
    {
        $this->{$this->modelClass}->getConnection()->commit();
    }

    /**
     * Funcion para paginar modelos
     *
     * @param $model //objeto modelo a paginar
     * @param int $limit //canidad de resultados por pagina mayor que 0
     * @param int $maxLimit //canidad pagima a paginar
     * @param array|null $order //Orden en que se mostrarn los resultados
     * @param array|null $contain //Modelos con los que se relaciona
     * @param array|null $conditions //Condiciones a aplicar a la vista
     * @param array|null $whitelist //Ordenar por modelos relacionados
     * @return \Cake\Datasource\ResultSetInterface|\Cake\ORM\ResultSet
     */
    public function paginar($model, $limit = 10, $maxLimit = 100,
        array $order = null, array $contain = null, array $conditions = null, array $whitelist = null) {
        $this->paginate = [
            //canidad de resultados por pagina
            'limit' => (is_numeric($limit) && $limit > 0) ? $limit : '',
            //limite maximo
            'maxLimit' => (is_numeric($maxLimit) && $maxLimit > 0) ? $maxLimit : '',
            //ordenamiento de los datos
            'order' => !is_null($order) ? $order : '',
            //Modelos a relacionar
            'contain' => !is_null($contain) ? $contain : '',
            //condiciones para aplicar a la consulta
            'conditions' => !is_null($conditions) ? $conditions : '',
        ];
        //permitir ordenar por modelo relacionado
        if (!is_null($whitelist)) {
            $this->paginate['sortWhitelist'] = $whitelist;
        }
        return $this->paginate($model);
    }

    // Funcion eliminar caracter de cadena
    public function clearData($data, $clean)
    {
        foreach ($data as $key => $value) {
            $data[$key] = str_replace($clean, '', $data[$key]);
            $data[$key] = trim($data[$key]);
        }
        return $data;
    }

    // Funcion cambiar idioma
    public function locale($locale)
    {
        $this->request->getSession()->write('Config.locale', $locale);
        return $this->redirect($this->referer());
    }

    // Funcion obtener idioma activo
    public function getLocale($simple = false)
    {
        $locale = $this->request->getSession()->read('Config.locale');
        if ($simple) {
            $locale = explode('_', $locale)[0];
        }
        return $locale;
    }
}
