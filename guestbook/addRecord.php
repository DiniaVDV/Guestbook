<?php
require_once('config.php');

$errors = [
	'status' => 'ok',
	'messages' => [
		'username' => '',
		'message' => ''
	]
];

$messageSchema= [
	'created_at' => '',
	'message' => '',
	'username' => '',
];

$messageStorage =[];

if(!empty($_POST)){
	
	$username = (!empty($_POST['username']) ) ? trim($_POST['username']) : null;
	
	$message = (!empty ($_POST['message'])) ? trim($_POST['message']) : null;
	
	if(!$username){
		$errors['messages']['username'] = 'Username пуст!';
	}
	
	if(!$message){
		$errors['messages']['message'] = 'Поле пустое';
	}
	
	if(($username) && ($message)){
		$messageSchema = [
			'username' => $username,
			'message' => $message,
			'created_at' => date('Y-m-d H:i:s'),
			];
			
		// Message is checked
		
		/*$message = str_replace( $config['symbols'] , '', $message);
		$message = strtolower($message);
		$wordsMessage = mb_split(" ", $message);
	
		foreach($wordsMessage as $key => $testingWord){
			foreach($config['stoplist'] as $checkWord){
				if($testingWord == $checkWord){
					$wordsMessage[$key] = $config['stopWordReplcement'];
					break;
				}
			}
		}	
		$messageSchema['message'] = implode($wordsMessage);*/

		
		if(file_exists($config['database'])){
				$errors['status'] = 'OK';
				$database = file_get_contents($config['database']);
				
				if(empty($database)){
					array_push($messageStorage, $messageSchema);
					$serializedStorage = serialize($messageStorage);
					
					if(file_put_contents($config['database'] , $serializedStorage)){
						require_once('index.php');
						$deserializedStorage = unserialize($serializedStorage);
						foreach($deserializedStorage as $oneUser){
							$deserializedStorage = unserialize($serializedStorage);
							require_once($config['templatesDirectory'] . 'message.html');
						}
					}
				} else { //4to my delaem esli v faylle 4tot est
					$deserializedStorage = unserialize($database);

					if(!empty($deserializedStorage)){
						array_push($deserializedStorage, $messageSchema);
						$serializedStorage = serialize($deserializedStorage);
						if(file_put_contents($config['database'], $serializedStorage)){
							//var_dump($serializedStorage);
							require_once('index.php');
							$deserializedStorage = unserialize($serializedStorage);
							foreach($deserializedStorage as $oneUser){
										//var_dump($elementU);
										require($config['templatesDirectory'] . 'message.html');

							}
							
							//die('File saved...');
						}
					}
				}
			}
	}
	
	
}


?>