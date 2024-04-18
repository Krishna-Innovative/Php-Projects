<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Driver;
use App\Models\UserTemplate;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //echo '<pre>';print_r($_GET['search']);echo '</pre>';
        if ($request->filled('search')) {
            $templates = Template::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $templates = Template::select('id', 'name', 'description')->orderBy('id', 'desc')->paginate(10);
        }
        return view('template.list', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::select('name', 'description', 'createdby')->get();
        $drivers = Driver::select('id', 'name', 'email')->where('type', 'DRIVER')->get();
        return view('template.create', compact('templates', 'drivers'));
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
            'template_name' => ['required', 'string', 'max:255'],
            'template_description' => ['required', 'string', 'max:150'],
            'template_count' => ['required', 'numeric', 'in:2,3,4,5,6,7,8,9,10,11,12,13,14,15,16'],
            'drivers_list.*' => ['required'],
        ], [
            'template_name.required' => __('Template Name is required'),
            'template_description.required' =>  __('Template description is required'),
            'template_description.max' =>  __('Template description lenght should be in 150 character long'),
            'template_count.required' =>  __('Form count is required'),
            'template_count.in' => __('Form count range should be start from 2 to 16'),
            'drivers_list.*' => __('Driver field is Required'),
        ]);
        $data = [
            'name'      =>  $request['template_name'],
            'description'      =>  $request['template_description'],
            'form_count' => $request['template_count'],
            'createdby' => "ADMIN"
        ];

        $user = Template::create($data);
        $template_id = $user->id;
        $selected_driver = $_POST['drivers_list'];
        $driver_record_delete = UserTemplate::where('template_id', $template_id);
        $driver_record_delete->delete();
        if ($driver_record_delete) {
            foreach ($selected_driver as $drivers) {
                $usertemplates = new UserTemplate();
                $usertemplates->user_id = $drivers;
                $usertemplates->template_id = $template_id;
                $usertemplates->iscompleted = 0;
                $usertemplates->isactive = 0;
                $usertemplates->save();
            }
            return redirect('/templates');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $templates = Template::find($id);
        $drivers = Driver::select('id', 'name', 'email')->where('type', 'DRIVER')->get();
        $assign_template = UserTemplate::select('id', 'user_id', 'template_id')->where('template_id', $id)->get();
        $driver_listing = array();
        foreach ($assign_template as $driver_list) {
            $driver_user_id = $driver_list['user_id'];
            $driver_listing[] = Driver::select('id', 'name')->where('id', $driver_user_id)->get();
        }
        $drinfo = array();
        foreach ($driver_listing as $driver) {
            foreach ($driver as $drinfo1) {
                $drinfo[] = $drinfo1;
            }
        }
        $selecteddriver = array();
        foreach ($drinfo as $driver_listing) {
            $selecteddriver[] =  $driver_listing->id;
        }
        return view('template.view', compact('templates', 'drivers', 'selecteddriver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $templates = Template::find($id);
        $drivers = Driver::select('id', 'name', 'email')->where('type', 'DRIVER')->get();
        $assign_template = UserTemplate::select('id', 'user_id', 'template_id')->where('template_id', $id)->get();
        $driver_listing = array();
        foreach ($assign_template as $driver_list) {
            $driver_user_id = $driver_list['user_id'];
            $driver_listing[] = Driver::select('id', 'name')->where('id', $driver_user_id)->get();
        }
        $drinfo = array();
        foreach ($driver_listing as $driver) {
            foreach ($driver as $drinfo1) {
                $drinfo[] = $drinfo1;
            }
        }
        $selecteddriver = array();
        foreach ($drinfo as $driver_listing) {
            $selecteddriver[] =  $driver_listing->id;
        }
        return view('template.edit', compact('templates', 'drivers', 'selecteddriver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:150'],
            'form_count' => ['required'],
        ], [
            'name.required' => __('Template Name is required'),
            'description.required' =>  __('Template description is required'),
            'description.max' =>  __('Template description lenght should be in 150 character long')
        ]);
        $template_update = Template::find($id);
        $template_update->update($request->all());
        $driver_record_delete = UserTemplate::where('template_id', $id);
        $selected_driver = $_POST['drivers_list'];
        $driver_record_delete->delete();
        if ($driver_record_delete) {
            foreach ($selected_driver as $drivers) {
                $usertemplates = new UserTemplate();
                $usertemplates->user_id = $drivers;
                $usertemplates->template_id = $id;
                $usertemplates->iscompleted = 0;
                $usertemplates->isactive = 0;
                $usertemplates->save();
            }
        }
        return redirect('/templates')->with('success', 'Templates record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_template_records = Template::find($id);
        $delete_template_records->delete();
        return redirect('/templates')->with('success', 'Templates record deleted successfully.');
    }
    public function assigndriver($id, Template $template)
    {
        $selected_driver = $_POST['drivers_list'];
        $template__id = $_POST['template__id'];
        $driver_record_delete = UserTemplate::where('template_id', $template__id);
        $driver_record_delete->delete();
        if ($driver_record_delete) {
            foreach ($selected_driver as $drivers) {
                //$already_assigned_template = UserTemplate::where('user_id',$selected_driver[$i])->where('template_id',$template__id)->get();
                //if($already_assigned_template->isEmpty()){
                $usertemplates = new UserTemplate();
                $usertemplates->user_id = $drivers;
                $usertemplates->template_id = $template__id;
                $usertemplates->iscompleted = 1;
                $usertemplates->isactive = 1;
                $usertemplates->save();
            }
            return redirect('/templates');
        }
    }
}
