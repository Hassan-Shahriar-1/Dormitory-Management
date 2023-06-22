<?php

namespace App\ViewComposers;

use App\Models\Dormitory;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\View\View;

class StudentDormitoryComposer
{
    public $roomList;
    /**
     * Create a Room Type composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roomList = Room::select('id', 'room_number')->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('roomList', $this->roomList);
    }
}
