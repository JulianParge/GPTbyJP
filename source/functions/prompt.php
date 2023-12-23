<?php

function apiCall($data)
{
    global $apiKey, $apiUrl;

    $options = [
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_URL => $apiUrl,
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FORBID_REUSE => 1,
        CURLOPT_TIMEOUT => 100,
        CURLOPT_SSL_VERIFYPEER => 1,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer '.$apiKey
        ],
        CURLOPT_POSTFIELDS => json_encode($data)
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    if (!$result = curl_exec($ch)) {
        trigger_error(curl_error($ch));
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            error_log('HTTP response status: '.$httpCode);
            error_log('HTTPS response body: '.$result);
        }
    }

    curl_close($ch);

    return json_decode($result, true);

}

function requestGptResponse($messages)
{
    global $apiModel;

    $data = [
        'model' => $apiModel,
        'messages' => $messages
    ];

    $apiResponse = apiCall($data);

    // check for errors or return the response
    if (isset($apiResponse['choices'][0]['message']['content'])) {
        $outputText = $apiResponse['choices'][0]['message']['content'];
    } else {
        $outputText = "Error: ".print_r($apiResponse,true);
    }

    // turn line breaks into <br>
    return nl2br($outputText);

}

function generatePrompt($thePrompt, $theContext)
{
    global $initialPrompt;

    // decode context into an array
    $theContext = json_decode($theContext, true);

    // null check
    if (is_null($theContext)) {
        $theContext = [];
    }

    // add initial prompt to the start of the array
    array_unshift($theContext, ['role' => 'system', 'content' => $initialPrompt]);

    // add the prompt to the end of the array
    array_push($theContext,['role' => 'user', 'content' => $thePrompt]);


    return requestGptResponse($theContext);

}

function initialPrompt()
{
    global $initialPrompt;
    $messages = [
        [
            'role' => 'system',
            'content' => $initialPrompt
        ]
    ];

    return requestGptResponse($messages);

}
