<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Template;
use App\Models\UserTemplate;
use App\Models\UserTemplateResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $drivers = Driver::search($request->search)->where('type', 'DRIVER')->paginate(10);
        } else {
            $drivers = Driver::select('id', 'name', 'email', 'email_verified_at', 'is_active', 'user_password')->where('type', 'DRIVER')->orderBy('id', 'desc')->paginate(10);
        }
        // $get_assign_templates = UserTemplate::join('users', 'users.id', '=', 'user_template.user_id')
        //       		->join('templates', 'templates.id', '=', 'user_template.template_id')
        //       		->get(['templates.name as template_name', 'templates.id as template_id','users.id as user_id']);
        return view('driver.list', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles = Vehicle::select('code', 'vehicle')->get();

        return view('driver.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Driver::class],
            'phone' => ['required', 'digits:10', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $details = mt_rand(1000000, 9999999);

        $data = [
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  Hash::make($request->password),
            'type'      =>  "DRIVER",
            'remember_token' => $details,
            'phone'     =>  $request->phone,
            'vehicle_1' =>  !empty($request->vehicle_1) ? $request->vehicle_1 : null,
            'vehicle_2' =>  !empty($request->vehicle_2) ? $request->vehicle_2 : null,
            'vehicle_3' =>  !empty($request->vehicle_3) ? $request->vehicle_3 : null,
            'is_active' =>  !empty($request->is_active) ? $request->is_active : 0,
            'user_password' => !empty($request->password) ? base64_encode($request->password) : 0
        ];
        $user = Driver::create($data);
        $mail_send = Mail::to($user->email)->send(new WelcomeEmail($data));
        if ($mail_send) {
            // $notification = array(
            //     'message' => 'Driver Created successfully',
            //     'alert-type' => 'success'
            // );

            // return redirect()->back()->with($notification);
            return redirect('/drivers');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $driver_list = Driver::find($id);
        $vehicles = Vehicle::select('code', 'vehicle')->get();
        return view('driver.view', compact('driver_list', 'vehicles'));
    }

    public function verify_driver(Request $request, $token)
    {
        if (isset($token)) {
            if (!empty($token)) {


                $drivers = Driver::select('id', 'name', 'email')->where('remember_token', $token)->get();


                if (isset($drivers)) {
                    Driver::where('remember_token', $token)->update([
                        'remember_token' => 'NULL',
                        'email_verified_at' => date("Y-m-d H:i:s")
                    ]);
                    echo "<div class='container' style='text-align: center;margin-top: 250px;'><h2>Email verified successfully!</h2>
                    <a href='http://103.164.67.227:8000/'>Login</a></div>";
                }
            } else {
                echo "Token expired";
            }
        } else {
            echo "Token expired";
        }
        die;
    }

    public function verifyEmail(Request $request)
    {

        $token =  $request->token;

        if (isset($token)) {
            if (!empty($token)) {


                $drivers = Driver::select('id', 'name', 'email')->where('remember_token', $token)->get();


                if (isset($drivers)) {
                    Driver::where('remember_token', $token)->update([
                        'remember_token' => 'NULL',
                        'email_verified_at' => date("Y-m-d H:i:s")
                    ]);
                    echo "<div class='container' style='text-align: center;margin-top: 250px;'><h2>Email verified successfully!</h2>
                    <a href='http://103.164.67.227:8000/'>Login</a></div>";
                }
            } else {
                echo "Token expired";
            }
        } else {
            echo "Token expired";
        }
        die;

        // get it from database 

        /// set it null email_verified_at

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $driver_list = Driver::find($id);
        $vehicles = Vehicle::select('code', 'vehicle')->get();
        return view('driver.edit', compact('driver_list', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_password = base64_encode($_POST['user_password']);
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required|numeric|digits:10',
            'vehicle_1' => 'required',
            'user_password' => ['required',  Rules\Password::defaults()],
        ]);
        $driver_update = Driver::find($id);
        $driver_update->name = $_POST['name'];
        $driver_update->email = $_POST['email'];
        $driver_update->phone = $_POST['phone'];
        $driver_update->vehicle_1 = $_POST['vehicle_1'];
        $driver_update->password = Hash::make($_POST['user_password']);
        $driver_update->is_active = $_POST['is_active'];
        $input = $request->all();
        $driver_update->update($input);
        Driver::where('id', $id)->update(array('user_password' => $user_password));
        return redirect('/drivers')->with('success', 'Driver record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_driver_records = Driver::find($id);
        $delete_driver_records->delete();
        return redirect('/drivers')->with('success', 'Driver record deleted successfully.');
    }
    public function driver_record()
    {
        $user = Driver::where('type', 'DRIVER')->get();
        $total_driver_count = $user->count();
        $user_not_verified = Driver::where('type', 'DRIVER')->where('email_verified_at', NULL)->get();
        $total_user_not_verified = $user_not_verified->count();
        $total_user_verified = Driver::whereNotNull('email_verified_at')->where('type', 'DRIVER')->get();
        $total_user_verified = $total_user_verified->count();
        $user_is_active = Driver::where('type', 'DRIVER')->where('is_active', 0)->get();
        $total_user_is_active = $user_is_active->count();
        $total_templates = Template::where('createdby', 'ADMIN')->get();
        $total_templates = $total_templates->count();
        return view('/dashboard', compact('total_driver_count', 'total_user_not_verified', 'total_user_verified', 'total_templates', 'total_user_is_active'));
    }
    public function assign_templates(Request $request, $user_id)
    {
        $get_assign_templates = UserTemplate::where('user_id', $user_id)->orderBy('iscompleted', 'DESC')->get();
        $user_template_listing = array();
        foreach ($get_assign_templates as $key => $template_listing) {
            $template_id = $template_listing['template_id'];
            $user_template_listing[$key]['template_id'] = $template_id;
            $user_template_listing[$key]['iscompleted'] = $template_listing['iscompleted'];
            $user_template_listing[$key]['user_id'] = $template_listing['user_id'];
            $user_template_listing[$key]['template_details'][] = Template::select('name', 'description')->where('id', $template_id)->get();
        }
        return view('driver.assigntemplates.list', compact('user_template_listing', 'user_id'));
    }
    public function completed_templates(Request $request, $user_id, $template_id, $form_number)
    {
        $usersubmitted_result = UserTemplateResponse::select("form_id", "section_name", "template_id", "title", "type", "field_value", "notes", "photos", "video", "document", "signature")->where('user_id', $user_id)->where('template_id', $template_id)->whereIn("form_id", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9])->where('form_number', $form_number)->orderBy('form_id', 'ASC')->get()->toArray();
        $forms_count = count($usersubmitted_result);
        return view('driver.assigntemplates.view', compact('usersubmitted_result' . 'forms_count' . 'user_id', 'template_id'));
    }
    public function welcome()
    {
        return redirect('/login');
    }
    public function isactive($id)
    {
        if ($_POST['is_active'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        Driver::where('id', $id)->update(array('is_active' => $status));
        return redirect('/drivers')->with('success', 'Driver record deleted successfully.');
    }
}
