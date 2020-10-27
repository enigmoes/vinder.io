<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemsTable extends Table
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

        $this->setTable('items');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Tags', [
            'foreignKey' => 'id_item',
            'targetForeignKey' => 'id_tag',
            'joinTable' => 'items_tags',
        ]);
        $this->belongsTo('Lists', [
            'foreignKey' => 'id',
            'bindingKey' => 'id_list',
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
            ->integer('id_list')
            ->requirePresence('id_list', 'create')
            ->notEmptyString('id_list');

        $validator
            ->scalar('title')
            ->maxLength('title', 45)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 45)
            ->allowEmptyString('description');

        $validator
            ->scalar('link')
            ->maxLength('link', 45)
            ->allowEmptyString('link');

        $validator
            ->scalar('image')
            ->maxLength('image', 4294967295)
            ->allowEmptyFile('image');

        $validator
            ->boolean('is_fav')
            ->notEmptyString('is_fav');

        return $validator;
    }
}
