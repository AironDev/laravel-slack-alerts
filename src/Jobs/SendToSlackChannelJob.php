<?php

namespace Airon\SlackAlerts\Jobs;

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

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     */
    public int $maxExceptions = 3;

    public function __construct(
        public array  $payload,
        public string $type,
        public string $webhookUrl
    ) {
    }

    public function handle(): void
    {
        $payload = $this->payload;

        Http::post($this->webhookUrl, $payload);
    }
}
