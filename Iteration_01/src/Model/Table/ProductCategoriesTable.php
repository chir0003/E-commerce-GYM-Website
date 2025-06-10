<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductCategories Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 *
 * @method \App\Model\Entity\ProductCategory newEmptyEntity()
 * @method \App\Model\Entity\ProductCategory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductCategory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductCategory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductCategory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductCategory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductCategory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductCategory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductCategory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductCategory> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductCategoriesTable extends Table
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

        $this->setTable('product_categories');
        $this->setDisplayField('category');
        $this->setPrimaryKey('id');

        $this->hasMany('Products', [
            'foreignKey' => 'product_category_id',
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
            ->scalar('category')
            ->maxLength('category', 100)
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

        return $validator;
    }
}
