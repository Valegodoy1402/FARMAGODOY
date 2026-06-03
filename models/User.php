<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Este es el modelo de la clase para la tabla "usuarios".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_plain
 * @property string $auth_key
 * @property string $access_token
 * @property string $role
 * @property int $status
 * @property string|null $foto
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    // PROPIEDADES VIRTUALES
    public $password;   // Captura la contraseña desde el formulario
    public $imageFile;  // Instancia para la subida del archivo de imagen

    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * Declaración de escenarios activos
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['username', 'password', 'role', 'status', 'auth_key', 'access_token', 'password_plain', 'foto'];
        $scenarios['update'] = ['username', 'password', 'role', 'status', 'auth_key', 'access_token', 'password_plain', 'foto'];
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['username'], 'required'],
            [['password'], 'required', 'on' => 'create'],
            [['status'], 'integer'],
            [['role'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password', 'access_token', 'password_plain', 'foto'], 'string', 'max' => 255],
            [['username'], 'unique'],
            
            // Regla para validar la foto de perfil (máximo 2MB)
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    /**
     * Evento previo al guardado en Base de Datos
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->generateAuthKey();
            $this->generateAccessToken(); 
            $this->created_at = date('Y-m-d H:i:s');
        }
        
        $this->updated_at = date('Y-m-d H:i:s');

        // Si el usuario digitó una contraseña (en creación o actualización)
        if (!empty($this->password)) {
            $this->setPassword($this->password);
            // GUARDAMOS LA CONTRASEÑA REAL EN TEXTO PLANO
            $this->password_plain = $this->password; 
        }

        return true;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Contraseña Real',
            'password_hash' => 'Contraseña Hash',
            'password_plain' => 'Contraseña Texto Plano',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'role' => 'Rol / Permiso',
            'status' => 'Estado',
            'foto' => 'Ruta de la Foto',
            'imageFile' => 'Foto de Perfil',
            'created_at' => 'Creado El',
            'updated_at' => 'Actualizado El',
        ];
    }

    // =========================================================================
    // IMPLEMENTACIÓN DE IDENTITYINTERFACE (Para el Login de Yii)
    // =========================================================================

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => 10]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'status' => 10]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => 10]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    // =========================================================================
    // FUNCIONES DE SEGURIDAD Y ROLES
    // =========================================================================

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString(64);
    }

    public function isAdministrador()
    {
        return $this->role === 'administrador';
    }

    public function isOperador()
    {
        return $this->role === 'operador';
    }
}