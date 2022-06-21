<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResvsDocumentoGenerico Entity
 *
 * @property int $id
 * @property int $resv_id
 * @property int $documento_generico_id
 *
 * @property \App\Model\Entity\Resv $resv
 * @property \App\Model\Entity\DocumentoGenerico $documento_generico
 */
class ResvsDocumentoGenerico extends Entity
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
     /* Default fields
        
        'resv_id' => true,
        'documento_generico_id' => true,
        'resv' => true,
        'documento_generico' => true,
    
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
