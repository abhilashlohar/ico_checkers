<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MdiCoins Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TasksTable|\Cake\ORM\Association\BelongsTo $Tasks
 *
 * @method \App\Model\Entity\MdiCoin get($primaryKey, $options = [])
 * @method \App\Model\Entity\MdiCoin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MdiCoin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MdiCoin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MdiCoin|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MdiCoin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MdiCoin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MdiCoin findOrCreate($search, callable $callback = null, $options = [])
 */
class MdiCoinsTable extends Table
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

        $this->setTable('mdi_coins');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->integer('coins')
            ->requirePresence('coins', 'create')
            ->allowEmptyString('coins', false);

        $validator
            ->scalar('module')
            ->maxLength('module', 30)
            ->requirePresence('module', 'create')
            ->allowEmptyString('module', false);

        $validator
            ->integer('referred_user')
            ->allowEmptyString('referred_user');

        $validator
            ->scalar('meta_description')
            ->requirePresence('meta_description', 'create')
            ->allowEmptyString('meta_description', false);

        $validator
            ->dateTime('date_created')
            ->requirePresence('date_created', 'create')
            ->allowEmptyDateTime('date_created', false);

        $validator
            ->dateTime('date_modified')
            ->requirePresence('date_modified', 'create')
            ->allowEmptyDateTime('date_modified', false);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['task_id'], 'Tasks'));

        return $rules;
    }
}
