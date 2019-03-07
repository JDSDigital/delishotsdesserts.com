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
            'type'        => $this->integer()->notNull()->defaultValue(1),
            'product'     => $this->string()->null(),
            'name'        => $this->string()->null(),
            'description' => $this->string(1028)->null(),
            'priceSlice'  => $this->double()->null(),
            'priceGlass'  => $this->double()->null(),
            'priceFull'   => $this->double()->null(),
            'priceShot'   => $this->double()->null(),
            'price5oz'    => $this->double()->null(),
            'price8oz'    => $this->double()->null(),
            'priceDeli'   => $this->double()->null(),

            'status'     => $this->smallInteger()->notNull()->defaultValue(1)->comment("Status. It depends on the activation after the client registers on the webpage."),
            'created_at' => $this->integer()->null()->comment("Creation date"),
            'updated_at' => $this->integer()->null()->comment("Update date"),
        ]);

        $this->insert('{{%ds_users}}', [
            'username'      => 'Admin',
            'role'          => 'admin',
            'auth_key'      => '6-Oj7UlbBzGErKAjXidC-QNhtATWbctw',
            'password_hash' => '$2y$13$GbyLKMHbbu/dWxnafz9znudqQUKdcwpqhlePxhD1xoJloE2./EqBC',
            'email'         => 'jdsosa@gmail.com',
        ]);

        $this->batchInsert('{{%ds_products}}', ['type', 'product', 'name', 'description'], [
            [
                1,
                'caramel-dreams',
                'Caramel Dreams',
                'Es un postre exquisito conformado por deliciosos y vaporosos suspiros que navegan elegantemente sobre una crema inglesa ligeramente espesa y sutil.',
            ],
            [
                1,
                'four-elements',
                'Four Elements',
                'Es una deliciosa torta húmeda que consiste en un bizcocho bañado con tres tipos de leche: leche evaporada, leche condensada y crema de leche. Acompañado de merengue aromatizado con esencia de caramelo.',
            ],
            [
                1,
                'sweet-lemon',
                'Sweet Passion',
                'Este pastel es una combinación deliciosa, de base crujiente de galletas, con un relleno muy cremoso con sabor y aroma a limones frescos o parchita, no hay mejor manera de coronar este postre que con nuestra especial nube de merengue.',
            ],
            [
                1,
                'choco-lovers',
                'Choco Lovers',
                'El Choco Lovers es un delicioso mousse, que consta de una textura espumosa elaborado con el mejor chocolate combinándolo con pequeños trozos de galleta y trufa que complementan su exquisito sabor.',
            ],
            [
                1,
                'soft-hazelnuts',
                'Soft Hazelnuts',
                'Exquisita torta en capas, donde se alterna un bizcocho de almendras con una suave crema de mantequilla y avellanas.',
            ],
            [
                1,
                'three-elements',
                'Three Elements',
                'Es un dulce conformado por múltiples capas de bizcocho, crema de mantequilla y leche condensada, complementada con un topping de almendras caramelizadas y ganache de chocolate, logrando una combinación mundial.',
            ],
            [
                1,
                'crazy-brownie',
                'Crazy Brownie',
                'El brownie original es un bizcocho de chocolate con nueces de origen estadounidense. Nuestro brownie lo preparamos con un tope delicado de leche condensada y nutella.',
            ],
            [
                1,
                'dark-explotion',
                'Dark Explotion',
                'Es una torta atractiva y enigmática, con discos de merengue de chocolate apilados entre capas de delicioso mousse de chocolate y decorada con merengues crujientes.',
            ],
            [
                1,
                'cheesecake-blanco',
                'Cheesecake de Chocolate Blanco con Topping de Fresa/Mora',
                'Deliciosa mezcla de queso crema y chocolate blanco, con aroma a vainilla preparada sobre una base crujiente de galleta y recubierto con un espejo de dulce de fresa o mora.',
            ],
            [
                1,
                'cheesecake-oreo',
                'Cheesecake de Oreo con Topping de Chocolate y Oreo',
                'Exquisita torta de suave textura con la mezcla del queso crema y las galletas Oreo, sobre una base de galletas pulverizadas y una cubierta de chocolate.',
            ],
            [
                1,
                'tiramisu',
                'Tiramisú',
                'Es un exquisito capricho italiano para los amantes del dulce y del café, donde se combinan sabores como el queso y el cacao amargo.',
            ],
            [
                1,
                'mousse',
                'Mousse de Choco Parchita',
                'Sutil mousse de parchita mezclado con una cremosa capa de chocolate, una combinación sinigual, el ácido de la fruta y el toque del chocolate.',
            ],
            [
                1,
                'milky-rice',
                'Milky Rice',
                'El arroz con leche es uno de los postres más tradicionales de nuestra gastronomía. Se trata de un postre delicioso, de textura suave que al comerlo recordaremos los sabores de los postres de las abuelas.',
            ],
            [
                1,
                'profiteroles',
                'Profiteroles',
                'Los profiteroles son pequeñas esferas, elaboradas con pasta choux rellenas de ingredientes dulces como crema o chocolate y se decoran con diferentes topping, al morderlos explota una sensación de sabores.',
            ],
            [
                1,
                'red-velvet',
                'Red Velvet',
                'Un pastel de terciopelo rojo “Red Velvet Cake“ es un postre que con su tintura escarlata seduce y deleita a todos. Se caracteriza por incluir tres sabores fuertes que se mezclan: la vainilla, un rico chocolate y una cubierta de queso crema.',
            ],
            [
                1,
                'passion-nuts',
                'Passion Nuts',
                'Exquisita torta de bizcocho de almendras alternados entre crema de almendras y crema de frutas tropicales con topping de almendras acarameladas y pistacho tostado.',
            ],
            [
                1,
                'coffee-cake',
                'Coffee Cake',
                'Excelente torta donde se destaca lo suave y esponjoso de su interior con los frutos secos y el rico aroma de la canela.',
            ],
            [
                3,
                'alfajores',
                'Alfajores',
                'La palabra alfajor se utiliza para designar a una especie de bocado dulce, realizado como un tipo de galleta esponjosa y suave a base de maicena, rellenos con dulce de leche y decorados con coco rallado.',
            ],
            [
                5,
                'bomboneria',
                'Bombonería Surtida',
                'Bombones de chocolate elaborados con el mejor cacao proveniente de las diferentes regiones del país, con una gran variedad de rellenos, texturas y colores, que sólo probarlos quedarán enamorados de la combinación entre aromas y sabores que se funden dentro de su boca.',
            ],
            [
                3,
                'tartaletas',
                'Tartaleta de Frutas',
                'Exquisitas tartaletas, que comienzan con una excelente base de masa dulce de almendras y terminan con los más selectos y sabrosos rellenos de frutas y mousse de diferentes sabores, conformando un postre ligero y muy sabroso.',
            ],
            [
                3,
                'chococookies',
                'Chococookies',
                'Tartaletas elaboradas con una deliciosa base de masa quebrada y rellenas con un exquisito ganache, donde se combinan los mejores chocolates venezolanos.',
            ],
            [
                3,
                'polvorosas',
                'Polvorosas',
                'Exquisito dulce en forma de galleta, su sabor es suave y su textura es arenosa, al comerlo se deshace en tu boca.',
            ],
            [
                3,
                'macarrones',
                'Macarrones',
                'Los macarrones que ofrecemos son una especie de galletas francesas de diferentes colores a base de clara de huevo, azúcar glas y almendra molida, rellenos de  diferentes sabores.',
            ],
            [
                3,
                'snowflake',
                'Snowflake',
                'Inspirados en pequeños copos de nieve, aromatizados con extractos de diferentes sabores los cuales sorprenderán tus sentidos.',
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
