<?php
/*
 * @description Utiliza el cliente del API de Nequi
 * @author Jorge Herrera, https://www.linkedin.com/in/jorge-herrera93/
 * @author Diego Gutierres, https://github.com/agldiego
 */
require_once 'awsSigner.php';

$host = "api.sandbox.nequi.com";  
$channel = 'PNP04-C001';
$transactionId = null;
$accionN = null;
$validN = null;

/**
 * Encapsula el consumo del servicio de la notificacion del API y retorna la respuesta del servicio
 */

if (isset($_POST["notificacion"])) {
  $clientId = '5245698';
  $phoneNumber = $_POST["celularn"];
  $value = $_POST["valorn"];

  $servicePath = "/payments/v1/-services-paymentservice-unregisteredpayment";
  $body = getBodyNotificacion($GLOBALS['channel'], $clientId, $phoneNumber, $value);
  $response = makeSignedRequest($GLOBALS['host'], $servicePath, 'POST', $body);
  $statusCode = json_decode($response)->ResponseMessage->ResponseHeader->Status->StatusCode;
  $statusDesc = json_decode($response)->ResponseMessage->ResponseHeader->Status->StatusDesc;
  $accionN = "validarn";
  if ($statusCode == "0" && $statusDesc == 'SUCCESS') {
    $validN = 'Notificacion Enviada Correctamente';
    $transactionId = json_decode($response)->ResponseMessage->ResponseBody->any->unregisteredPaymentRS->transactionId;
  }else{
    $validN = 'Hay problemas en el servidor o usuario no existe';
    $transactionId = null;
  }
}

/**
   * Forma el cuerpo para consumir el servicio del envio de la notificacion del API
   */
  function getBodyNotificacion($channel, $clientId, $phoneNumber, $value){
    $messageId =  substr(strval((new DateTime())->getTimestamp()), 0, 9);
    return array(
      "RequestMessage"  => array(
        "RequestHeader"  => array (
          "Channel" => $channel,
          "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
          "MessageID" => $messageId,
          "ClientID" => $clientId,
          "Destination" => array(
            "ServiceName" => "PaymentsService",
            "ServiceOperation" => "unregisteredPayment",
            "ServiceRegion" => "C001",
            "ServiceVersion"=> "1.0.0"
         )
        ),
        "RequestBody"  => array (
          "any" => array (
            "unregisteredPaymentRQ" => array (
              "phoneNumber" => $phoneNumber,
              "code" => "NIT_1",
              "value" => $value
              )
          )
        )
      )
    );
  }

?>