<?php

use yii\db\Migration;

class m170127_125713_create_db extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id'    => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),
        ]);

        $this->createTable('vendor', [
            'id'    => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),
        ]);

        $this->createTable('product', [
            'id'        => $this->primaryKey(),
            'title'     => $this->string(255)->notNull(),
            'desc'      => $this->text(),
            'image'     => $this->string(255)->null(),
            'vendor_id' => $this->integer()->notNull()
        ]);
        $this->createIndex('unq_product_vendor', 'product', ['title', 'vendor_id'], true);

        $this->createTable('category_product', [
            'category_id'   => $this->integer()->notNull(),
            'product_id'    => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('category_product_pk', 'category_product', ['category_id', 'product_id']);

        //fk for product.vendor_id
        $this->addForeignKey(
            'fk_product_vendor',
            'product',
            'vendor_id',
            'vendor',
            'id'
        );
        //fk for link table category_product
        $this->addForeignKey(
            'fk_product_category_product',
            'category_product',
            'product_id',
            'product',
            'id'
        );
        $this->addForeignKey(
            'fk_category_category_product',
            'category_product',
            'category_id',
            'category',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_product_vendor', 'product');
        $this->dropForeignKey('fk_product_category_product', 'category_product');
        $this->dropForeignKey('fk_category_category_product', 'category_product');

        $this->dropTable('category_product');
        $this->dropTable('product');
        $this->dropTable('vendor');
        $this->dropTable('category');
    }
}
