<?php

namespace App\Jobs;

use App\Contracts\Parser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $link;
    protected int $source_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $link, int $source_id)
    {
        $this->link = $link;
        $this->source_id = $source_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Parser $service)
    {
        $service->setLink($this->link, $this->source_id)->parse();
    }
}
