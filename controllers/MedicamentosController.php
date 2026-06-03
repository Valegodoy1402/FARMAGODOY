<?php

namespace app\controllers;

use Yii;
use app\models\Medicamentos;
use app\models\MedicamentosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * MedicamentosController implements the CRUD actions for Medicamentos model.
 */
class MedicamentosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            // Corrección: Permitir el acceso tanto al administrador como al operador
                            return isset(Yii::$app->user->identity->role) && 
                                   in_array(Yii::$app->user->identity->role, ['administrador', 'operador']);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Medicamentos models.
     */
    public function actionIndex()
    {
        $searchModel = new MedicamentosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medicamentos model.
     */
    public function actionView($medicamento_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($medicamento_id),
        ]);
    }

    /**
     * Creates a new Medicamentos model.
     */
    public function actionCreate()
    {
        $model = new Medicamentos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Capturar archivo de imagen
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                
                if ($model->imageFile) {
                    $directory = Yii::getAlias('@webroot/uploads/medicamentos/');
                    FileHelper::createDirectory($directory); // Asegura que la carpeta exista
                    
                    $fileName = time() . '_' . uniqid() . '.' . $model->imageFile->extension;
                    if ($model->imageFile->saveAs($directory . $fileName)) {
                        $model->imagen = 'uploads/medicamentos/' . $fileName;
                    }
                }

                if ($model->save(false)) { // Guardamos saltando validación repetida de imagen
                    return $this->redirect(['view', 'medicamento_id' => $model->medicamento_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Medicamentos model.
     */
    public function actionUpdate($medicamento_id)
    {
        $model = $this->findModel($medicamento_id);
        $oldImage = $model->imagen; // Guardamos el nombre de la imagen actual

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile) {
                $directory = Yii::getAlias('@webroot/uploads/medicamentos/');
                FileHelper::createDirectory($directory);
                
                $fileName = time() . '_' . uniqid() . '.' . $model->imageFile->extension;
                if ($model->imageFile->saveAs($directory . $fileName)) {
                    $model->imagen = 'uploads/medicamentos/' . $fileName;
                    
                    // Borrar la foto anterior para no dejar basura en el servidor
                    if (!empty($oldImage) && file_exists(Yii::getAlias('@webroot/') . $oldImage)) {
                        unlink(Yii::getAlias('@webroot/') . $oldImage);
                    }
                }
            } else {
                $model->imagen = $oldImage; // Mantiene la foto anterior si no se sube una nueva
            }

            if ($model->save(false)) {
                return $this->redirect(['view', 'medicamento_id' => $model->medicamento_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Medicamentos model.
     */
    public function actionDelete($medicamento_id)
    {
        $this->findModel($medicamento_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Medicamentos model based on its primary key value.
     */
    protected function findModel($medicamento_id)
    {
        if (($model = Medicamentos::findOne(['medicamento_id' => $medicamento_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}