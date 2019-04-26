<?php 
  
$method = $_SERVER['REQUEST_METHOD'];
  
// Process only when method is POST
if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
  
    $text = $json->result->parameters->text;
	 $help = $json->result->parameters->HelpEntities;
	  $ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 'http://help.unhcr.org/turkey/wp-json/wp/v2/pages/'.$help); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$vars = json_decode($result, true);
 
            $speech = $result;
  

  
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
