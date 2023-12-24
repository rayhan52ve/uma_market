<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DailyWorksheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyworksheet:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $yesterdaysWorksheets = Worksheet::whereDate('created_at', $yesterday)->get();
        foreach ($yesterdaysWorksheets as $yesterdaysWorksheet) {
            $tergetextraachive = $yesterdaysWorksheet->target_achive > $yesterdaysWorksheet->daily_target ? $yesterdaysWorksheet->target_achive - $yesterdaysWorksheet->daily_target : 0;
            $tergetnonachive = $yesterdaysWorksheet->daily_target > $yesterdaysWorksheet->target_achive ? $yesterdaysWorksheet->daily_target - $yesterdaysWorksheet->target_achive : 0;
            $daybeforyesterday = Worksheet::where('employee_id', $yesterdaysWorksheet->employee_id)->latest()->offset(1)->first();
            $totalfinalachive = $yesterdaysWorksheet->target_achive + $daybeforyesterday->total_final_achive;

            $finalnonachive=$daybeforyesterday->final_non_achive;

            if ($tergetnonachive > $tergetextraachive) {
                $finalnonachive = $finalnonachive + $tergetnonachive;
            } else {
                $finalnonachive = max(0, $finalnonachive - $tergetextraachive);
            }
            $someofdailyterget = Worksheet::where('employee_id', $yesterdaysWorksheet->employee_id)->sum('daily_target');

            if ($totalfinalachive > $someofdailyterget) {

                $bonuspoint =  $totalfinalachive - $someofdailyterget;
            } else {
                $bonuspoint = 0;
            }

            // Update the Worksheet instance with the calculated values
            $yesterdaysWorksheet->target_extra_achive = $tergetextraachive;
            $yesterdaysWorksheet->target_non_achive = $tergetnonachive;
            $yesterdaysWorksheet->total_final_achive = $totalfinalachive;
            $yesterdaysWorksheet->final_non_achive = $finalnonachive;
            $yesterdaysWorksheet->bonus_point = $bonuspoint;
            $yesterdaysWorksheet->save();
        }

        $lastWorksheet = Worksheet::latest()->first();
        if (!$lastWorksheet || $lastWorksheet->created_at->format('Y-m-d') !== now()->format('Y-m-d')) {
            $employees = User::where('user_type', 3)->get();
            foreach ($employees as $employee) {
                Worksheet::create([
                    'employee_id' => $employee->id,
                ]);
            }
        }
    }
}
