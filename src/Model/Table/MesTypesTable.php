<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MesTypes Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\MesType get($primaryKey, $options = [])
 * @method \App\Model\Entity\MesType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MesType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MesType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MesType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MesType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MesType findOrCreate($search, callable $callback = null, $options = [])
 */
class MesTypesTable extends Table
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

        $this->setTable('mes_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('x_par')
            ->maxLength('x_par', 255)
            ->requirePresence('x_par', 'create')
            ->notEmpty('x_par');

        $validator
            ->scalar('y_par')
            ->maxLength('y_par', 255)
            ->requirePresence('y_par', 'create')
            ->notEmpty('y_par');

        $validator
            ->scalar('t_par')
            ->maxLength('t_par', 255)
            ->requirePresence('t_par', 'create')
            ->notEmpty('t_par');

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
