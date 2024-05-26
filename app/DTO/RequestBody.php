<?php

namespace App\DTO;

class RequestBody
{
    public function __construct(
        protected readonly array $get,
        protected readonly array $post,
        protected readonly array $put,
        protected readonly array $delete,
    )
    {
    }

}