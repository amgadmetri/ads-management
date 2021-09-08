<?php

namespace App\Console\Commands;

use App\Services\AdvertisementService;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class AdsReminder extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'ads:reminder';
    
    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'This command sends a reminder email to users one day before the ads at 8:00 PM';
    
    /**
    * Create a new command instance.
    *
    * @return void
    */
    private $advertisementService;
    public function __construct(AdvertisementService $advertisementService)
    {
        parent::__construct();
        $this->advertisementService = $advertisementService;
    }
    
    /**
    * Execute the console command.
    *
    * @return int
    */
    public function handle()
    {
        $tomorrow_ads = $this->advertisementService->get_tomorrow_ads();
        foreach ($tomorrow_ads as $advertisement) {
            
            try {
                Mail::send([], [], function (Message $message) use ($advertisement) {
                    $message->to($advertisement->advertiser->email)
                    ->from('amgad.mouneer@gmail.com')
                    ->subject("Your advertisement about ". $advertisement->title)
                    ->setBody($advertisement->description);
                });
                // $this->info("mail sent please check your email");
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }
}
