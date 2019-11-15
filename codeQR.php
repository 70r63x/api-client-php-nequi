<?php
/*
 * @description Utiliza el cliente del API de Nequi
 * @author Jorge Herrera, https://www.linkedin.com/in/jorge-herrera93/
 * @author Diego Gutierres, https://github.com/agldiego
 */
require_once 'awsSigner.php';

$host = "api.sandbox.nequi.com";
$channel = 'MF-001';
$validQR = null;
$codeQR = null;
$accion = null;

/**
 * Encapsula el consumo del servicio del QR del API y retorna la respuesta del servicio
 */

if (isset($_POST["qrGenerate"])) {
  $clientId = '5245698';
  $value = $_POST["valor"];

  $servicePath = "/payments/v1/-services-paymentservice-generatecodeqr";
  $body = getBodyQR($GLOBALS['channel'], $clientId, $value);
  $response = makeSignedRequest($GLOBALS['host'], $servicePath, 'POST', $body);
  $statusCode = json_decode($response)->ResponseMessage->ResponseHeader->Status->StatusCode;
  $statusDesc = json_decode($response)->ResponseMessage->ResponseHeader->Status->StatusDesc;
  $accion = "qr";
  if ($statusCode == "0" && $statusDesc == 'SUCCESS') {
    $validQR = 'CodeQR Generado Correctamente';
    $codeQR = json_decode($response)->ResponseMessage->ResponseBody->any->generateCodeQRRS->codeQR;
  }else{
    $validQR = 'Hay problemas en el servidor';
    $codeQR = null;
  }
}

/**
   * Forma el cuerpo para consumir el servicio del QR del API
   */
  function getBodyQR($channel, $clientId, $value){
    $messageId =  substr(strval((new DateTime())->getTimestamp()), 0, 9);
    return array(
    "RequestMessage" => array(
      "RequestHeader" => array(
        "Channel" => $channel,
        "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
        "MessageID" => $messageId,
        "ClientID" => $clientId,
        "Destination" => array(
          "ServiceName" => "PaymentsService",
          "ServiceOperation" => "generateCodeQR",
          "ServiceRegion" => "C001",
          "ServiceVersion" => "1.0.0"
        )
      ),
      "RequestBody" => array(
        "any" => array(
          "generateCodeQRRQ" => array(
            "code" => "NIT_1",
            "value" => $value
            )
          )
        )
      )
    );
  }

?>