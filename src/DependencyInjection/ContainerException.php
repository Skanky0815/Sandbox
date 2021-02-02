<?php declare(strict_types=1);


namespace App\DependencyInjection;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class ContainerException extends Exception implements ContainerExceptionInterface
{

}