<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;




class SendRemindMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_remind_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'リマインドメールを送ります';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        // $now = Carbon::now()->format('Y-m-d H:i:00');
        // $send_end = Carbon::now()->addMinutes(15)->format('Y-m-d H:i:00');
        // $users = User::whereBetween('send_at', [$now, $send_end])->get();
        $users = User::get();
        
        foreach($users as $user){
            Log::info(
            Mail::raw($user->name, function($message) use($user) {
                $message->to($user->email)
                    ->from('mail_from@example.com', 'メール送信元')
                    ->subject("We Reminder. You recall.");
            
            }));
        }
    }
}
