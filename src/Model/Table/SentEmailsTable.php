<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SentEmails Model
 *
 * @property \App\Model\Table\EmailUsersTable|\Cake\ORM\Association\HasMany $EmailUsers
 *
 * @method \App\Model\Entity\SentEmail get($primaryKey, $options = [])
 * @method \App\Model\Entity\SentEmail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SentEmail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SentEmail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SentEmail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SentEmail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SentEmail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SentEmail findOrCreate($search, callable $callback = null, $options = [])
 */
class SentEmailsTable extends Table
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

        $this->setTable('sent_emails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('EmailUsers', [
            'foreignKey' => 'sent_email_id'
        ]);
		$this->belongsTo('Users');
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
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->allowEmptyString('message', false);

        $validator
            ->date('create_date')
            ->requirePresence('create_date', 'create')
            ->allowEmptyDate('create_date', false);

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->allowEmptyString('status', false);

        $validator
            ->date('sent_on')
            ->allowEmptyDate('sent_on', false);

        return $validator;
    }
}
