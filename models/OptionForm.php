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

            $order = '<table style="text-align: left">';
            $order .= '<tr>';
            $order .= '<td>Producto</td>';
            $order .= '<td>Presentación</td>';
            $order .= '<td>Cantidad</td>';
            $order .= '<td>Empaque</td>';
            $order .= '<td>Precio Empaque Individual</td>';
            $order .= '<td>Precio Empaque Total</td>';
            $order .= '<td>Precio Unitario</td>';
            $order .= '<td>Precio Total</td>';
            $order .= '</tr>';

            foreach (Yii::$app->session->get('cart')['items'] as $key => $value) {
              $order .= '<tr>';
              $order .= '<td>' . $value['name'] . '</td>';
              $order .= '<td>' . $value['form'] . '</td>';
              $order .= '<td>' . $value['quantity'] . '</td>';
              $order .= '<td>' . ($value['box']) ? $value['box'] : 'Sin Empaque' . '</td>';
              $order .= '<td>' . Yii::$app->formatter->asCurrency($value['boxPrice'], 'VEF') . '</td>';
              $order .= '<td>' . Yii::$app->formatter->asCurrency($value['boxTotal'], 'VEF') . '</td>';
              $order .= '<td>' . Yii::$app->formatter->asCurrency($value['price'], 'VEF') . '</td>';
              $order .= '<td>' . Yii::$app->formatter->asCurrency($value['priceTotal'], 'VEF') . '</td>';
              $order .= '</tr>';
            }

            $order .= '<tr>';
            $order .= '<td colspan="7"><strong>Total:</strong></td>';
            $order .= '<td><strong>' . Yii::$app->formatter->asCurrency(Yii::$app->session->get('cart')['total'], 'VEF') . '</strong></td>';
            $order .= '</tr>';
            $order .= '</table>';

            Yii::$app->mailer->compose('order', [
                'name' => $this->name,
                'email' => $this->email,
                'body' => ($this->body) ? $this->body : 'No hay comentarios que mostrar.',
                'order' => $order,
              ])
              ->setTo(Yii::$app->params['adminEmail'])
              ->setFrom([Yii::$app->params['supportEmail'] => 'Delishots Web'])
              ->setSubject('Nuevo pedido desde la página web')
              ->send();

            Yii::$app->mailer->compose('confirmation', [
                'order' => $order,
              ])
              ->setTo($this->email)
              ->setFrom([Yii::$app->params['supportEmail'] => 'Delishots Web'])
              ->setSubject('Hemos recibido su pedido')
              ->send();

            Yii::$app->session->remove('cart');

            return true;
        }
        return false;
    }
}
