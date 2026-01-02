<?php 
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendBirthdayEmailJob;

class DispatchBirthdayEmails extends Command
{
    protected $signature = 'birthday:send-emails'; //unique identifier of the artisan cmd
    protected $description = 'Dispatch birthday email job'; //what it does

    //useful when- php artisan list


    public function handle()
    {
        SendBirthdayEmailJob::dispatch(); // job call
        $this->info('Birthday email job dispatched '); // green-informational
        
/* $this->info('…') → Green, for informational messages
$this->warn('…') → Yellow, for warnings / attention
$this->error('…') → Red, for errors / failures
$this->line('…') → Plain/default text output
$this->comment('…') → Gray, for notes / comments
$this->ask('…') → Prompt user for input
$this->secret('…') → Prompt user for hidden input (password)
$this->confirm('…') → Ask yes/no question
$this->choice('…', [...]) → Let user choose from multiple options
$this->table($headers, $rows) → Display data in table format
$this->call('command:name') → Call another Artisan command from this command*/
    }
}
