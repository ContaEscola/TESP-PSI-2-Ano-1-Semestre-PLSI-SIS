<?php

use yii\db\Migration;

/**
 * Class m221115_155756_init_rbac
 */
class m221115_155756_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        //Creating Roles
        $admin = $auth->createRole('admin');
        $admin->description = "Administrador";
        $auth->add($admin);

        $employee = $auth->createRole('employee');
        $employee->description = "Trabalhador";
        $auth->add($employee);

        $manager = $auth->createRole('manager');
        $manager->description = "Gerente do Restaurante";
        $auth->add($manager);

        $client = $auth->createRole('client');
        $client->description = "Cliente";
        $auth->add($client);

        //Create Permissions

        /*
            Admin Permissions
        */
        $createAdmin = $auth->createPermission('createAdmin');
        $createAdmin->description= "Criar Admin";
        $auth->add($createAdmin);

        $updateAdmin = $auth->createPermission('updateAdmin');
        $updateAdmin->description = "Atualizar Admin";
        $auth->add($updateAdmin);

        $viewAdmin = $auth->createPermission('viewAdmin');
        $viewAdmin->description = "Visualizar Admin";
        $auth->add($viewAdmin);

        $deleteAdmin = $auth->createPermission('deleteAdmin');
        $deleteAdmin->description = "Apagar Admin";
        $auth->add($deleteAdmin);

        /*
            Flight Permissions
        */
        $createFlight = $auth->createPermission('createFlight');
        $createFlight->description= "Criar voo";
        $auth->add($createFlight);

        $updateFlight = $auth->createPermission('updateFlight');
        $updateFlight->description = "Atualizar voo";
        $auth->add($updateFlight);

        $viewFlight = $auth->createPermission('viewFlight');
        $viewFlight->description = "Visualizar voo";
        $auth->add($viewFlight);

        /*
            LostItems Permissions
        */
        $createLostItem = $auth->createPermission('createLostItem');
        $createLostItem->description= "Criar item dos perdidos e achados";
        $auth->add($createLostItem);

        $updateLostItem = $auth->createPermission('updateLostItem');
        $updateLostItem->description = "Atualizar item dos perdidos e achados";
        $auth->add($updateLostItem);

        $viewLostItem = $auth->createPermission('viewLostItem');
        $viewLostItem->description = "Visualizar item dos perdidos e achados";
        $auth->add($viewLostItem);

        $deleteLostItem = $auth->createPermission('deleteLostItem');
        $deleteLostItem->description = "Apagar item dos perdidos e achados";
        $auth->add($deleteLostItem);

        /*
            SupportTicket Messages Permissions
        */
        $createMessage = $auth->createPermission('createMessage');
        $createMessage->description= "Criar Messagem";
        $auth->add($createMessage);

        $updateMessage = $auth->createPermission('updateMessage');
        $updateMessage->description = "Atualizar Messagem";
        $auth->add($updateMessage);

        $viewMessage = $auth->createPermission('viewMessage');
        $viewMessage->description = "Visualizar Messagem";
        $auth->add($viewMessage);

        $deleteMessage = $auth->createPermission('deleteMessage');
        $deleteMessage->description = "Apagar Mensagem";
        $auth->add($deleteMessage);

        /*
            Airplane Permissions
        */
        $createAirplane = $auth->createPermission('createAirplane');
        $createAirplane->description= "Criar Avião";
        $auth->add($createAirplane);

        $updateAirplane = $auth->createPermission('updateAirplane');
        $updateAirplane->description = "Atualizar Avião";
        $auth->add($updateAirplane);

        $viewAirplane = $auth->createPermission('viewAirplane');
        $viewAirplane->description = "Visualizar Avião";
        $auth->add($viewAirplane);

        /*
            Airport Permissions
        */
        $createAirport = $auth->createPermission('createAirport');
        $createAirport->description= "Criar Aeroporto";
        $auth->add($createAirport);

        $updateAirport = $auth->createPermission('updateAirport');
        $updateAirport->description = "Atualizar Aeroporto";
        $auth->add($updateAirport);

        $viewAirport = $auth->createPermission('viewAirport');
        $viewAirport->description = "Visualizar Aeroporto";
        $auth->add($viewAirport);

        /*
            PaymentMethod Permissions
        */
        $updatePaymentMethod = $auth->createPermission('updatePaymentMethod');
        $updatePaymentMethod->description = "Atualizar método de pagamento";
        $auth->add($updatePaymentMethod);

        $viewPaymentMethod = $auth->createPermission('viewPaymentMethod');
        $viewPaymentMethod->description = "Visualizar método de pagamento";
        $auth->add($viewPaymentMethod);

        /*
            Client Permissions
        */

        $updateClient = $auth->createPermission('updateClient');
        $updateClient->description = "Atualizar Cliente";
        $auth->add($updateClient);

        $viewClient = $auth->createPermission('viewClient');
        $viewClient->description = "Visualizar Cliente";
        $auth->add($viewClient);

        $deleteClient = $auth->createPermission('deleteClient');
        $deleteClient->description = "Apagar Cliente";
        $auth->add($deleteClient);

        /*
            Ticket Permissions
        */
        $createTicket = $auth->createPermission('createTicket');
        $createTicket->description= "Criar bilhete de voo";
        $auth->add($createTicket);

        $updateTicket = $auth->createPermission('updateTicket');
        $updateTicket->description = "Atualizar bilhete de voo";
        $auth->add($updateTicket);

        $viewTicket = $auth->createPermission('viewTicket');
        $viewTicket->description = "Visualizar bilhete de voo";
        $auth->add($viewTicket);

        /*
            Restaurant Permissions
        */
        $createRestaurant = $auth->createPermission('createRestaurant');
        $createRestaurant->description= "Criar Restaurante";
        $auth->add($createRestaurant);

        $updateRestaurant = $auth->createPermission('updateRestaurant');
        $updateRestaurant->description = "Atualizar Restaurante";
        $auth->add($updateRestaurant);

        $viewRestaurant = $auth->createPermission('viewRestaurant');
        $viewRestaurant->description = "Visualizar Restaurante";
        $auth->add($viewRestaurant);

        $deleteRestaurant = $auth->createPermission('deleteRestaurant');
        $deleteRestaurant->description = "Apagar Restaurante";
        $auth->add($deleteRestaurant);

        $deleteRestaurantLogo = $auth->createPermission('deleteRestaurantLogo');
        $deleteRestaurantLogo->description = "Eliminar Logo do Restaurante";
        $auth->add($deleteRestaurantLogo);

        /*
            RestaurantItem Permissions
        */
        $createRestaurantItem = $auth->createPermission('createRestaurantItem');
        $createRestaurantItem->description= "Criar item da ementa";
        $auth->add($createRestaurantItem);

        $updateRestaurantItem = $auth->createPermission('updateRestaurantItem');
        $updateRestaurantItem->description = "Atualizar item da ementa";
        $auth->add($updateRestaurantItem);

        $viewRestaurantItem = $auth->createPermission('viewRestaurantItem');
        $viewRestaurantItem->description = "Visualizar item da ementa";
        $auth->add($viewRestaurantItem);

        $deleteRestaurantItem = $auth->createPermission('deleteRestaurantItem');
        $deleteRestaurantItem->description = "Apagar item da ementa";
        $auth->add($deleteRestaurantItem);

        /*
            Manager Permissions
        */
        $createManager = $auth->createPermission('createManager');
        $createManager->description= "Criar gerente do restaurante";
        $auth->add($createManager);

        $updateManager = $auth->createPermission('updateManager');
        $updateManager->description = "Atualizar gerente do restaurante";
        $auth->add($updateManager);

        $viewManager = $auth->createPermission('viewManager');
        $viewManager->description = "Visualizar gerente do restaurante";
        $auth->add($viewManager);

        $deleteManager = $auth->createPermission('deleteManager');
        $deleteManager->description = "Apagar gerente do restaurante";
        $auth->add($deleteManager);

        /*
            Store Permissions
        */
        $createStore = $auth->createPermission('createStore');
        $createStore->description= "Criar Loja";
        $auth->add($createStore);

        $updateStore = $auth->createPermission('updateStore');
        $updateStore->description = "Atualizar Loja";
        $auth->add($updateStore);

        $viewStore = $auth->createPermission('viewStore');
        $viewStore->description = "Visualizar Loja";
        $auth->add($viewStore);

        $deleteStore = $auth->createPermission('deleteStore');
        $deleteStore->description = "Apagar Loja";
        $auth->add($deleteStore);

        $deleteStoreLogo = $auth->createPermission('deleteStoreLogo');
        $deleteStoreLogo->description = "Eliminar Logo da Loja";
        $auth->add($deleteStoreLogo);

        /*
            Company Permissions
        */
        $createCompany = $auth->createPermission('createCompany');
        $createCompany->description= "Criar companhia";
        $auth->add($createCompany);

        $updateCompany = $auth->createPermission('updateCompany');
        $updateCompany->description = "Atualizar companhia";
        $auth->add($updateCompany);

        $viewCompany = $auth->createPermission('viewCompany');
        $viewCompany->description = "Visualizar companhia";
        $auth->add($viewCompany);

        /*
            Employee Permissions
        */
        $createEmployee = $auth->createPermission('createEmployee');
        $createEmployee->description= "Criar Loja";
        $auth->add($createEmployee);

        $updateEmployee = $auth->createPermission('updateEmployee');
        $updateEmployee->description = "Atualizar Loja";
        $auth->add($updateEmployee);

        $viewEmployee = $auth->createPermission('viewEmployee');
        $viewEmployee->description = "Visualizar Loja";
        $auth->add($viewEmployee);

        $deleteEmployee = $auth->createPermission('deleteEmployee');
        $deleteEmployee->description = "Apagar Loja";
        $auth->add($deleteEmployee);

        /*
            ServerLog Permissions
        */
        $viewServerLog = $auth->createPermission('viewServerLog');
        $viewServerLog->description = "Visualizar log do servidor";
        $auth->add($viewServerLog);

        /*
            SupportTicket Permissions
        */
        $createSupportTicket = $auth->createPermission('createSupportTicket');
        $createSupportTicket->description= "Criar Suport Ticket";
        $auth->add($createSupportTicket);

        $updateSupportTicket = $auth->createPermission('updateSuportTicket');
        $updateSupportTicket->description = "Atualizar Suport Ticket";
        $auth->add($updateSupportTicket);

        $viewSupportTicket = $auth->createPermission('viewSuportTicket');
        $viewSupportTicket->description = "Visualizar Suport Ticket";
        $auth->add($viewSupportTicket);

        /*
          Rules
         */
        $managerRule = new \console\rules\ManagerRule;
        $auth->add($managerRule);

        $clientRule = new \console\rules\ClientRule();
        $auth->add($clientRule);

        /*
            Rule Permissions
        */

        /*
            Own Restaurant Item Permissions
         */
        $createOwnRestaurantItem = $auth->createPermission("createOwnRestaurantItem");
        $createOwnRestaurantItem->description = "Criar item do restaurante";
        $createOwnRestaurantItem->ruleName = $managerRule->name;
        $auth->add($createOwnRestaurantItem);
        $auth->addChild($createOwnRestaurantItem,$createRestaurantItem);

        $viewOwnRestaurantItem = $auth->createPermission("viewOwnRestaurantItem");
        $viewOwnRestaurantItem->description = "Visualizar item do restaurante";
        $viewOwnRestaurantItem->ruleName = $managerRule->name;
        $auth->add($viewOwnRestaurantItem);
        $auth->addChild($viewOwnRestaurantItem,$viewRestaurantItem);

        $deleteOwnRestaurantItem = $auth->createPermission("deleteOwnRestaurantItem");
        $deleteOwnRestaurantItem->description = "Apagar item do restaurante";
        $deleteOwnRestaurantItem->ruleName = $managerRule->name;
        $auth->add($deleteOwnRestaurantItem);
        $auth->addChild($deleteOwnRestaurantItem,$deleteRestaurantItem);

        $updateOwnRestaurantItem = $auth->createPermission("updateOwnRestaurantItem");
        $updateOwnRestaurantItem->description = "Atualizar item do restaurante";
        $updateOwnRestaurantItem->ruleName = $managerRule->name;
        $auth->add($updateOwnRestaurantItem);
        $auth->addChild($updateOwnRestaurantItem,$updateRestaurantItem);

        /*
            Own Restaurant Permissions
        */

        $viewOwnRestaurant = $auth->createPermission("viewOwnRestaurant");
        $viewOwnRestaurant->description = "Visualizar restaurante";
        $viewOwnRestaurant->ruleName = $managerRule->name;
        $auth->add($viewOwnRestaurant);
        $auth->addChild($viewOwnRestaurant,$viewRestaurant);

        $updateOwnRestaurant = $auth->createPermission("updateOwnRestaurant");
        $updateOwnRestaurant->description = "Atualizar restaurante";
        $updateOwnRestaurant->ruleName = $managerRule->name;
        $auth->add($updateOwnRestaurant);
        $auth->addChild($updateOwnRestaurant,$updateRestaurant);

        $deleteOwnRestaurantLogo = $auth->createPermission("deleteOwnRestaurantLogo");
        $deleteOwnRestaurantLogo->description = "Eliminar Logo do Restaurante";
        $deleteOwnRestaurantLogo->ruleName = $managerRule->name;
        $auth->add($deleteOwnRestaurantLogo);
        $auth->addChild($deleteOwnRestaurantLogo,$deleteRestaurantLogo);

        /*
            Own Ticket Permissions
         */

        $viewOwnTicket = $auth->createPermission("viewOwnTicket");
        $viewOwnTicket->description = "Visualizar bilhete";
        $viewOwnTicket->ruleName = $clientRule->name;
        $auth->add($viewOwnTicket);
        $auth->addChild($viewOwnTicket,$viewTicket);

        $updateOwnTicket = $auth->createPermission("updateOwnTicket");
        $updateOwnTicket->description = "Atualizar bilhete";
        $updateOwnTicket->ruleName = $clientRule->name;
        $auth->add($updateOwnTicket);
        $auth->addChild($updateOwnTicket,$updateTicket);

        /*
            Own Support Ticket Permissions
        */

        $viewOwnSupportTicket = $auth->createPermission("viewOwnSupportTicket");
        $viewOwnSupportTicket->description = "Visualizar Support Ticket";
        $viewOwnSupportTicket->ruleName = $clientRule->name;
        $auth->add($viewOwnSupportTicket);
        $auth->addChild($viewOwnSupportTicket,$viewSupportTicket);

        $updateOwnSupportTicket = $auth->createPermission("updateOwnSupportTicket");
        $updateOwnSupportTicket->description = "Atualizar Support Ticket";
        $updateOwnSupportTicket->ruleName = $clientRule->name;
        $auth->add($updateOwnSupportTicket);
        $auth->addChild($updateOwnSupportTicket,$updateSupportTicket);

        /*
            Own Profile Permissions
        */

        $viewOwnProfile = $auth->createPermission("viewOwnProfile");
        $viewOwnProfile->description = "Visualizar perfil";
        $viewOwnProfile->ruleName = $clientRule->name;
        $auth->add($viewOwnProfile);
        $auth->addChild($viewOwnProfile,$viewClient);

        $updateOwnProfile = $auth->createPermission("updateOwnProfile");
        $updateOwnProfile->description = "Atualizar perfil";
        $updateOwnProfile->ruleName = $clientRule->name;
        $auth->add($updateOwnProfile);
        $auth->addChild($updateOwnProfile,$updateClient);

        /*
         Roles Permissions
         */

        // Client Role Permissions
        $auth->addChild($client,$createTicket);
        $auth->addChild($client,$createSupportTicket);
        $auth->addChild($client,$createMessage);
        $auth->addChild($client,$viewOwnTicket);
        $auth->addChild($client,$updateOwnTicket);
        $auth->addChild($client,$viewOwnProfile);
        $auth->addChild($client,$updateOwnProfile);
        $auth->addChild($client,$updateOwnSupportTicket);
        $auth->addChild($client,$viewOwnSupportTicket);

        // Employee Role Permissions
        $auth->addChild($employee,$createFlight);
        $auth->addChild($employee,$updateFlight);
        $auth->addChild($employee,$viewFlight);
        $auth->addChild($employee,$createLostItem);
        $auth->addChild($employee,$updateLostItem);
        $auth->addChild($employee,$viewLostItem);
        $auth->addChild($employee,$createAirplane);
        $auth->addChild($employee,$updateAirplane);
        $auth->addChild($employee,$viewAirplane);
        $auth->addChild($employee,$createAirport);
        $auth->addChild($employee,$updateAirport);
        $auth->addChild($employee,$viewAirport);
        $auth->addChild($employee,$updatePaymentMethod);
        $auth->addChild($employee,$viewPaymentMethod);
        $auth->addChild($employee,$updateClient);
        $auth->addChild($employee,$viewClient);
        $auth->addChild($employee,$viewTicket);
        $auth->addChild($employee,$updateTicket);
        $auth->addChild($employee,$updateSupportTicket);
        $auth->addChild($employee,$viewSupportTicket);

        //Manager Permissions
        $auth->addChild($manager,$createOwnRestaurantItem);
        $auth->addChild($manager,$deleteOwnRestaurantItem);
        $auth->addChild($manager,$updateOwnRestaurantItem);
        $auth->addChild($manager,$viewOwnRestaurantItem);
        $auth->addChild($manager,$viewOwnRestaurant);
        $auth->addChild($manager,$updateOwnRestaurant);
        $auth->addChild($manager,$deleteOwnRestaurantLogo);

        // Admin Permissions
        $auth->addChild($admin,$manager);
        $auth->addChild($admin,$employee);
        $auth->addChild($admin,$createAdmin);
        $auth->addChild($admin,$updateAdmin);
        $auth->addChild($admin,$viewAdmin);
        $auth->addChild($admin,$deleteAdmin);
        $auth->addChild($admin,$deleteRestaurant);
        $auth->addChild($admin,$viewRestaurant);
        $auth->addChild($admin,$createRestaurant);
        $auth->addChild($admin,$updateRestaurant);
        $auth->addChild($admin,$deleteRestaurantLogo);
        $auth->addChild($admin,$createRestaurantItem);
        $auth->addChild($admin,$deleteRestaurantItem);
        $auth->addChild($admin,$viewRestaurantItem);
        $auth->addChild($admin,$updateRestaurantItem);
        $auth->addChild($admin,$deleteClient);
        $auth->addChild($admin,$createManager);
        $auth->addChild($admin,$viewManager);
        $auth->addChild($admin,$updateManager);
        $auth->addChild($admin,$deleteManager);
        $auth->addChild($admin,$createStore);
        $auth->addChild($admin,$viewStore);
        $auth->addChild($admin,$updateStore);
        $auth->addChild($admin,$deleteStore);
        $auth->addChild($admin,$deleteStoreLogo);
        $auth->addChild($admin,$createCompany);
        $auth->addChild($admin,$viewCompany);
        $auth->addChild($admin,$updateCompany);
        $auth->addChild($admin,$createEmployee);
        $auth->addChild($admin,$viewEmployee);
        $auth->addChild($admin,$updateEmployee);
        $auth->addChild($admin,$deleteEmployee);
        $auth->addChild($admin,$viewServerLog);


        /*
         Assign roles to users
         */

        $auth->assign($admin,1);
        $auth->assign($employee,2);
        $auth->assign($employee,3);
        $auth->assign($employee,7);
        $auth->assign($employee,8);
        $auth->assign($employee,9);
        $auth->assign($client,4);
        $auth->assign($client,5);
        $auth->assign($client,6);
        $auth->assign($client,10);
        $auth->assign($client,11);
        $auth->assign($client,12);
        $auth->assign($client,13);
        $auth->assign($client,14);
        $auth->assign($client,15);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221115_155756_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221115_155756_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
