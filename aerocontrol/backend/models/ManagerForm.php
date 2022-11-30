<?php

namespace backend\models;

use common\models\base\UserForm;
use common\models\Manager;
use common\models\User;
use Yii;
use yii\base\ErrorException;

class ManagerForm extends UserForm
{
    // Manager
    public $manager_id;


    public function __construct($manager_id = null, $config = [])
    {
        // Se existir um $manager_id então dá setup do correspondente Manager com este form
        if ($manager_id !== null) {
            $this->setupManagerOnForm($manager_id);
        }

        // Se existir um $manager_id então dá setup do correspondente User com este form
        parent::__construct($manager_id, $config);
    }

    /**
     * Creates new manager
     * @return bool
     */
    public function create()
    {
        $transaction = Manager::getDb()->beginTransaction();
        try {
            if (!parent::create())
                return null;

            // Criar o Manager
            $manager = new Manager();
            $manager->manager_id = $this->user_id;
            if (!$manager->save())
                throw new ErrorException();


            $auth = Yii::$app->authManager;
            $managerRole = $auth->getRole('manager');
            $auth->assign($managerRole, $manager->manager_id);

            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }


        return true;
    }

    /**
     * Updates manager
     * @return bool
     */
    public function update()
    {
        // Updates user
        if (!parent::update())
            return null;


        return true;
    }


    /**
     * Setups manager on form if you have the ID
     *
     * @param int $id Manager ID
     */
    protected function setupManagerOnForm($manager_id)
    {
        $this->$manager_id = $manager_id;
    }
}
