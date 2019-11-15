<?php
/*
 * @description Utiliza el cliente del API de Nequi
 * @author Jorge Herrera, https://www.linkedin.com/in/jorge-herrera93/
 * @author Diego Gutierres, https://github.com/agldiego
 */
require_once 'awsSigner.php';

$host = "a7zgalw2j0.execute-api.us-east-1.amazonaws.com";  
$channel = 'MF-001';
$valid = null;
$nombreUser = null;
$accionV = null;

/**
 * Encapsula el consumo del servicio de validacion de cliente del API y retorna la respuesta del servicio
 */

if (isset($_POST["validar"])) {
  $clientId = '5245698';
  $phoneNumber = $_POST["celular"];
  $value = 1;

  $servicePath = "/qa/-services-clientservice-validateclient";
  $body = getBodyValidateClient($GLOBALS['channel'], $clientId, $phoneNumber, $value);
  $response = makeSignedRequest($GLOBALS['host'], $servicePath, 'POST', $body);
  $statusCode = json_decode($response)->ResponseMessage->ResponseHeader->Status->StatusCode;
  $statusDesc = json_decode($response)->ResponseMessage->ResponseHeader->Status->StatusDesc;
  $accionV = "validar";
  if ($statusCode == "0" && $statusDesc == 'SUCCESS') {
    $valid = 'Si Existe';
    $nombreUser = json_decode($response)->ResponseMessage->ResponseBody->any->validateClientRS->customerName;
  }else{
    $valid = 'No existe usuario o hay problemas en el servidor';
    $nombreUser = null;
  }
}

/**
   * Forma el cuerpo para consumir el servicio de validación de cliente del API
   */
  function getBodyValidateClient($channel, $clientId, $phoneNumber, $value){
    $messageId =  substr(strval((new DateTime())->getTimestamp()), 0, 9);
    return array(
      "RequestMessage"  => array(
        "RequestHeader"  => array (
          "Channel" => $channel,
          "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
          "MessageID" => $messageId,
          "ClientID" => $clientId,
          "Destination" => array(
            "ServiceName" => "RechargeService",
            "ServiceOperation" => "validateClient",
            "ServiceRegion" => "C001",
            "ServiceVersion"=> "1.4.0"
         )
        ),
        "RequestBody"  => array (
          "any" => array (
            "validateClientRQ" => array (
              "phoneNumber" => $phoneNumber,
              "value" => $value
              )
          )
        )
      )
    );
  }

?>