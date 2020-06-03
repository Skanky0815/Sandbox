<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.05.20
 * Time: 00:27
 *
 * PHP version 7.2
 */

namespace Wizmo\Pipeline;

use Wizmo\Request;

class Trim
{
    public function __invoke(Request $request): Request
    {
        foreach ($request->getAll() as $key => $value) {
            if (is_string($value)) {
                $request->set($key, trim($value));
            }
        }

        return $request;
    }
}
