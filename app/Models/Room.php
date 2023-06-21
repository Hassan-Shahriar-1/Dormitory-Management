<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Room extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'rooms';

    protected $fillable = [
        'room_number',
        'number_of_beds',
        'dormitory_id',
        'description',
        'room_type_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function getRoomTypeData($request)
    {
        $query = self::join('room_types', 'rooms.room_type_id', 'room_types.id')
            ->leftJoin('dormitories', 'rooms.dormitory_id', 'dormitories.id')
            ->select(DB::raw('
                rooms.id as id,
                rooms.room_number as room_number,
                rooms.number_of_beds as number_of_beds,
                rooms.description as description,
                rooms.created_at as created_at,
                room_types.name as room_type_name,
                dormitories.name as dormitory_name
            '));

        $limit = $request->input('length');
        $start = $request->input('start');
        $totalData = $query->count();

        //datatable search
        $columns = Schema::getColumnListing($this->getTable());
        if ($request->search && $request->search['value'] != "") {
            $keyword = $request->search['value'];
            $keyword = "%$keyword%";

            $query->where(function ($query) use ($columns, $keyword) {
                foreach ($columns as $column) {
                    if ($column != 'status' && $column != 'id') {
                        $query->orWhere('rooms.' . $column, 'LIKE', $keyword);
                    }
                    if ($column == 'room_type_name') {
                        $query->orwhere('room_types.name', 'LIKE', $keyword);
                    }
                    if ($column == 'dormitory_name') {
                        $query->orwhere('dormitories.name', 'LIKE', $keyword);
                    }
                }
            });
        }

        //filter data order by

        if ($request->input('order')) {
            foreach ($request->input('order') as $key => $orders) {

                $order = $request->input('columns.' . $orders['column'] . '.data');
                $dir = $orders['dir'];
            }
        } else {
            $order = 'rooms.name';
            $dir = 'asc';
        }
        $query->orderBy($order, $dir);
        $totalFiltered = $query->count();

        if ($limit == -1) {
            $items = $query->get();
        } else {
            $items = $query->offset($start)
                ->limit($limit)
                ->get();
        }
        return [
            'items' => $items,
            'totalData' => $totalData,
            'totalFiltered' => $totalFiltered,
        ];
    }

    public static function getDatatableData($items, $data = array())
    {
        foreach ($items as $key => $item) {
            $nestedData['name'] = $item->name;
            $nestedData['room_number'] = $item->room_number;
            $nestedData['description'] =  $item->description;
            $nestedData['status'] = $item->status;
            $nestedData['room_type_name'] = $item->room_type_name;
            $nestedData['dormitory_name'] = $item->dormitory_name;
            $nestedData['created_at'] = $item->created_at;
            $nestedData['action'] = '<div class="btn-group dropup">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:editRoom(\'' . $item->id . '\')">Edit</a></li>
                                            <li><a href="javascript:deleteRoom(\'' . $item->id . '\')">Delete</a></li>
                                            <li><a href="javascript:viewRoom(\'' . $item->id . '\')">View Details</a></li>
                                        </ul>
                                    </div>';


            $data[] = $nestedData;
        }
        return $data;
    }
}
