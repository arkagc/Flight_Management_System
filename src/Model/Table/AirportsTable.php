<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Airports Model
 *
 * @method \App\Model\Entity\Airport newEmptyEntity()
 * @method \App\Model\Entity\Airport newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Airport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Airport get($primaryKey, $options = [])
 * @method \App\Model\Entity\Airport findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Airport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Airport[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Airport|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airport saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AirportsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('airports');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');


        $this->hasMany('Source', [
            'className' => 'Flights',
            'foreignKey' => 'source_id',
        ]);

        $this->hasMany('Destination', [
            'className' => 'Flights',
            'foreignKey' => 'destination_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmptyString('name', 'Name should not be empty');

        $validator
            ->scalar('short_name')
            ->maxLength('short_name', 255)
            ->notEmptyString('short_name', 'Short Name should not be empty');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->notEmptyString('location', 'Location should not be empty');

        $validator
            ->scalar('status')
            ->notEmptyString('status', 'Status should not be empty');

        $validator
            ->dateTime('created_at')
            //->requirePresence('created_at', 'create')
            ->notEmptyDateTime('created_at', 'Create data and time should not be empty');

        $validator
            ->dateTime('modified_at')
            ->notEmptyDateTime('modified_at', 'Modified data and time should not be empty');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name'], 'Name already exist'), ['errorField' => 'name']);
        $rules->add($rules->isUnique(['short_name'], 'Short name already exist'), ['errorField' => 'short_name']);

        return $rules;
    }
}