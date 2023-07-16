<?php

if (isset($_POST['prompt'])) {

    // sanitize prompt
    $thePrompt = filter_input(INPUT_POST, 'prompt', FILTER_SANITIZE_STRING);

    // sanitize context
    $theContext = filter_input(INPUT_POST, 'chat_history', FILTER_SANITIZE_STRING) ?? NULL;

    // generate the prompt
    $response = generatePrompt($thePrompt,$theContext);


    echo json_encode(array("response" => $response));

}