<?php

namespace Molezinha\Generator\Exceptions;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class GeneratorErrorException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GeneratorErrorException extends MolezinhaException
{

    public $httpStatusCode = SymfonyResponse::HTTP_BAD_REQUEST;

    public $message = 'Generator Error.';

}
