<?php

namespace SilvaDan\Molezinha\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter;

class HttpExceptionFormatter extends BaseFormatter
{
  public function format(JsonResponse $response, Exception $e, array $reporterResponses)
  {

    if (count($headers = $e->getHeaders())) {
      $response->headers->add($headers);
    }

    $response->setStatusCode($e->getStatusCode());
    $response->setContent(json_encode(['error' => $e->getMessage()]));
  }
}