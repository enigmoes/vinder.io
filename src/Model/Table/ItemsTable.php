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

        $this->hasMany('ItemsTags', [
            'foreignKey' => 'id_item',
            'bindingKey' => 'id',
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
            ->integer('id_user')
            ->requirePresence('id_user', 'create')
            ->notEmptyString('id_user');

        $validator
            ->scalar('title')
            ->maxLength('title', 65535)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 65535)
            ->allowEmptyString('description');

        $validator
            ->scalar('link')
            ->maxLength('link', 65535)
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
    
    // Conditions
    public function conditions($data)
    {
        $conditions = [];
        if (isset($data['id_list']) && !empty($data['id_list'])) {
            $conditions['Items.id_list'] = $data['id_list'];
        }
        if (isset($data['id_user']) && !empty($data['id_user'])) {
            $conditions['Items.id_user'] = $data['id_user'];
        }
        if (isset($data['search']) && !empty($data['search'])) {
            if($data['search'] !== null) {
                $conditions['Items.title LIKE'] = '%' . $data['search'] . '%';
            }
        }
        if (isset($data['is_fav']) && !empty($data['is_fav'])) {
            $conditions['Items.is_fav'] = 1;
        }
        if (isset($data['items_tags']) && !empty($data['items_tags'])) {
            $conditions['Items.id IN'] = $data['items_tags'];
        }
        if (isset($data['all_items_tags']) && !empty($data['all_items_tags'])) {
            $conditions['Items.id NOT IN'] = $data['all_items_tags'];
        }
        return $conditions;
    }

    //Ordenar
    public function order($data)
    {
        if (isset($data['order']) && !empty($data['order'])) {
            //Comprobar ordenar
            switch ($data['order']) {
                case 'new':
                    $order['Items.created'] = 'DESC';
                    break;
                case 'old':
                    $order['Items.created'] = 'ASC';
                    break;
                case 'asc':
                    $order['Items.title'] = 'ASC';
                    break;
                case 'desc':
                    $order['Items.title'] = 'DESC';
                    break;
            }
        } else {
            $order['Items.created'] = 'DESC';
        }
        return $order;
    }

    public function limit($data)
    {
        if(isset($data['limit']) && !empty($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = 6;
        }
        return $limit;
    }
}
