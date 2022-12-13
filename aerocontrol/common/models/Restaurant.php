<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property string|null $name
 * @property string $description
 * @property string $phone
 * @property string|null $open_time
 * @property string|null $close_time
 * @property string|null $logo
 * @property string|null $website
 *
 * @property Manager[] $managers
 * @property RestaurantItem[] $restaurantItems
 */
class Restaurant extends \yii\db\ActiveRecord
{

    // Formatar as datas visualmente se encontrar um registo
    public function afterFind()
    {
        $this->close_time = Yii::$app->formatter->asTime($this->close_time);
        $this->open_time = Yii::$app->formatter->asTime($this->open_time);
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%restaurant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'phone'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['open_time', 'close_time'], 'time'],
            [['name', 'description', 'phone', 'logo', 'website'], 'trim'],
            ['name', 'string', 'max' => 75],
            ['description', 'string', 'max' => 255],

            [
                'phone', 'number',
                'numberPattern' => '/[\d]{4,15}$/', 'message' => "O nº de telemóvel só pode conter números, ter pelo menos 4 números e não pode exceder os 15 números.",
            ],

            ['website', 'string', 'max' => 50],
            [['name', 'logo'], 'unique', 'message' => "Este {attribute} já está a ser utilizado."],
            [
                'logo', 'image',
                'extensions' => 'jpg, png, jpeg, jfif', 'wrongExtension' => 'Este tipo de imagem não é suportado.',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'description' => 'Descrição',
            'phone' => 'Nº Telemóvel',
            'open_time' => 'Horário de abertura',
            'close_time' => 'Horário de fecho',
            'logo' => 'Logo',
            'website' => 'Website',
        ];
    }

    /**
     * Gets query for [[Managers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManagers()
    {
        return $this->hasMany(Manager::class, ['restaurant_id' => 'id']);
    }

    /**
     * Gets query for [[RestaurantItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurantItems()
    {
        return $this->hasMany(RestaurantItem::class, ['restaurant_id' => 'id']);
    }

    // public function beforeValidate()
    // {
    //     $this->logo = UploadedFile::getInstance($this, 'logo');

    //     return parent::beforeValidate();
    // }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->logo = UploadedFile::getInstance($this, 'logo');
        if (!$this->upload())
            return false;

        return true;
    }


    /**
     * Uploads the [[$this->logo]] to the server
     * 
     * @return boolean true whether the upload was successfully
     */
    protected function upload()
    {
        if (!FileHelper::createDirectory(Yii::getAlias('@uploadLogos')))
            return false;

        $image_name =  $this->name . '_' . date("d-m-Y_H-i") . '.' . $this->logo->extension;
        $image_path = Yii::getAlias('@uploadLogos') . '/' . $image_name;

        if ($this->logo->saveAs($image_path)) {
            $this->logo = $image_name;
            return true;
        }

        return false;
    }
}
