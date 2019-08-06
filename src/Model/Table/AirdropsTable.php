<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Airdrops Model
 *
 * @method \App\Model\Entity\Airdrop get($primaryKey, $options = [])
 * @method \App\Model\Entity\Airdrop newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Airdrop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Airdrop|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airdrop|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airdrop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Airdrop[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Airdrop findOrCreate($search, callable $callback = null, $options = [])
 */
class AirdropsTable extends Table
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

        $this->setTable('airdrops');
        $this->setDisplayField('name');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('link')
            ->maxLength('link', 255)
            ->requirePresence('link', 'create')
            ->allowEmptyString('link', false);

        $validator
            ->scalar('country')
            ->maxLength('country', 50)
            ->requirePresence('country', 'create')
            ->allowEmptyString('country', false);
			
		$validator
            ->scalar('description')
            ->allowEmptyString('description', false);
			
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email', false);

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->allowEmptyDateTime('created_on', false);

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
