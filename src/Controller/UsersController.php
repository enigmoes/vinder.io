<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Model\Entity\Mail;
use Cake\I18n\I18n;

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->Mail = new Mail();
        $this->loadModel('Tokens');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'register',
            'recover',
            'change',
            'validate'
        ]);
    }

    /**
     * OTHER ACTIONS
     */
    // User account data edit action
    public function account()
    {
        //Recogemos identidad del formulario
        $user_id = $this->request->getSession()->read('Auth.User.id');
        //Buscamos datos en db
        $user = $this->Users->get($user_id);
        //Eliminamos password
        unset($user['password']);

        //Si el request es post
        if ($this->request->is(array('post', 'put'))) {
            $this->begin();
            $data = $this->request->getData();
            if(empty($data['password'])) {
                unset($data['password']);
            }
            //Completar datos entidad con datos formulario
            $this->Users->patchEntity($user, $data, ['validate' => 'custom']);
            // Ger current user data
            $currentUser = $this->Users->get($user->id);
            //Guardamos datos en db
            if ($this->Users->save($user)) {
                // Si se cambia la contraseña enviamos notificación
                if (isset($user->password)) {
                    $this->Mail->sendEmail($user->email, __('Notificación cambio de contraseña | vinder.io'), 'notifications/password', $user);
                }
                $this->commit();
                // Si se cambia el email enviamos notificación
                if ($user->email != $currentUser->email) {
                    // Desactivamos usuario
                    $this->Users->deactivate($user->id);
                    // Creamos código para validar email
                    $user->token = $this->Tokens->createCode($user->id);
                    // Enviamos email
                    if ($this->Mail->sendEmail($user->email, __('Notificación cambio de email | vinder.io'), 'notifications/email', $user)) {
                        // Sacamos alerta
                        $this->Flash->success(__('Hemos enviado un código para validar su nuevo email, por favor siga las instrucciones, sino la próxima vez no podrá acceder a su cuenta.'));
                        // Deslogueamos
                        $this->request->getSession()->delete('Auth');
                        // Creamos sesion para validar nuevo email
                        $this->request->getSession()->write('Validate.User.id', $user->id);
                        // Redirigimos a validar email
                        $this->redirect([
                            'controller' => 'users',
                            'action' => 'validate',
                        ]);
                    }
                } else {
                    $this->Flash->success(__('Datos actualizados correctamente'));
                    $this->redirect([
                        'controller' => 'users',
                        'action' => 'account',
                    ]);
                }
            } else {
                $this->Flash->error(__('Error al guardar sus datos'));
            }
        }

        $this->set([
            'user' => $user,
            'title' => __('Mi Cuenta')
        ]);
    }

    // Login action
    public function login()
    {
        //Si esta logeado le enviamos al la home
        if ($this->isLogin()) {
            $this->redirect([
               'controller' => 'home',
               'action' => 'index'
            ]);
        }
        //Si el request es post
        if ($this->request->is('post')) {
            //Recogemos identidad del formulario
            $user = $this->Auth->identify();
            //Si existe usuario
            if ($user) {
                if ($user['is_active']) {
                    //Asignamos usuario a la session
                    $this->Auth->setUser($user);
                    //Establecemos locale
                    $this->request->getSession()->write('Config.locale', I18n::getDefaultLocale());
                    $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->begin();
                    // Generamos token de validación de email
                    $token = $this->Tokens->createCode($user['id']);
                    if ($token) {
                        // Buscamos datos usuario
                        $data = $this->Users->get($user['id']);
                        // Assignamos token a usuario
                        $data['token'] = $this->Tokens->findByIdUser($user['id'])->first();
                        // Enviamos email de validación
                        if ($this->Mail->sendEmail($data['email'], __('Validación email | vinder.io'), 'validate', $data)) {
                            $this->commit();
                            $this->Flash->success(__('No ha validación su email, por favor introduzca el codigo que le hemos enviado a su email.'));
                            $this->request->getSession()->write('Validate.User.id', $user['id']);
                            $this->redirect(['action' => 'validate']);
                        }
                    }
                }
            } else {
                $this->Flash->error(__('Email o contraseña no validos'));
            }
        }
        $this->set([
            'title' => __('Login')
        ]);
    }

    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }

    // Register action
    public function register()
    {
        $login = false;
        if ($this->isLogin()) {
            $this->redirect($this->referer());
        }
        $user = $this->Users->newEntity();
        //Si el request es post
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'default']);
            if ($this->request->getData('privacidad') == \Boolean::YES) {
                if ($this->Users->save($user)) {
                    // Generamos token de validación de email
                    $token = $this->Tokens->createCode($user['id']);
                    if ($token) {
                        // Assignamos token a usuario
                        $user['token'] = $this->Tokens->findByIdUser($user['id'])->first();
                        // Enviamos email de bienvenida y validación
                        if ($this->Mail->sendEmail($user['email'], __('Bienvenido | vinder.io'), 'welcome', $user)) {
                            if ($this->Mail->sendEmail($user['email'], __('Validación email | vinder.io'), 'validate', $user)) {
                                $this->commit();
                                $this->Flash->success(__('Hemos enviado un codigo de validación a su email, por favor introduzcalo en el siguiente campo.'));
                            } else {
                                $this->Flash->error(__('Se ha producido un error en el registro'));
                            }
                        } else {
                            $this->Flash->error(__('Se ha producido un error en el registro'));
                        }
                    } else {
                        $this->Flash->error(__('Se ha producido un error en el registro'));
                    }
                } else {
                    $this->Flash->error(__('Se ha producido un error en el registro'));
                }
            } else {
                $this->Flash->error(__('Acepte la política de privacidad'));
            }
        }
        $this->set([
            'title' => __('Registro'),
            'user' => $user,
            'login' => $login,
        ]);
    }

    // Accion para recuperar la contraseña
    public function recover()
    {
        $login = false;
        if ($this->isLogin()) {
            $this->redirect($this->referer());
        }
        $isRequest = false;
        $user = $this->Users->newEntity();
        //Si se recibe post
        if ($this->request->is('post')) {
            $user = $this->Users->findByEmail($this->request->getData('email'))->first();
            // Si existe el usuario
            if (!is_null($user)) {
                $this->begin();
                // Generamos token
                $token = $this->Tokens->createToken($user['id']);
                if ($token) {
                    // Assignamos token a usuario
                    $user['token'] = $this->Tokens->findByIdUser($user['id'])->first();
                    // Si se envia el email
                    if ($this->Mail->sendEmail($user['email'], __('Recuperar contraseña | vinder.io'), 'recover', $user)) {
                        $this->commit();
                        $isRequest = true;
                        $this->Flash->success(__('Revise su bandeja de entrada y siga las instrucciones.'));
                    } else {
                        $this->Flash->error(__('Error al enviar el email de recuperación.'));
                    }
                }
            } else {
                $this->Flash->error(__('No existe ningun usuario con este email.'));
            }
        }
        $this->set([
            'title' => __('Recuperar contraseña'),
            'user' => $user,
            'isRequest' => $isRequest,
            'login' => $login,
        ]);
    }

    // Accion cambiar contraseña
    public function change($token)
    {
        $login = false;
        if ($this->isLogin()) {
            $this->redirect($this->referer());
        }
        // Comprobamos si es valido el token
        if ($this->Tokens->checkToken($token)) {
            // Buscamos usuario por token
            $user = $this->Users->find('all', [
                'contain' => ['Tokens'],
                'conditions' => ['Tokens.token' => $token]
            ])->first();
            // Eliminamos password
            unset($user->password);
            // Si se recibe post
            if ($this->request->is('post')) {
                $this->begin();
                $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'recover']);
                // Guardamos datos
                if ($this->Users->save($user)) {
                    // Eliminamos token
                    $this->Tokens->remove($user->id);
                    $this->commit();
                    $this->Flash->success(__('Ya puedes iniciar sesion con tu nueva contraseña.'));
                    $this->redirect([
                        'controller' => 'users',
                        'action' => 'login',
                    ]);
                } else {
                    $this->Flash->error(__('Error al cambiar tu contraseña.'));
                }
            }
        } else {
            $this->Flash->error(__('El enlace ha caducado.'));
            $this->redirect([
                'controller' => 'users',
                'action' => 'login',
            ]);
        }
        $this->set([
            'title' => __('Cambiar contraseña'),
            'user' => $user,
            'token' => $token,
            'login' => $login,
        ]);
    }

    // Accion validar y activar email
    public function validate()
    {
        $id_user = $this->request->getSession()->read('Validate.User.id');
        // Si existe session
        if ($id_user) {
            if ($this->request->is('post')) {
                // Comprobamos token
                if ($this->Tokens->checkCode($id_user, $this->request->getData('token'))) {
                    // Activar usuario
                    if ($this->Users->activate($id_user)) {
                        // Eliminar token y sesion
                        $this->Tokens->remove($id_user);
                        $this->request->getSession()->delete('Validate.User.id');
                        $this->Flash->success(__('Enhorabuena, ya puedes acceder a tu cuenta.'));
                        $this->redirect([
                            'controller' => 'users',
                            'action' => 'login',
                        ]);
                    } else {
                        $this->Flash->error(__('Se ha producido un error al validar el email.'));
                    }
                } else {
                    $this->Flash->error(__('El código no es correcto.'));
                }
            }
        } else {
            $this->redirect([
                'controller' => 'home',
                'action' => 'index',
            ]);
        }
        $this->set([
            'title' => __('Validación email'),
        ]);
    }

    /**
     * AJAX FUNCTIONS
     */
    // Funcion para desactivar cuenta
    public function deactivateAccount()
    {
        $errors = 0;
        $message = '';
        if ($this->isLogin()) {
            $user = $this->Users->get($this->request->getSession()->read('Auth.User.id'));
            $user->is_active = 0;
            $user->deactivated = date('Y-m-d', strtotime('+1 day'));
            if ($this->Users->save($user)) {
                if ($this->Mail->sendEmail($user->email, __('Notificacion desactivación de cuenta | vinder.io'), 'notifications/deactivate', $user)) {
                    $this->request->getSession()->delete('Auth');
                } else {
                    $errors = 1;
                    $message = __('Error al desactivar cuenta.'); 
                }
            } else {
                $errors = 1;
                $message = __('Error al desactivar cuenta.');
            }
        } else {
            $errors = 1;
            $message = __('No has iniciado sesion.');
        }
        $this->set([
            'errors' => 0,
            'message' => $message,
            '_serialize' => ['errors', 'message']
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    // Create cookie on login
    protected function _setCookie()
    {
        if (!$this->request->getData('rememberme')) {
            return false;
        }
        $data = [
            'email' => $this->request->getData('email'),
            'password' => $this->request->getData('password')
        ];
        $this->Cookie->write('RememberMe', $data);
        $this->Cookie->configKey('RememberMe', [
            'expires' => '+1 week',
            'httpOnly' => true
        ]);
        return true;
    }

}
