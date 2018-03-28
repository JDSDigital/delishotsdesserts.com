<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class OptionForm extends Model
{
    public $name;
    public $email;
    public $body;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'body'], 'string'],
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Correo',
            'body' => 'Mensaje',
        ];
    }

    public function sendMail()
    {
        if ($this->validate()) {

            $body = <<<EOT
<p>Mensaje: </p>
<p> $this->body </p>
EOT;

            Yii::$app->mailer->compose()
              ->setTo(Yii::$app->params['adminEmail'])
              ->setFrom([Yii::$app->params['supportEmail'] => 'Delishots Web'])
              ->setSubject('Nuevo pedido desde la página web')
              ->setHtmlBody($body)
              ->send();

            return true;
        }
        return false;
    }
}
