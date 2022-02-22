<?php

namespace Airon\SlackAlerts;

use Airon\SlackAlerts\Exceptions\JobClassDoesNotExist;
use Airon\SlackAlerts\Exceptions\WebhookDoesNotExist;
use Airon\SlackAlerts\Exceptions\WebhookUrlNotValid;
use Airon\SlackAlerts\Jobs\SendToSlackChannelJob;

class Config
{
    public static function getJob(array $arguments): SendToSlackChannelJob
    {
        $jobClass = config('slack-alerts.job');

        if (is_null($jobClass) || ! class_exists($jobClass)) {
            throw JobClassDoesNotExist::make($jobClass);
        }

        return app($jobClass, $arguments);
    }

    public static function getWebhookUrl(string $name): string
    {
        $url = config("slack-alerts.webhook_urls.{$name}");

        if (is_null($url)) {
            throw WebhookDoesNotExist::make($name);
        }

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw WebhookUrlNotValid::make($name, $url);
        }

        return $url;
    }
}
