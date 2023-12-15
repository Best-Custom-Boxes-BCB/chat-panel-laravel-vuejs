<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TestController extends Controller
{
    public function index(Request $request){
        try {

            if(Test::create($request->all())){

                return response()->json(
                    [
                        'status'    => '200',
                        'message'    => 'Data saved successfully!',
                        'data'    => $request->all()
                    ]
                );

            }else{
                return response()->json(
                    [
                        'status'=>  '417',
                        'message'=>'Failed to save data in the database. Check your payload passing data is incorrect.'
                    ]
                );
            }

        } catch (\Throwable $th) {

            return response()->json(
                [
                    'error' =>  $th
                ]
            );
        }


        // return "Data saved successfully";
        // return 'Machine is ready';
    }

    public function update(Request $request){

        try{


            $data = Test::where('id',$request->id)->first();

            // return $data;
            if($data){

                $data->name = $request->name;
                $data->age = $request->age;
                $data->role = $request->role;
                $data->update();
                return response()->json(
                    [
                        'status'    =>  '200',
                        'message'   =>  'Data updated successfully!',
                        'data'      =>  $data
                    ]
                );
            }else{
                return response()->json(
                    [
                        'status'    =>  '417',
                        'message'   =>  'Data does not updated successfully!',
                        'data'      =>  $request->all()
                    ]
                );
            }
        }catch(Throwable $th){
            return response()->json(
                [
                    'status' => 'error',
                    'message'   => $th
                ]
            );
        }
    }
    public function delete($id){

        $data = Test::find($id)->delete();

        if($data){
            return response()->json(
                [
                    'status'    =>  '200',
                    'message'   =>  'Data has been deleted successfully!',
                    'data'      =>  $data
                ]
            );
        }else{
            return response()->json(
                [
                    'status'    => 'Something went wrong',
                    'message'   =>  'Data has not been deleted!'
                ]
            );
        }

    }
    public function deleteAll(Request $request){

        $ids = $request->ids;
        $data = Test::where('id',$ids)->first();
        return $data;

        // if(!$data){
        //     return response()->json(
        //         [
        //             'status'    =>  '200',
        //             'message'   =>  'Data has been deleted successfully!',
        //             'data'      =>  $data
        //         ]
        //     );
        // }else{
        //     return response()->json(
        //         [
        //             'status'    => 'Something went wrong',
        //             'message'   =>  'Data has not been deleted!',
        //             'data'      =>  $data
        //         ]
        //     );
        // }

    }

    public function search($string){

            $data = Test::where('name','like',"%".$string."%")->get();
            if($data){
                return $data;
            }else{
                return "No data found";
            }
    }

    public function testData(Request $request){
        $rules = array(
            'name'  =>  'required',
            'Farid'  =>  'email'
        );
        $validate = Validator::make($request->all(),$rules);
        if($validate->fails()){
            return $validate->errors()->all()[0];
        }else{
            $data = Test::create($request->all());
            return [
                'status'    =>  '200',
                'message'   => 'Api is responding fine!'
            ];
        }
    }
}
