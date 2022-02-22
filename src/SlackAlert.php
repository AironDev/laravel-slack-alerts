<?php

namespace Airon\SlackAlerts;

class SlackAlert
{
    protected string $webhookUrlName = 'default';

    public function to(string $webhookUrlName): self
    {
        $this->webhookUrlName = $webhookUrlName;

        return $this;
    }

    public function message(array $payload): void
    {
        $webhookUrl = Config::getWebhookUrl($this->webhookUrlName);


        $jobArguments = [
            'text' => $payload,
            'type' => 'mrkdown',
            'webhookUrl' => $webhookUrl,
        ];

        $job = Config::getJob($jobArguments);

        dispatch($job);
    }
}
