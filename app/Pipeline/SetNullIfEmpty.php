<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.05.20
 * Time: 00:32
 *
 * PHP version 7.2
 */

namespace Wizmo\Pipeline;

use Wizmo\Request;

class SetNullIfEmpty
{
    public function __invoke(Request $request): Request
    {
        foreach ($request->getAll() as $key => $value) {
            if (is_string($value) && 0 === strlen($value)) {
                $request->set($key, null);
            }
        }

        return $request;
    }
}
