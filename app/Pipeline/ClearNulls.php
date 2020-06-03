<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.05.20
 * Time: 00:34
 *
 * PHP version 7.2
 */

namespace Wizmo\Pipeline;

use Wizmo\Request;

class ClearNulls
{
    public function __invoke(Request $request): Request
    {
        foreach ($request->getAll() as $key => $value) {
            if (null === $value) {
                $request->remove($key);
            }
        }

        return $request;
    }
}
