<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenTime;

class TokensTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tokens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasOne('Users', [
            'foreignKey' => 'id',
            'bindingKey' => 'id_user',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('id_user')
            ->requirePresence('id_user', 'create')
            ->notEmptyString('id_user');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->requirePresence('token', 'create')
            ->notEmptyString('token')
            ->add('token', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('expiration')
            ->requirePresence('expiration', 'create')
            ->notEmptyDateTime('expiration');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['token']));

        return $rules;
    }

    /**
     * CODE FUNCTIONS
     */

    // Generate codigo
    public function createCode($id_user)
    {
        // Comprobamos si tiene un token
        $aToken = $this->find()->where(['Tokens.id_user' => $id_user])->first();
        $token = $this->newEntity();
        // Si tiene token actualizamos
        if ($aToken) {
            $token->id = $aToken['id'];
        }
        $token->id_user = $id_user;
        // Generamos codigo aleatorio
        $token->token = \Functions::random_string(7);
        $token->expiration = date('Y-m-d H:i:s', strtotime('+1 day'));

        return $this->save($token) ? $token : false;
    }

    // Check Code
    public function checkCode($id_user, $code)
    {
        $token = $this->find()
            ->where([
                'Tokens.id_user' => $id_user,
                'Tokens.token' => $code,
            ])
            ->first();
        $time = new FrozenTime($token['expiration']);
        // Si el token es valido
        if (!is_null($token) && $time->toUnixString() >= strtotime(date('Y-m-d H:i:s'))) {
            return true;
        } else {
            // Eliminamos token antiguo
            if (!is_null($token)) {
                $this->delete($token);
            }
            return false;
        }
    }

    /**
     * TOKEN FUNCTIONS
     */

    // Generate token
    public function createToken($id_user)
    {
        // Comprobamos si tiene un token
        $aToken = $this->find()->where(['Tokens.id_user' => $id_user])->first();
        $token = $this->newEntity();
        // Si tiene token actualizamos
        if ($aToken) {
            $token->id = $aToken['id'];
        }
        $token->id_user = $id_user;
        $token->token = md5($id_user . date('Y-m-d H:i:s') . env('SECURITY_SALT'));
        $token->expiration = date('Y-m-d H:i:s', strtotime('+1 day'));

        // Buscamos si existe el token
        while ($this->existsToken($token->token)) {
            $token->token = md5($id_user . date('Y-m-d H:i:s') . env('SECURITY_SALT'));
        }

        return $this->save($token) ? $token : false;
    }

    // Exists token
    public function existsToken($token)
    {
        $exists = false;
        $token = $this->find()
            ->where([
                'Tokens.token' => $token,
            ])
            ->toArray();
        // Si existe
        if ($token) {
            $exists = true;
        }
        return $exists;
    }

    // Check Token
    public function checkToken($token)
    {
        $token = $this->find()
            ->where([
                'Tokens.token' => $token,
            ])
            ->first();
        $time = new FrozenTime($token['expiration']);
        // Si el token es valido
        if (!is_null($token) && $time->toUnixString() >= strtotime(date('Y-m-d H:i:s'))) {
            return true;
        } else {
            // Eliminamos token antiguo
            if (!is_null($token)) {
                $this->delete($token);
            }
            return false;
        }
    }
    
    /**
     * REMOVE FUNCTION
     */

    // Remove token
    public function remove($id_user)
    {
        $token = $this->find()->where(['Tokens.id_user' => $id_user])->first();
        if ($this->delete($token)) {
            return true;
        } else {
            return false;
        }
    }
}
