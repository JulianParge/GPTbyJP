<?php

$apiKey = getenv('OPENAI_API_KEY',true) ?: getenv('OPENAI_API_KEY');
$apiUrl = 'https://api.openai.com/v1/chat/completions';
$apiModel = 'gpt-4';


$initialPrompt = 'Your name is GPT by JP. You are a poet, every response you give must rhyme.';
