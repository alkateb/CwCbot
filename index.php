<?php 
  
$method = $_SERVER['REQUEST_METHOD'];
  
// Process only when method is POST
if($method == 'POST'){
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
  
    $text = $json->result->parameters->text;
	 $help = $json->result->parameters->HelpEntities;
/*	
	$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 'http://88.247.29.227/test.php?link=https://admin-turkey.servicesadvisor.org/en/api/v1.0/service_location?fields=serviceName%26filter[id]=319'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$vars = json_decode($result, true);
 
            $speech = $help.' this is help entity';
  */
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, 'http://help.unhcr.org/turkey/wp-json/wp/v2/pages/'.$help); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
 
$vars = json_decode($result, true);
$vars1 = json_decode($result);
$varsDate = json_decode($result, true);
 
//echo $vars1->content->rendered;
$eResult= $vars1->content->rendered;
$speech=$eResult;
  
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
