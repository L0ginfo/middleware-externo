<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LotesEntrada Entity.
 *
 * @property int $id
 * @property int $lote_id
 * @property \App\Model\Entity\Lote $lote
 * @property int $entrada_id
 * @property \App\Model\Entity\Entrada $entrada
 * @property int $item_id
 * @property \App\Model\Entity\Item $item
 * @property int $quantidade
 * @property int $container_id
 */
class LotesEntrada extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
