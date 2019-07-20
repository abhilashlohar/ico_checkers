<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailUsers Model
 *
 * @property \App\Model\Table\SentEmailsTable|\Cake\ORM\Association\BelongsTo $SentEmails
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\EmailUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmailUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmailUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmailUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailUser|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmailUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmailUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmailUser findOrCreate($search, callable $callback = null, $options = [])
 */
class EmailUsersTable extends Table
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

        $this->setTable('email_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SentEmails', [
            'foreignKey' => 'sent_email_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->allowEmptyString('status', false);

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
        $rules->add($rules->existsIn(['sent_email_id'], 'SentEmails'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
