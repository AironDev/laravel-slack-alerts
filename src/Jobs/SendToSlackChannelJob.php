<?php

namespace Spatie\SlackAlerts\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendToSlackChannelJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


    public string $type;
    public string $webhookUrl;
    public array $payload;


    /**
     * The maximum number of unhandled exceptions to allow before failing.
     */
    public int $maxExceptions = 3;

    public function __construct($type, $webhookUrl, $payload) {
        $this->type = $type;
        $this->webhookUrl = $webhookUrl;
        $this->payload = $payload;
    }

    public function handle(): void
    {

        Http::post($this->webhookUrl, $this->payload);
    }
}
