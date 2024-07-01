<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\{Bot, User};
class BotController extends Controller
{
    public function ajaxlistBot(Request $request)
    {
        $result = Bot::where('is_deleted', 0)->orderByDesc('id')->get();

        return DataTables::of($result)
            ->addColumn('serial_number', function ($row) {
                static $serialNumber = 0;
                $serialNumber++;
                return $serialNumber;
            })
            ->editColumn('bot_name', function ($row) {
                return $row->bot_name;
            })
            ->editColumn('status', function ($row) {
                // ternary operator syntax with page refresh method
                // $button = $row->is_active == 1
                //     ? '<button type="button" class="btn btn-success btn-sm" onclick="statusFunction(' . $row->id . ')">ACTIVE</button>'
                //     : '<button type="button" class="btn btn-secondary btn-sm" onclick="statusFunction(' . $row->id . ')">INACTIVE</button>';
                // return $button;
                
                // normal syntax with ajax method(without page refresh)
                if ($row->is_active == 1) {
                    $string = '<button type="button" class="btn btn-success btn-sm" id= "status" name="status" value='.$row->is_active.' onclick="statusFunction1(' . $row->id . ', ' . $row->is_active . ')">ACTIVE</button>';
                } else {
                    $string = '<button type="button" class="btn btn-secondary btn-sm" id= "status" name="status" value='.$row->is_active.'  onclick="statusFunction1(' . $row->id . ', ' . $row->is_active . ')">INACTIVE</button>';
                }
                return "<p>" . $string . "</p>";
              
            })
            ->editColumn('action', function ($row) {
                // $editRoute = route('edit.title', ['id' => $row->id]);
                $string = '<button type="button" class="btn btn-primary btn-sm" onclick="EditViewFunction(' . $row->id . ', \'' . $row->bot_name . '\')">EDIT</button>&nbsp;';
                $string .= '<button type="button" class="btn btn-info btn-sm" onclick="duplicateFunction(' . $row->id . ')">DUPLICATE</button>&nbsp';
                $string .= '<button type="button" class="btn btn-danger btn-sm" onclick="deleteFunction(' . $row->id . ')">DELETE</button>';
               

                return '<p>' . $string . '</p>';
            })
            
            ->removeColumn("id")
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function botList(Request $request)
    {
        $botTitleList = Bot::where('is_active', 1)->get();
        return view('Products.bot_list', ['getbotList' => $botTitleList]);
    }

    public function createBot(Request $request)
    {
        $botName = $request->input('bot_name');
        $checkData = Bot::where('bot_name', $botName)->exists();
        // print_r($checkData);exit;

        if ($checkData) {
            return response()->json(['available' => 1], 200);
        } else {
            Bot::create([
                'uuid' => Uuid::uuid4(),
                'bot_name' => ucfirst($botName),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return response()->json(['available' => 0], 200);
        }
    }

    public function editBot(Request $request)
    {
        $id = $request->input('id');
        $botName = $request->input('bot_name');
        $checkData = Bot::where('bot_name', $botName)
                    ->where('id', '!=', $id)
                    ->exists();

        if ($checkData) {
            return response()->json(['available' => 1], 200);
        } else {
            $edit = Bot::where('id', $id)->first();
            $edit->uuid = Uuid::uuid4();
            $edit->bot_name = ucfirst($botName);
            $edit->created_at = Carbon::now();
            $edit->updated_at = Carbon::now();
            $edit->save();

            // Bot::create([
            //     'uuid' => Uuid::uuid4(),
            //     'bot_name' => ucfirst($botName),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ]);

            return response()->json(['available' => 0], 200);
        }
    }

    public function deleteBot(Request $request)
    {
        $row_id = $request->input('deleteId');
        $botDelete = Bot::find($row_id);

        if ($botDelete) {
            $botDelete->is_deleted = 1;
            $botDelete->updated_at = Carbon::now();
            $botDelete->save();

            return redirect()->route('bot_list')->with('success', 'Bot deleted successfully');
        } else {
            return redirect()->route('bot_list')->with('error', 'Bot not found');
        }
    }

    // with page refresh(without ajax)
    public function updateBotStatus(Request $request)
    {
        $row_id = $request->input('statusId');
        $BotUpdate = Bot::find($row_id);

        if ($BotUpdate) {
            $BotUpdate->is_active = $BotUpdate->is_active == 1 ? 0 : 1;
            $BotUpdate->updated_at = Carbon::now();
            $BotUpdate->save();

            return redirect()->route('bot_list')->with('success', 'Bot status updated successfully');
        } else {
            return redirect()->route('bot_list')->with('error', 'Bot not found');
        }
    }

    // without page refresh(with ajax)
    public function updateBotStatus1(Request $request)
    {
        // print_r($request->all());exit;
        if(isset($request->id)){
            if($request->status == 1){
                $status = 0;
            }else{
                $status = 1;
            }
            $model = Bot::where('id',$request->id)->first();
            $model->is_active = $status;
            $model->update();
        }
    }

    public function duplicateBot(Request $request){

        $botId = $request->input('bot_id');
        $botName = $request->input('bot_name');
    
        $getDuplicateData = Bot::where('id', $request->input('bot_id'))->first();
    
        if ($getUserData) {
            // Check if a bot with the same title already exists for the user
            $checkData = Bot::where('bot_title', $botName)->exists();
    
            if ($checkData) {
                return response()->json(['available' => 1], 200);
            } else {
                // Duplicate the bot
                $data = new Bot;
                $data->uuid = Uuid::uuid();
                $data->bot_title = ucfirst($botName);
                $data->is_active = 1; // Assuming 'is_active' is a boolean field
                $data->created_at = Carbon::now(); // Laravel helper function to get current datetime
                $data->updated_at = Carbon::now(); // Laravel helper function to get current datetime
                $data->save();
    
                }
            }
       }
}

