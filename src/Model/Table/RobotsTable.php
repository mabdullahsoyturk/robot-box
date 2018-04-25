<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Robots Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TopicsTable|\Cake\ORM\Association\BelongsTo $Topics
 *
 * @method \App\Model\Entity\Robot get($primaryKey, $options = [])
 * @method \App\Model\Entity\Robot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Robot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Robot|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Robot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Robot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Robot findOrCreate($search, callable $callback = null, $options = [])
 */
class RobotsTable extends Table
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

        $this->setTable('robots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Topics', [
            'foreignKey' => 'topic_id',
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('ip_address')
            ->maxLength('ip_address', 50)
            ->requirePresence('ip_address', 'create')
            ->notEmpty('ip_address');

        $validator
            ->scalar('port')
            ->maxLength('port', 8)
            ->requirePresence('port', 'create')
            ->notEmpty('port');

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
        $rules->add($rules->existsIn(['topic_id'], 'Topics'));

        return $rules;
    }
}
