<?php

namespace App\ViewComposers;

use App\Models\Dormitory;
use App\Models\RoomType;
use Illuminate\View\View;

class RoomComposer
{
    public $room;
    /**
     * Create a Room Type composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->room['types'] = RoomType::select('id', 'name')->get();
        $this->room['dormitories'] = Dormitory::select('id', 'name')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('modalData', $this->room);
    }
}
