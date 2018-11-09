<?php
use Dialogflow\WebhookClient;	
//$agent = new WebhookClient(json_decode(file_get_contents('php://input'),true));
$method = $_SERVER['REQUEST_METHOD'];
$servername = "db.dpoplus.ai";
$username = "root";
$password = "alskdjfhg";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

if($method == "POST") {
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	
	$text = $json-> result->metadata->intentName;
	//$intent = $agent->getIntent();
	
	switch($text) {
		case 'Procure':
			$speech = "PHP: We will buy it soon";
			//$agent->reply('Hi, how can I help?');
			break;
		case 'DefaultWelcomeIntent':
			$speech = "PHP: heyyyyyy";
			//$agent->reply('Agent webhook?');
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
