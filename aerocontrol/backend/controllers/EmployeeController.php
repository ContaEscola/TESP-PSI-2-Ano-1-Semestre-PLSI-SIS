<?php

namespace backend\controllers;

use common\models\Employee;
use common\models\EmployeeFunction;
use common\models\EmployeeSearch;
use common\models\User;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['viewEmployee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewEmployee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createEmployee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateEmployee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteEmployee'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $employees = Employee::find()->all();
        return $this->render('index', [
            'employees' => $employees,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param int $employee_id Employee ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $employee_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($employee_id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Employee();

        if ($this->request->isPost) {
            $post = \Yii::$app->request->post();
            $post['Employee']['function_id'] = $post['EmployeeFunction']['id'];
            $model->attributes = $post['Employee'];
            $user = new User();
            $user->attributes = $post['User'];
            $date = date_create($user->birthdate);
            $user->birthdate = date_format($date, "Y-m-d");
            $user->setPassword($user->password_hash);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->status = 10;

            if ($user->validate() && $model->validate()) {
                if ($user->save()) {
                    $model->employee_id = $user->id;
                    if ($model->save())
                        return $this->redirect(['view', 'employee_id' => $model->employee_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        $user = new User();
        $function = new EmployeeFunction();
        $employee_functions = EmployeeFunction::find()->select(['id', 'name'])->all();
        foreach ($employee_functions as $function)
            $functions[$function->id] = $function->name;

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'function' => $function,
            'functions' => $functions,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $employee_id Employee ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($employee_id)
    {
        $model = $this->findModel($employee_id);

        if ($this->request->isPost ) {
            $post = \Yii::$app->request->post();
            $post['Employee']['function_id'] = $post['EmployeeFunction']['id'];
            $model->attributes = $post['Employee'];
            $user = User::findOne($employee_id);
            $user->attributes = $post['User'];
            $date = date_create($user->birthdate);
            $user->birthdate = date_format($date,"Y-m-d");
            if($user->save() && $model->save())
                return $this->redirect(['view', 'employee_id' => $model->employee_id]);
        }

        $employee_functions = EmployeeFunction::find()->select(['id', 'name'])->all();

        foreach ($employee_functions as $function)
            $functions[$function->id] = $function->name;

        if (!$this->request->isPost )
        return $this->render('update', [
            'model' => $model,
            'functions'=>$functions,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $employee_id Employee ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $employee_id)
    {
        $this->findModel($employee_id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $employee_id Employee ID
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($employee_id)
    {
        if (($model = Employee::findOne(['employee_id' => $employee_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
