<?php

namespace Molezinha\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Optimus\Heimdal\Formatters\BaseFormatter;

class QueryExceptionFormatter extends BaseFormatter
{
  public function format(JsonResponse $response, Exception $e, array $reporterResponses)
  {

    Log::critical($e->errorInfo);
    Log::critical($e->getCode() .' - ' . $e->getMessage());
    $response->setStatusCode(500);
    $response->setContent(json_encode(['error'=> 'Ocorreu erro um interno - Por favor, contatar o Administrador do Sistema']));
  }
}