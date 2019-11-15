# api-client-php-nequi
Consumo API de prueba para integración de pago con Nequi

<p>Este desarrollo se realiza con el fin de guiar a los usuarios interesados en integrar el metodo de pago a sus proyectos web. Este ejemplo consume el recurso api sandbox (modo de prueba) de Nequi, y envia consultando y retornado estos valores para sus pruebas. Para más información visite el portal para desarrolladores de Nequi (<a href="https://docs.conecta.nequi.com.co/">Docs Nequi.)</a></p>

<p>En este desarrollo esta resulto la conexión para validar Existencia de Usuario, Generador de codigo QR y envio de Notificación Push. Importante no olvidar que en el archivo keys.php se deben ingresar las respectivas llaves para su función, sino tiene puede solicitarlas en el portal para desarrolladores Nequi (<a href="https://conecta.nequi.com.co">Nequi Conecta.)</a></p>

Para ver en funcionamiento el ejemplo descargue los fuentes, desplieguelos en cualquier servidor donde corra PHP, puede ser Apache, y acceda al index.php desde un navegador web.

<strong>Contenido:</strong>
<ul>
	<li>keys.php: Definición de las llaves como variables para el consumo del API.</li>
	<li>awsSigner.php: Permite consumir cualquier recurso del API firmando la petición con el mecanismo de seguridad AWS Sv4.</li>
	<li>index.php: Ejemplo con formularios de envio de datos al consumo de las funciones expuestas en el client del API de Nequi.</li>
	<li>codeQR.php: Define las funciones que representan los recursos expuestos en el API para generar el codigo QR.</li>
	<li>validUser.php: Define las funciones que representan los recursos expuestos en el API para validad existencia del usuario.</li>
	<li>notificacionPush.php: Define las funciones que representan los recursos expuestos en el API para enviar una notificacion al usuario.</li>
</ul>