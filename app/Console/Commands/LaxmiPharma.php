<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quotation;
use App\Models\PurchaseOrder;
use App\Models\User;
use App\Models\Notification;
use DateTime;

class LaxmiPharma extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send an exclusive quote to everyone daily via email.';

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
              $data = Quotation::with('customer')->select('*')->get();
              $purchase = PurchaseOrder::with('vendor')->select('*')->get();
              $date = new DateTime();
              $data1 = $date->format('Y-m-d');
              $data12 = $date->format('d/m/Y');
                foreach($purchase as $demo){
                                $a = $demo->delivery_date;
                                $b = 'Today You have to Take a Review of This PurchseOrder Id '.$demo->po_no;
                                        if($a == $data1){
                                            $user = User::where('name','=',$demo->prepared_by)->get();
                                            $user[0]->notify(new \App\Notifications\purchaseorderuser($demo));
                                            $demo['vendor']->notify(new \App\Notifications\purchaseordervendor($demo));
                                            $recordId = Notification::updateOrCreate( 
                                            ['name' => 'Purchase',
                                            'number' => $demo->po_no,
                                            'message' => $b,
                                            'date' => $data1,
                                        ]);
                                        }
                                        else{
                                            // echo "Not Match";
                                        }
                                // echo "</br>";
                            }
                foreach($data as $demo){
                        $a = $demo->follow_up;
                        $b = 'Today You have to Take a FollowUp of This QuotationNo. Id '.$demo->quotation_no[0];
                                if($a == $data12){
                                   $user = User::where('id','=',$demo->prepared_by)->select('*')->get();
                                   $demo['customer']->notify(new \App\Notifications\quotationuser($demo,$user[0]));
                                   $user[0]->notify(new \App\Notifications\quotationvendor($demo));
                                    $recordId = Notification::updateOrCreate( 
                                    ['name' => 'Quotation',
                                    'number' => $demo->quotation_no[0],
                                    'message' => $b,
                                    'date' => $data1,
                                ]);
                                }
                                else{
                                    // echo "Not Match";
                                }
                            }
    }
}
