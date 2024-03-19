<?php

namespace App\Http\ViewComposers;

use App\Models\Month;
use App\Models\Year;
use Illuminate\View\View;

class BillCreateComposer{
    public function compose(View $view){
        $year=Year::get();
        $month=Month::get();
        $view->with(['year'=>$year,'month'=>$month]);
    }
}
