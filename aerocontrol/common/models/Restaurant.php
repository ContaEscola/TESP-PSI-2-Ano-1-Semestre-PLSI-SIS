<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

use function PHPUnit\Framework\isNan;

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

    public $menu;

    public $logoFile;

    // Nome do ficheiro de placeholder caso o restaurante não ter logo
    public $logoPlaceholder = 'logo-placeholder.svg';

    /**
     * Retorna o url do path do logo,
     * caso seja null na BD então retorna [[$this->logoPlaceholder]]
     * 
     * @return string Url do path do logo
     */
    public function getLogoPathUrl()
    {
        if (is_null($this->logo))
            return '@web/images/' . $this->logoPlaceholder;
        else
            return '@uploadLogoRestaurantsUrl/' . $this->logo;
    }

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
            [['name', 'description', 'phone', 'logo', 'website'], 'trim'],
            [['logo', 'website'], 'default', 'value' => null],

            [['name', 'description', 'phone'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['open_time', 'close_time'], 'time'],
            ['name', 'string', 'max' => 75],
            ['description', 'string', 'max' => 255],

            [
                'phone', 'number',
                'numberPattern' => '/[\d]{4,15}$/', 'message' => "O nº de telemóvel só pode conter números, ter pelo menos 4 números e não pode exceder os 15 números.",
            ],

            ['website', 'string', 'max' => 50],
            [['name'], 'unique', 'message' => "Este {attribute} já está a ser utilizado."],

            [
                'logoFile', 'image', 'notImage' => '{file} não é uma imagem.'
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
            'logo' => 'Logo do Restaurante',
            'logoFile' => 'Logo do Restaurante',
            'website' => 'Website',
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['menu'] = "menu";
        return $fields;
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

    /**
     * Antes de validar dá a instancia do UploadedFila a [[$this->logoFile]]
     */
    public function beforeValidate()
    {
        $this->logoFile = UploadedFile::getInstance($this, 'logoFile');

        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Se estivermos num update
        if (!$insert) {
            // Se existir um novo logo então dá delete do antigo, é dá upload do novo
            if (!is_null($this->logoFile)) {
                $this->deleteLogo();
                if (!$this->upload())
                    return false;
            }
        } else {
            // Se o [[$this->logoFile]] não for null, ou seja, não escolheu um logo, então não é preciso fazer o upload
            if (!is_null($this->logoFile)) {
                if (!$this->upload())
                    return false;
            }
        }

        return true;
    }

    /**
     * Antes de dar delete apaga o logo do server
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $this->deleteLogo();

        return true;
    }


    /**
     * Uploads [[$this->logoFile]] to the server and assigns [[$this->logo]] to the logo file name
     * 
     * @return boolean true whether the upload was successfully
     */
    protected function upload()
    {
        if (!FileHelper::createDirectory(Yii::getAlias('@uploadLogoRestaurants')))
            return false;

        $image_name =  $this->name . '_' . date("d-m-Y_H-i") . '.' . $this->logoFile->extension;
        $image_path = Yii::getAlias('@uploadLogoRestaurants/') . $image_name;

        if ($this->logoFile->saveAs($image_path)) {
            $this->logo = $image_name;
            return true;
        }

        return false;
    }

    /**
     * Deletes the logo from the server if [[$this->logo] != null]
     * 
     * @return boolean true whether the logo file was deleted from the server successfully
     */
    public function deleteLogo()
    {
        if (!is_null($this->logo)) {
            if (!unlink(Yii::getAlias('@uploadLogoRestaurants/') . $this->logo))
                return false;
        }

        return true;
    }
}
