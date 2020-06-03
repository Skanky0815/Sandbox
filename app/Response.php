<?php

/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.05.20
 * Time: 00:24
 *
 * PHP version 7.2
 */

namespace Wizmo;

use http\Encoding\Stream\Inflate;

/**
 * Class Response
 *
 * @category  API
 * @package   Wizmo
 * @author    Rico Schulz <rico.schulz@wizmo.de>
 * @copyright 2005-2020 WIZMO GmbH
 * @license   Unauthorized copying of this file, via any medium is strictly
 *            prohibited Proprietary and confidential
 * @version   GIT: $
 * @link      https://api.raucon.com
 */
class Response
{
    public const HTTP_OK = 200;

    public const HTTP_BAD_REQUEST = 404;

    /**
     * @param array $content
     * @param int   $status
     *
     * @return void
     */
    public function send(array $content, int $status = self::HTTP_OK): void
    {
        http_response_code($status);
        echo json_encode($content);
    }
}
