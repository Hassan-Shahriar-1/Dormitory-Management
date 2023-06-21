<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoomType extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'room_types';

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id', 'room_type_id');
    }

    public function getRoomTypeData($request)
    {
        $query = self::select([
            'id',
            'name',
            DB::raw('CASE WHEN status = 1 THEN "Active" ELSE "Deactive" END as status'),
            'description',
            'created_at'
        ]);

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
                        $query->orWhere($column, 'LIKE', $keyword);
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
            $order = 'name';
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
            $nestedData['description'] =  $item->type;
            $nestedData['status'] = $item->status;
            $nestedData['address'] = $item->address;
            $nestedData['created_at'] = $item->created_at;
            $nestedData['action'] = '<div class="btn-group dropup">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:editRoomType(\'' . $item->id . '\')">Edit</a></li>
                                            <li><a href="javascript:deleteRoomType(\'' . $item->id . '\')">Delete</a></li>
                                            <li><a href="javascript:viewRoomType(\'' . $item->id . '\')">View Details</a></li>
                                        </ul>
                                    </div>';


            $data[] = $nestedData;
        }
        return $data;
    }
}
