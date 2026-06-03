<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Medicamentos".
 *
 * @property int $medicamento_id
 * @property string $nombre_comercial
 * @property string|null $componente_activo
 * @property string|null $laboratorio
 * @property float $precio
 * @property int $stock
 * @property string $fecha_vencimiento
 * @property string|null $imagen
 *
 * @property Ventas[] $ventas
 */
class Medicamentos extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile Propiedad virtual para capturar el archivo del formulario
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Medicamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['componente_activo', 'laboratorio', 'imagen'], 'default', 'value' => null],
            [['stock'], 'default', 'value' => 0],
            [['nombre_comercial', 'precio', 'fecha_vencimiento'], 'required'],
            [['precio'], 'number'],
            [['stock'], 'integer'],
            [['fecha_vencimiento'], 'safe'],
            [['nombre_comercial', 'componente_activo', 'laboratorio'], 'string', 'max' => 100],
            [['imagen'], 'string', 'max' => 255],
            // Nueva regla de validación estricta para la imagen subida
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'medicamento_id' => 'Medicamento ID',
            'nombre_comercial' => 'Nombre Comercial',
            'componente_activo' => 'Componente Activo',
            'laboratorio' => 'Laboratorio',
            'precio' => 'Precio',
            'stock' => 'Stock',
            'fecha_vencimiento' => 'Fecha Vencimiento',
            'imagen' => 'Imagen descriptiva',
            'imageFile' => 'Subir Foto del Medicamento',
        ];
    }

    /**
     * Disparador automático que elimina el archivo del servidor si el registro es borrado
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if (!empty($this->imagen)) {
                $filePath = Yii::getAlias('@webroot/') . $this->imagen;
                if (file_exists($filePath)) {
                    unlink($filePath); // Borra físicamente la imagen vinculada de la carpeta uploads
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::class, ['medicamento_id' => 'medicamento_id']);
    }
}