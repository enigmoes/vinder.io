<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $id_list
 * @property string|null $title
 * @property string|null $description
 * @property string|null $link
 * @property string|null $image
 * @property bool $is_fav
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Tag[] $tags
 */
class Item extends Entity
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
        'id_list' => true,
        'title' => true,
        'description' => true,
        'link' => true,
        'image' => true,
        'is_fav' => true,
        'created' => true,
        'modified' => true,
        'tags' => true,
    ];
}
