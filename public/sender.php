<?php

if(isset ($_POST['title'])) {$title=$_POST['title'];}
if(isset ($_POST['name'])) {$fio=$_POST['name'];}
if(isset ($_POST['phone'])) {$phone='+380'.$_POST['phone'];}
if(isset ($_POST['email'])) {$email=$_POST['email'];}


$arrContactParams = [
	// поля для сделки 
	"PRODUCT" => [
		"nameForm"	=> $title,
	],
	// поля для контакта 
	"CONTACT" => [
		"namePerson"	=> $fio,
		"phonePerson"	=> $phone,
		"emailPerson"	=> $email,
	]
];

// Создаем Контакт
function amoAddContact($access_token, $arrContactParams) {
  $contacts['request']['contacts']['add'] = array(
  [
	'name' => $arrContactParams["CONTACT"]["namePerson"],
	'tags' => 'promo',
	'custom_fields'	=> [
			// ТЕЛЕФОН
			[
				'id'	=> 229095,
				"values" => [
					[
						"value" => $arrContactParams["CONTACT"]["phonePerson"],
						"enum" => "MOB",
					]
				]
			],
			//Email
			[
				'id'	=> 229097,
				"values" => [
					[
						"value" => $arrContactParams["CONTACT"]["emailPerson"],
						"enum" => "PRIV",
					]
				]
			]
		]
	]
	);

	/* Формируем заголовки */
	$headers = [
		"Accept: application/json",
		'Authorization: Bearer ' . $access_token
	];
	
	$link='https://liftaspace.amocrm.ru/private/api/v2/json/contacts/set';

	$curl = curl_init(); //Сохраняем дескриптор сеанса cURL
	/** Устанавливаем необходимые опции для сеанса cURL  */
	curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
	curl_setopt($curl,CURLOPT_URL, $link);
	curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
	curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($contacts));
	curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl,CURLOPT_HEADER, false);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
	$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
	$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
	curl_close($curl);
	$Response=json_decode($out,true);
	$account=$Response['response']['account'];
	echo '<b>Данные о пользователе:</b>'; echo '<pre>'; print_r($Response); echo '</pre>';

	return $Response["response"]["contacts"]["add"]["0"]["id"];
}

// Создаем Сделку
function amoAddTask($access_token, $arrContactParams, $contactId = false) {
	$arrTaskParams = [  
	'add' => [
		0 => [
			'name'  => $arrContactParams["PRODUCT"]["nameForm"],
			'tags'  => [
				'promo'
			],
				'status_id' => '36689845',
				'contacts_id' => [
					0 => $contactId,
				],
			],
		],
	];

	$link = "https://liftaspace.amocrm.ru/api/v2/leads";

	$headers = [
        "Accept: application/json",
        'Authorization: Bearer ' . $access_token
	];

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-
	undefined/2.0");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arrTaskParams));
	curl_setopt($curl, CURLOPT_URL, $link);
	curl_setopt($curl, CURLOPT_HEADER,false);
	curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
	curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
	$out = curl_exec($curl);
	curl_close($curl);
	$result = json_decode($out,TRUE);
}

/* в эту функцию мы передаём текущий refresh_token */
function returnNewToken($token) {
	$link = 'https://liftaspace.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

	/** Соберем данные для запроса */
	$data = [
		'client_id' => '2b142b6a-b418-49f1-840e-1c6df804d9c5',
		'client_secret' => 'Z5rfcYUILsvfHWBsFnOgsYjOGkERER2ZyspWdcXQpMkoIWdxO7aCDfuyObRgSGpJ',
		'grant_type' => 'refresh_token',
		'refresh_token' => $token,
		'redirect_uri' => 'https://promo.lifta.space/',
	];

	/**
	 * Нам необходимо инициировать запрос к серверу.
	 * Воспользуемся библиотекой cURL (поставляется в составе PHP).
	 * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
	 */
	$curl = curl_init(); //Сохраняем дескриптор сеанса cURL
	/** Устанавливаем необходимые опции для сеанса cURL  */
	curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
	curl_setopt($curl,CURLOPT_URL, $link);
	curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
	curl_setopt($curl,CURLOPT_HEADER, false);
	curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
	$out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
	$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	/** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
	$code = (int)$code;
	$errors = [
		400 => 'Bad request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not found',
		500 => 'Internal server error',
		502 => 'Bad gateway',
		503 => 'Service unavailable',
	];

	try
	{
		/** Если код ответа не успешный - возвращаем сообщение об ошибке  */
		if ($code < 200 || $code > 204) {
			throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
		}
	}
	catch(\Exception $e)
	{
		die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
	}

	/**
	 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
	 * нам придётся перевести ответ в формат, понятный PHP
	 */

	$response = json_decode($out, true);

	if($response) {

		/* записываем конечное время жизни токена */
		$response["endTokenTime"] = time() + $response["expires_in"];

		$responseJSON = json_encode($response);

		/* передаём значения наших токенов в файл */
		$filename = "token_file_amoInt.json";
		$f = fopen($filename,'w');
		fwrite($f, $responseJSON);
		fclose($f);

		$response = json_decode($responseJSON, true);

		return $response;
	}
	else {
		return false;
	}
}

/* получаем значения токенов из файла */
$dataToken = file_get_contents("token_file_amoInt.json");
$dataToken = json_decode($dataToken, true);

/* проверяем, истёкло ли время действия токена Access */
if($dataToken["endTokenTime"] < time()) {
	/* запрашиваем новый токен */
	$dataToken = returnNewToken($dataToken["refresh_token"]);
	$newAccess_token = $dataToken["access_token"];
}
else {
	$newAccess_token = $dataToken["access_token"];
}

if($arrContactParams["CONTACT"]) {
	$idContact = amoAddContact($newAccess_token, $arrContactParams);
}

amoAddTask($newAccess_token, $arrContactParams, $idContact);

