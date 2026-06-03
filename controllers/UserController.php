<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        // Regla 1: Permitir al operador ENTRAR ÚNICAMENTE al Index
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return isset(Yii::$app->user->identity->role) && Yii::$app->user->identity->role === 'operador';
                        }
                    ],
                    [
                        // Regla 2: Si posees un rol 'administrador', puedes hacer todo (Opcional, por si lo necesitas)
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return isset(Yii::$app->user->identity->role) && Yii::$app->user->identity->role === 'administrador';
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

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'create';

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->imageFile) {
                    $directory = 'uploads/usuarios/';
                    if (!is_dir($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $fileName = time() . '_' . Yii::$app->security->generateRandomString(8) . '.' . $model->imageFile->extension;
                    if ($model->imageFile->saveAs($directory . $fileName)) {
                        $model->foto = $directory . $fileName;
                    }
                }
                
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
            $model->role = null; 
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $oldPhoto = $model->foto; 

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile) {
                $directory = 'uploads/usuarios/';
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                $fileName = time() . '_' . Yii::$app->security->generateRandomString(8) . '.' . $model->imageFile->extension;
                if ($model->imageFile->saveAs($directory . $fileName)) {
                    $model->foto = $directory . $fileName;
                    if (!empty($oldPhoto) && file_exists($oldPhoto)) {
                        unlink($oldPhoto);
                    }
                }
            } else {
                $model->foto = $oldPhoto; 
            }

            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!empty($model->foto) && file_exists($model->foto)) {
            unlink($model->foto);
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}