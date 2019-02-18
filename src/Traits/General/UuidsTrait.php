<?php

namespace SilvaDan\Molezinha\Traits\General;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Ramsey\Uuid\Uuid;

trait UuidsTrait
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  /* Boot function from laravel.
   */
  public static function bootUuidsTrait()
  {

    static::creating(function ($model) {
      if(empty($model->uuid))
      {
        $model->uuid = Uuid::uuid4()->toString();
      }
    });
  }

}