<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemsTags Model
 *
 * @method \App\Model\Entity\ItemsTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemsTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemsTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemsTag|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemsTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemsTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemsTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemsTag findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemsTagsTable extends Table
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

        $this->setTable('items_tags');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('id_item')
            ->requirePresence('id_item', 'create')
            ->notEmptyString('id_item');

        $validator
            ->integer('id_tag')
            ->requirePresence('id_tag', 'create')
            ->notEmptyString('id_tag');

        return $validator;
    }
}
