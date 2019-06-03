<?php
namespace Molezinha\Supports\Bases;

use App\Http\Controllers\Controller;
use Molezinha\Traits\General\CallableTrait;

abstract class BaseController extends Controller
{
  use CallableTrait;
}