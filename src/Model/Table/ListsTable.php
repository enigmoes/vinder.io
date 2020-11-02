<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lists Model
 *
 * @method \App\Model\Entity\List get($primaryKey, $options = [])
 * @method \App\Model\Entity\List newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\List[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\List|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\List saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\List patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\List[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\List findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ListsTable extends Table
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

        $this->setTable('lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'id_list',
            'bindingKey' => 'id',
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

        return $validator;
    }
}
