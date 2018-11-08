<?php
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST") {
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	
	$text = $json-> queryResult->intent->displayName;
	
	switch($text) {
		case 'Procure':
			$speech = "PHP: We will buy it soon";
			break;
		case 'Default Welcome Intent':
			$speech = "PHP: heyyyyyy";
			break;
		default:
			$speech = "PHP:Sorry, I didnt get that. Please ask me something else.";
			break;		
	}
	
	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";	
}

?>
