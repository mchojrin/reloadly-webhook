<?php

http_response_code(400);

logMessage("Got a callback from Reloadly".PHP_EOL);

if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD'])) {
    die('Only POST requests are acceptable');
}

$postBody = file_get_contents('php://input');

logMessage("Post body = '$postBody'".PHP_EOL);

try {
    $event = json_decode($postBody, true, 512, JSON_THROW_ON_ERROR);
    $eventType = $event['type'];
    logMessage("Event type = '$eventType'".PHP_EOL);

    switch ($eventType) {
        case 'airtime_transaction.status':
            http_response_code(200);

            $status = $event['data']['transaction']['status'];
            logMessage("Status = '$status'".PHP_EOL);
            doImportantStuff();

            break;
        default:
            logMessage('Unsupported eventType '.$eventType);
    }

    echo json_encode(['received' => true]);
} catch (\Exception $exception) {
    logMessage('POST body wasn\'t json');
}

function logMessage(string $message): void
{
    error_log(date('[Y-m-d H:i:s] - '.$message));
}

function doImportantStuff()
{
    // Fill in the blanks
}