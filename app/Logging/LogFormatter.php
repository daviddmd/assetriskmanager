<?php

namespace App\Logging;

use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;

class LogFormatter
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Customize the given logger instance.
     *
     * @param Logger $logger
     * @return void
     */
    public function __invoke(Logger $logger)
    {
        $user = $this->request->user();
        $userEmail = empty($user) ? "" : $user->email;
        $ip = $this->request->ip();
        foreach ($logger->getHandlers() as $handler) {
            $handler->pushProcessor(function ($record) use ($userEmail, $ip) {
                $record['extra']['email'] = $userEmail;
                $record['extra']['ip'] = $ip;
                return $record;
            });
            $handler->setFormatter(new LineFormatter(
                "%datetime%;%extra.email%;%extra.ip%;%message%\r\n"
                , "Y-m-d H:i:s", true, true, false));
        }
    }
}
