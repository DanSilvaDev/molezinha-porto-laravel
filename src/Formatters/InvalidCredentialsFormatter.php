<?php


namespace Molezinha\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter;

class InvalidCredentialsFormatter extends BaseFormatter
{
  public function format(JsonResponse $response, Exception $e, array $reporterResponses)
  {
    $response->setStatusCode($e->getCode()? $e->getCode() : '401');
    // Laravel validation errors will return JSON string
    $decoded = json_decode($e->getMessage(), true);
    // Message was not valid JSON
    // This occurs when we throw UnprocessableEntityHttpExceptions
    if (json_last_error() !== JSON_ERROR_NONE) {
      // Mimick the structure of Laravel validation errors
      $decoded = $e->getMessage();
    }
    $response->setData([
      'error' => $decoded,
    ]);
    return $response;
  }
}