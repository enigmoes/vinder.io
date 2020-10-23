<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemsTag Entity
 *
 * @property int $id
 * @property int $id_item
 * @property int $id_tag
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class ItemsTag extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id_item' => true,
        'id_tag' => true,
        'created' => true,
        'modified' => true,
    ];
}
