<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Flights Model
 *
 * @property \App\Model\Table\SourcesTable&\Cake\ORM\Association\BelongsTo $Sources
 * @property \App\Model\Table\DestinationsTable&\Cake\ORM\Association\BelongsTo $Destinations
 *
 * @method \App\Model\Entity\Flight newEmptyEntity()
 * @method \App\Model\Entity\Flight newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Flight[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Flight get($primaryKey, $options = [])
 * @method \App\Model\Entity\Flight findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Flight patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Flight[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Flight|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Flight saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Flight[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Flight[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Flight[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Flight[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FlightsTable extends Table
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

        $this->setTable('flights');
        $this->setDisplayField(['flight_no','name']);
        $this->setPrimaryKey('id');

        $this->hasMany('Passengers', [
            'foreignKey' => 'flight_id',
        ]);

        $this->hasMany('Bookings', [
            'foreignKey' => 'flight_id',
        ]);

        $this->belongsTo('Airports', [
            'foreignKey' => 'source_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Airports', [
            'foreignKey' => 'destination_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Source', [
            'className' => 'Airports',
            'foreignKey' => 'source_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Destination', [
            'className' => 'Airports',
            'foreignKey' => 'destination_id',
            'joinType' => 'INNER',
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
            ->scalar('flight_no')
            ->maxLength('flight_no', 255)
            ->notEmptyString('flight_no', 'Flight No should not be empty');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmptyString('name', 'Flight Name should not be empty');

        $validator
            ->integer('source_id')
            ->requirePresence('source_id', 'create')
            ->notEmptyString('source_id', 'Source should not be empty');

        $validator
            ->integer('destination_id')
            ->requirePresence('destination_id', 'create')
            ->notEmptyString('destination_id', 'Destination should not be empty')
            ->notSameAs('destination_id', 'source_id', 'Source and Destination should be different');

        $validator
            ->scalar('total_seat')
            ->maxLength('total_seat', 255)
            ->notEmptyString('total_seat', 'Seats should not be empty');

        $validator
            ->time('duration')
            ->requirePresence('duration', 'create')
            ->notEmptyString('duration', 'Duration should not be empty');

        $validator
            ->scalar('distance')
            ->maxLength('distance', 255)
            ->notEmptyString('distance', 'Distance should not be empty');

        $validator
            ->time('deprt_time')
            ->requirePresence('deprt_time', 'create')
            ->notEmptyTime('deprt_time', 'Deperture time should not be empty');

        $validator
            ->scalar('status')
            ->notEmptyString('status', 'Status should not be empty');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmptyDateTime('created_at', 'Create data and time should not be empty');

        $validator
            ->dateTime('modified_at')
            ->notEmptyDateTime('modified_at', 'Modified date and time should not be empty');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['source_id'], 'Airports'), ['errorField' => 'source_id']);
        $rules->add($rules->existsIn(['destination_id'], 'Airports'), ['errorField' => 'destination_id']);

        $rules->add($rules->isUnique(['flight_no'], 'Flight No already exist'), ['errorField' => 'flight_no']);

        return $rules;
    }

}


