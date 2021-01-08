<?php

namespace Illuminate\Support\Facades;

/**
 * @method static \Psr\Log\LoggerInterface channel(string $channel = null)
 * @method static \Psr\Log\LoggerInterface stack(array $channels, string $channel = null)
 * @method static void alert(string $messages, array $context = [])
 * @method static void critical(string $messages, array $context = [])
 * @method static void debug(string $messages, array $context = [])
 * @method static void emergency(string $messages, array $context = [])
 * @method static void error(string $messages, array $context = [])
 * @method static void info(string $messages, array $context = [])
 * @method static void log($level, string $messages, array $context = [])
 * @method static void notice(string $messages, array $context = [])
 * @method static void warning(string $messages, array $context = [])
 * @method static void write(string $level, string $messages, array $context = [])
 * @method static void listen(\Closure $callback)
 *
 * @see \Illuminate\Log\Logger
 */
class Log extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'log';
    }
}
