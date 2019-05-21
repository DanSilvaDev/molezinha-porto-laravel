<?php

namespace App\Traits;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Log;

trait Crypts
{
  /**
   * @param $value
   * @return null
   */
  public function encrypt($value)
  {
    try{
      $crypt = encrypt($value);
      return $crypt;
    }catch (DecryptException $e)
    {
      Log::error($e->getMessage());
      return null;
    }

  }

  /**
   * @param $value
   * @return null|string
   */
  public function decrypt($value)
  {
    try
    {
      $result = decrypt($value);
      return $result;
    }catch (DecryptException $e)
    {
      Log::error($e->getMessage());
      return null;
    }
  }


}