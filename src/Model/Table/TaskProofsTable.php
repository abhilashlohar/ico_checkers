<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaskProofs Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TasksTable|\Cake\ORM\Association\BelongsTo $Tasks
 *
 * @method \App\Model\Entity\TaskProof get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaskProof newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaskProof[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaskProof|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaskProof|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaskProof patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaskProof[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaskProof findOrCreate($search, callable $callback = null, $options = [])
 */
class TaskProofsTable extends Table
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

        $this->setTable('task_proofs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id',
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
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->allowEmptyString('message', false);

        $validator
           //->requirePresence('image', 'create')
		    ->allowEmpty('image');
            /* ->notEmpty('image', __('Please select a image.'), function($context) {
                return $context['newRecord'];
            }) */
            /* ->add('image', 'fileSize', [
                'rule' => ['fileSize', '<=', '2MB'],
                'message' => __('Image must be less than 2MB.')
            ])
            ->add('images', 'extension', [
                'rule' => ['extension'],
                'message' => __('Please supply a valid image [allowed extensions are: Gif, Jpeg, Png, Jpg].')
            ]) */;

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
