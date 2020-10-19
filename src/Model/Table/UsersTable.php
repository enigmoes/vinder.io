<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('email');
        $this->setPrimaryKey('id');

        $this->hasOne('Tokens', [
            'foreignKey' => 'id_user',
            'bindingKey' => 'id',
        ]);
    }

    //Conditions
    public function conditions($data)
    {
        $conditions = [];
        if (isset($data['username']) && !empty($data['username'])) {
            $conditions['Users.username LIKE '] = '%' . $data['username'] . '%';
        }
        if (isset($data['email']) && !empty($data['email'])) {
            $conditions['Users.email LIKE '] = '%' . $data['email'] . '%';
        }
        return $conditions;
    }

    /**
     * Front Validations
     */

    // Validaciones del modelo por defecto
    public function validationDefault(Validator $validator)
    {
        $validator->notEmptyString('name', __('El nombre no puede estar vacío'));
        $validator->notEmptyString('email', __('El email no puede estar vacío'));
        $validator->notEmptyString('password', __('La contraseña no puede estar vacía'));
        $validator->add('email', 'custom', [
            'rule' => function ($value, $context) {
                $user = $this->find();
                $result = $user->select(['users' => $user->func()->count('Users.email')])
                    ->where(['Users.email' => $value])
                    ->toArray();
                if ($result[0]['users'] > 0) {
                    return false;
                }
                return true;
            },
            'message' => __('El email ya existe'),
        ]);
        return $validator;
    }

    // Validacion custom (sin password obligatoria)
    public function validationCustom(Validator $validator)
    {
        $validator->notEmptyString('email', __('El email no puede estar vacío'));
        $validator->notEmptyString('password', __('Introduzca una nueva contraseña.'));
        $validator->allowEmpty('password_current');
        $validator->add('email', 'no-misspelling', [
            'rule' => ['compareWith', 'email_confirm'],
            'message' => __('Los emails no coinciden.'),
        ]);
        $validator->add('email', 'custom', [
            'rule' => function ($value, $context) {
                $user = $this->get($context['data']['id']);
                if ($user['email'] != $value) {
                    $user = $this->find();
                    $result = $user->select(['users' => $user->func()->count('Users.email')])
                        ->where(['Users.email' => $value])
                        ->toArray();
                    if ($result[0]['users'] > 0) {
                        return false;
                    }
                }
                return true;
            },
            'message' => __('El email ya existe'),
        ]);
        $validator->add('password_current', 'custom', [
            'rule' => function ($value, $context) {
                $user = $this->get($context['data']['id']);
                return (new DefaultPasswordHasher)->check($value, $user['password']);
            },
            'message' => __('La contraseña actual no es válida'),
        ]);
        return $validator;
    }

    // Validacion recover
    public function validationRecover(Validator $validator)
    {
        $validator->notEmptyString('password', __('La contraseña no puede estar vacía'));
        $validator->notEmptyString('password_confirm', __('La contraseña no puede estar vacía'));
        $validator->add('password', 'no-misspelling', [
            'rule' => ['compareWith', 'password_confirm'],
            'message' => __('Las contraseñas no coinciden'),
        ]);
        return $validator;
    }

    // Before save
    public function beforeSave($event, $entity, $options)
    {
        if (!empty($entity->name)) {
            // Primera letra en mayusculas
            $entity->name = ucfirst($entity->name);
        }
        if (!empty($entity->surnames)) {
            // Primera letra en mayusculas
            $entity->surnames = ucfirst($entity->surnames);
        }
    }

    /**
     * CUSTOM FUNCTIONS
     */

    // Funcion para activar usuario
    public function activate($id_user)
    {
        $user = $this->get($id_user);
        $user->is_active = 1;
        return ($this->save($user)) ? $user : false;
    }

    // Funcion para desactivar usuario
    public function deactivate($id_user)
    {
        $user = $this->get($id_user);
        $user->is_active = 0;
        return ($this->save($user)) ? $user : false;
    }

}
