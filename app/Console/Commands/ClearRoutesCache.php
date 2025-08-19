<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearRoutesCache extends Command
{
    protected $signature   = 'limpieza';
    protected $description = 'Clear all route caches, optimize, and clear sessions';

    public function handle()
    {
        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('view:clear');
        $this->call('cache:clear');
        $this->call('route:cache');
        $this->call('config:cache');
    }
}
