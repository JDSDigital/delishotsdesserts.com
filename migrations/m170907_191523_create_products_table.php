<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m170907_191523_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ds_users}}', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'role'                 => $this->string()->notNull(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email'                => $this->string()->notNull()->unique(),

            'status'     => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->createTable('{{%ds_products}}', [
            'id'          => $this->primaryKey(),
            'product'     => $this->string()->null(),
            'name'        => $this->string()->null(),
            'description' => $this->string(1028)->null(),
            'priceFull'   => $this->double()->null(),
            'priceShot'   => $this->double()->null(),
            'price5oz'    => $this->double()->null(),
            'price8oz'    => $this->double()->null(),

            'status'     => $this->smallInteger()->notNull()->defaultValue(1)->comment("Status. It depends on the activation after the client registers on the webpage."),
            'created_at' => $this->integer()->null()->comment("Creation date"),
            'updated_at' => $this->integer()->null()->comment("Update date"),
        ]);

        $this->insert('{{%ds_users}}', [
            'username'      => 'Admin',
            'role'          => 'admin',
            'auth_key'      => '8yodFzc4J0-0efBA6uJaymkejpVS6qlg',
            'password_hash' => '$2y$13$anHn/UT2OXHjJp9Yt99ct.RjfMCPsHLvPPK.DjaTEc0dcp0yRPu4K',
            'email'         => 'jdsosa@gmail.com',
        ]);

        $this->batchInsert('{{%ds_products}}', ['product', 'name', 'description'], [
            [
                'caramel-dreams',
                'Caramel Dreams',
                'Es un postre exquisito conformado por deliciosos y vaporosos suspiros que navegan elegantemente sobre una crema inglesa ligeramente espesa y sutil.',
            ],
            [
                'four-elements',
                'Four Elements',
                'Es una deliciosa torta húmeda que consiste en un bizcocho bañado con tres tipos de leche: leche evaporada, leche condensada y crema de leche. Acompañado de merengue aromatizado con esencia de caramelo.',
            ],
            [
                'sweet-lemon',
                'Sweet Passion',
                'Este pastel es una combinación deliciosa, de base crujiente de galletas, con un relleno muy cremoso con sabor y aroma a limones frescos o parchita, no hay mejor manera de coronar este postre que con nuestra especial nube de merengue.',
            ],
            [
                'choco-lovers',
                'Choco Lovers',
                'El Choco Lovers es un delicioso mousse, que consta de una textura espumosa elaborado con el mejor chocolate combinándolo con pequeños trozos de galleta y trufa que complementan su exquisito sabor.',
            ],
            [
                'soft-hazelnuts',
                'Soft Hazelnuts',
                'Exquisita torta en capas, donde se alterna un bizcocho de almendras con una suave crema de mantequilla y avellanas.',
            ],
            [
                'three-elements',
                'Three Elements',
                'Es un dulce conformado por múltiples capas de bizcocho, crema de mantequilla y leche condensada, complementada con un topping de almendras caramelizadas y ganache de chocolate, logrando una combinación mundial.',
            ],
            [
                'crazy-brownie',
                'Crazy Brownie',
                'El brownie original es un bizcocho de chocolate con nueces de origen estadounidense. Nuestro brownie lo preparamos con un tope delicado de leche condensada y nutella.',
            ],
            [
                'dark-explotion',
                'Dark Explotion',
                'Es una torta atractiva y enigmática, con discos de merengue de chocolate apilados entre capas de delicioso mousse de chocolate y decorada con merengues crujientes.',
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ds_users}}');
        $this->dropTable('{{%ds_products}}');
    }
}
