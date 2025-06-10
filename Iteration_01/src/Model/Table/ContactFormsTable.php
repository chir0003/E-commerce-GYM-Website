<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContactForms Model
 *
 * @method \App\Model\Entity\ContactForm newEmptyEntity()
 * @method \App\Model\Entity\ContactForm newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ContactForm> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ContactForm get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ContactForm findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ContactForm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ContactForm> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ContactForm|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ContactForm saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ContactForm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactForm>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactForm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactForm> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactForm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactForm>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ContactForm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ContactForm> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContactFormsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('contact_forms');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 256)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->maxLength('name', 256)
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('message')
            ->maxLength('name', 1024)
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        return $validator;
    }
}
