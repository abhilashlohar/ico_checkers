<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Refers Model
 *
 * @property \App\Model\Table\RefByUsersTable|\Cake\ORM\Association\BelongsTo $RefByUsers
 * @property \App\Model\Table\RefToUsersTable|\Cake\ORM\Association\BelongsTo $RefToUsers
 *
 * @method \App\Model\Entity\Refer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Refer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Refer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Refer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Refer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Refer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Refer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Refer findOrCreate($search, callable $callback = null, $options = [])
 */
class RefersTable extends Table
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

        $this->setTable('refers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        
        $this->belongsTo('RefByUsers', [
            'className' => 'Users',
            'foreignKey' => 'ref_by_user_id',
            'propertyName' => 'ref_by_user',
        ]);
        $this->belongsTo('RefToUsers', [
            'className' => 'Users',
            'foreignKey' => 'ref_to_user_id',
            'propertyName' => 'ref_to_user',
        ]);

        $this->belongsTo('Withdraws');
        $this->belongsTo('Wallets');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->dateTime('created_date')
            ->requirePresence('created_date', 'create')
            ->allowEmptyDateTime('created_date', false);

        $validator
            ->decimal('points')
            ->requirePresence('points', 'create')
            ->allowEmptyString('points', false);

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
        $rules->add($rules->existsIn(['ref_by_user_id'], 'RefByUsers'));
        $rules->add($rules->existsIn(['ref_to_user_id'], 'RefToUsers'));

        return $rules;
    }
}
