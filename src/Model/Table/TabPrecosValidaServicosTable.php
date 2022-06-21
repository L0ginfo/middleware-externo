<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TabPrecosValidaServicos Model
 *
 * @property \App\Model\Table\TabelasPrecosServicosTable&\Cake\ORM\Association\BelongsTo $TabelasPrecosServicos
 * @property \App\Model\Table\SistemaCamposTable&\Cake\ORM\Association\BelongsTo $SistemaCampos
 * @property \App\Model\Table\OperadoresTable&\Cake\ORM\Association\BelongsTo $Operadores
 *
 * @method \App\Model\Entity\TabPrecosValidaServico get($primaryKey, $options = [])
 * @method \App\Model\Entity\TabPrecosValidaServico newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TabPrecosValidaServico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TabPrecosValidaServico|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TabPrecosValidaServico saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TabPrecosValidaServico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TabPrecosValidaServico[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TabPrecosValidaServico findOrCreate($search, callable $callback = null, $options = [])
 */
class TabPrecosValidaServicosTable extends Table
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

        $this->setTable('tab_precos_valida_servicos');
        $this->setDisplayField('descricao');
        $this->setPrimaryKey('id');

        $this->addBehavior('LogsTabelas');

        $this->belongsTo('TabelasPrecosServicos', [
            'foreignKey' => 'tab_preco_servico_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SistemaCampos', [
            'foreignKey' => 'campo_sistema_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Operadores', [
            'foreignKey' => 'operador_id',
            'joinType' => 'INNER'
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
            ->scalar('valor_inicio')
            ->maxLength('valor_inicio', 20)
            ->requirePresence('valor_inicio', 'create')
            ->notEmptyString('valor_inicio');

        $validator
            ->scalar('valor_final')
            ->maxLength('valor_final', 20)
            ->requirePresence('valor_final', 'create')
            ->notEmptyString('valor_final');

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
        $rules->add($rules->existsIn(['tab_preco_servico_id'], 'TabelasPrecosServicos'));
        $rules->add($rules->existsIn(['campo_sistema_id'], 'SistemaCampos'));
        $rules->add($rules->existsIn(['operador_id'], 'Operadores'));

        return $rules;
    }
}
