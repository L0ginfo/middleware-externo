<?php
namespace App\Model\Table;

use App\Model\Entity\TiposBloqueio;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TiposBloqueios Model
 *
 */
class TiposBloqueiosTable extends Table
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

        $this->table('tipos_bloqueios');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('LogsTabelas');


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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('ds_tipo_bloqueio', 'create')
            ->notEmpty('ds_tipo_bloqueio');

        return $validator;
    }
}
