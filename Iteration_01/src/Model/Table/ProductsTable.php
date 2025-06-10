<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\ProductCategoriesTable&\Cake\ORM\Association\BelongsTo $ProductCategories
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsToMany $Orders
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProductCategories', [
            'foreignKey' => 'product_category_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Orders', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'order_id',
            'joinTable' => 'orders_products',
        ]);
        $this->hasMany('Reviews', [
            'foreignKey' => 'product_id',
            'dependent' => true
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 100)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('stock')
            ->greaterThanOrEqual('stock', 0, 'Stock cannot be negative')
            ->requirePresence('stock', 'create')
            ->notEmptyString('stock');

        $validator
            ->decimal('retail_price')
            ->greaterThan('retail_price', 0, 'Retail price must be greater than 0')
            ->requirePresence('retail_price', 'create')
            ->notEmptyString('retail_price');

        $validator
            ->decimal('wholesale_price')
            ->greaterThan('wholesale_price', 0, 'Wholesale price must be greater than 0')
            ->requirePresence('wholesale_price', 'create')
            ->notEmptyString('wholesale_price');

        $validator
            ->decimal('discount_percent')
            ->greaterThan('discount_percent', 0, 'Discount % must be greater than 0')
            ->requirePresence('discount_percent', 'create')
            ->allowEmptyString('discount_percent');

        $validator
            ->decimal('gst_percentage')
            ->greaterThan('gst_percentage', 0, 'GST % must be greater than 0')
            ->requirePresence('gst_percentage', 'create')
            ->notEmptyString('gst_percentage');

        $validator
            ->decimal('gst_amount')
            ->greaterThan('price', 0, 'GST amount must be greater than 0')
            ->requirePresence('gst_amount', 'create')
            ->notEmptyString('gst_amount');

        $validator
            ->scalar('size')
            ->requirePresence('size', 'create')
            ->allowEmptyString('size');

        $validator
            ->scalar('color')
            ->maxLength('color', 100)
            ->requirePresence('color', 'create')
            ->notEmptyString('color');

        $validator
            ->integer('product_category_id')
            ->notEmptyString('product_category_id');

        $validator
            ->scalar('image_url')
            ->maxLength('image_url', 255)
            ->allowEmptyString('image_url');

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
        $rules->add($rules->existsIn(['product_category_id'], 'ProductCategories'), ['errorField' => 'product_category_id']);

        return $rules;
    }
}
