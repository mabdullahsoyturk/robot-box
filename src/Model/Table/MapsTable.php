<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Maps Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RobotsTable|\Cake\ORM\Association\HasMany $Robots
 *
 * @method \App\Model\Entity\Map get($primaryKey, $options = [])
 * @method \App\Model\Entity\Map newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Map[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Map|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Map patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Map[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Map findOrCreate($search, callable $callback = null, $options = [])
 */
class MapsTable extends Table
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

        $this->setTable('maps');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Robots', [
            'foreignKey' => 'map_id'
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
            ->decimal('width')
            ->requirePresence('width', 'create')
            ->notEmpty('width');

        $validator
            ->decimal('height')
            ->requirePresence('height', 'create')
            ->notEmpty('height');

        $validator
            ->requirePresence('space', 'create')
            ->notEmpty('space');

        $validator
            ->decimal('x_zero')
            ->requirePresence('x_zero', 'create')
            ->notEmpty('x_zero');

        $validator
            ->decimal('y_zero')
            ->requirePresence('y_zero', 'create')
            ->notEmpty('y_zero');

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

        return $rules;
    }
}
