<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\User;
use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

use yii\web\ServerErrorHttpException;

class FlightticketController extends ActiveController
{
    public $modelClass = 'common\models\FlightTicket';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    /*
         Com QueryParamAuth
    */

    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
        ];
        return $behaviors;
    }

    public function actionDelete($id){
        $class = new $this->modelClass;
        $flightTicket = $class->find()->where(['flight_ticket_id'=>$id])->one();

        if ($flightTicket){

            $flightTicketTime = strtotime($flightTicket->flight->estimated_departure_date);
            $day = 60 * 60 * 24;
            $cancelTicketTime =  $flightTicketTime - ($day * 7);    // data sete dias antes do Voo

            $now = strtotime( date("d-m-Y H:i"));

            // Compara se a data  de possível cancelamento é superior à atual
            if($cancelTicketTime >= $now){
                if ($flightTicket->delete()){
                    $array['success'] = "success";
                    $array['message'] = "Ticket eliminado.";
                    return $array;
                }
                throw new ServerErrorHttpException("Ocorreu um erro ao cancelar.");
            }
            throw new ForbiddenHttpException("Impossível cancelar o bilhete sete dias antes do voo, por favor contacte o suporte.");
        }
        throw new NotFoundHttpException("Bilhete não encontrado.");
    }

    public function actionMytickets(){
        $token = Yii::$app->request->get("access-token");
        $user = User::find()->where(['auth_key'=>$token])->one();
        $i = 0;
        $array = array();
        if($user && $user->client) {
            foreach ($user->client->flightTickets as $flightTicket) {
                $array[$i]['id'] = $flightTicket->flight_ticket_id;
                $array[$i]['payment_method'] = $flightTicket->paymentMethod->name;
                $array[$i]['flightState'] = $flightTicket->flight->state;
                $array[$i]['flightOrigin'] = $flightTicket->flight->originAirport->city;
                $array[$i]['flightArrival'] = $flightTicket->flight->arrivalAirport->city;
                $array[$i]['flightOriginTime'] = date('H:i', strtotime($flightTicket->flight->estimated_departure_date));
                $array[$i]['flightArrivalTime'] = date('H:i', strtotime($flightTicket->flight->estimated_arrival_date));
                $array[$i]['terminal'] = $flightTicket->flight->terminal;
                $array[$i]['originalPrice'] = $flightTicket->flight->price;
                $array[$i]['paidPrice'] = $flightTicket->price;
                $array[$i]['flightDate'] = date('d-m-Y', strtotime($flightTicket->flight->estimated_departure_date));;
                $array[$i]['purchaseDate'] = $flightTicket->purchase_date;
                $array[$i]['distance'] = $flightTicket->flight->distance;
                $array[$i]['checkin'] = $flightTicket->checkin;
                $array[$i]['passengers'] = array();
                $j = 0;
                foreach ($flightTicket->passengers as $passenger){
                    $array[$i]['passengers'][$j]['id'] = $passenger->id;
                    $array[$i]['passengers'][$j]['name'] = $passenger->name;
                    $array[$i]['passengers'][$j]['gender'] = $passenger->gender;
                    $array[$i]['passengers'][$j]['seat'] = $passenger->seat;
                    $array[$i]['passengers'][$j]['extra_baggage'] = $passenger->extra_baggage;
                    $j++;
                }
                $i++;
            }
        }
        return $array;
    }

}