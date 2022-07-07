<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Passengers Model
 *
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\HasMany $Bookings
 *
 * @method \App\Model\Entity\Passenger newEmptyEntity()
 * @method \App\Model\Entity\Passenger newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Passenger[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Passenger get($primaryKey, $options = [])
 * @method \App\Model\Entity\Passenger findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Passenger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Passenger[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Passenger|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Passenger saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Passenger[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Passenger[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Passenger[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Passenger[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PassengersTable extends Table
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

        $this->setTable('passengers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Bookings', [
            'foreignKey' => 'passenger_id',
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
            ->scalar('username')
            ->maxLength('username', 255)
            ->notEmptyString('username', 'User Name should not be blank');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->notEmptyString('name', 'Name should not be blank');

        $validator
            ->email('email')
            ->notEmptyString('email', 'Email should not be blank');

        $validator
            ->scalar('phone_no')
            ->maxLength('phone_no', 255)
            ->notEmptyString('phone_no', 'Phone No should not be blank');

        $validator
            ->date('date_of_birth')
            ->notEmptyDate('date_of_birth', 'Date of birth should not be blank');

        $validator
            ->scalar('address')
            ->notEmptyString('address', 'Address should not be blank');

        $validator
            ->scalar('country')
            ->maxLength('country', 255)
            ->notEmptyString('country', 'Country should not be blank');

        $validator
            ->scalar('state')
            ->maxLength('state', 255)
            ->notEmptyString('state', 'State should not be blank');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->notEmptyString('city', 'City should not be blank');

        $validator
            ->scalar('pincode')
            ->maxLength('pincode', 255)
            ->notEmptyString('pincode', 'Pincode should not be blank');

        $validator
            ->scalar('status')
            ->notEmptyString('status', 'Status should not be blank');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at', 'Created time and date should not be blank');

        $validator
            ->dateTime('modified_at')
            ->notEmptyDateTime('modified_at', 'Modified time and date should not be blank');

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
        $rules->add($rules->isUnique(['username'], 'Username already exist'), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email'], 'Email already exist'), ['errorField' => 'email']);
        $rules->add($rules->isUnique(['phone_no'], 'Phone no already exist'), ['errorField' => 'phone_no']);

        return $rules;
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
         return $query->where(
            [
                'OR' => [
                    $this->aliasField('email') => $options['username'],
                    $this->aliasField('phone_no') => $options['username'],
                ]
            ],
            [],
            true
        )->where(['Passengers.status' => 'Active']);
    }
}
