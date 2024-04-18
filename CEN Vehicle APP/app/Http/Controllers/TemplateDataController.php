<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Templatedata;
use function Ramsey\Uuid\v1;
use Illuminate\Support\Facades\DB;


class TemplateDataController extends Controller
{
    public function create(Request $request, $id)
    {
        $template_id = $id;
        $number_of_form = Template::select('name', 'form_count')->where('id', $template_id)->get();
        $forms_count = $number_of_form[0]['form_count'];
        return view('template.forms.create', compact('forms_count', 'id'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'name_.*' => ['required'],
        ], [
            'name_*.required' => __('Label name is required')
        ]);
        if ($_POST['name_'] != "") {
            for ($i = 0; $i < count($_POST['name_']); $i++) {
                $template_id = $_POST['template_id_'][$i];
                $title = $_POST['name_'][$i];
                $type = $_POST['type_'][$i];
                $form_id_ = $_POST['form_id_'][$i];
                $section_ = $_POST['section_'][$i];
                $field_type_response_ = $_POST['field_type_response'][$i];
                $str_response = preg_replace('#\s+#', ',', trim($field_type_response_));
                $section_name = $_POST['section_name'][$i] ? $_POST['section_name'][$i] : '~';
                $required = $_POST['required_'][$i];
                $data = [
                    'template_id' => $template_id,
                    'form_id' => $form_id_,
                    'section' => $section_,
                    'section_name' => $section_name,
                    'title' => $title,
                    'type' => $type,
                    'field_type_response' => $str_response,
                    'isrequired' => $required,
                    'notes' => '',
                    'photos' => '',
                    'video' => '',
                    'document' => '',
                    "list" => '',
                    'isactive' => ''
                ];
                $user = Templatedata::create($data);
            }
            return redirect('/templates');
        } else {
            return back()->with('error', 'The error message here!');
        }
    }
    public function edit($id, $form_id)
    {
        $template_id = $id;
        $get_template_info = Templatedata::where('template_id', $id)->where('form_id', $form_id)->get()->toArray();
        return view('template.forms.edit', compact('template_id', 'get_template_info', 'form_id'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_.*' => ['required'],
        ], [
            'name_*.required' => __('Label name is required')
        ]);
        $template_id = $id;
        $form_id = $_POST['number_of_form'];
        if (!isset($_POST['name_'])) {
            return back()->with('error', 'You can not delete all fields');
        }
        $form_deleted = Templatedata::where('template_id', $id)->where('form_id', $form_id);
        $form_deleted->delete();
        if (isset($_POST['name_'])) {
            for ($i = 0; $i < count($_POST['name_']); $i++) {
                $template_id = $_POST['template_id_'][$i];
                $title = $_POST['name_'][$i];
                $type = $_POST['type_'][$i];
                $form_id_ = $_POST['form_id_'][$i];
                $section_ = $_POST['section_'][$i];
                $section_name = $_POST['section_name'][$i] ? $_POST['section_name'][$i] : '';
                $field_type_response_ = $_POST['field_type_response'][$i];
                $str_response = preg_replace('#\s+#', ',', trim($field_type_response_));
                $required = $_POST['required_'][$i];
                $data = [
                    'template_id' => $template_id,
                    'form_id' => $form_id_,
                    'section' => $section_,
                    'section_name' => $section_name,
                    'title' => $title,
                    'type' => $type,
                    'field_type_response' => $str_response,
                    'isrequired' => $required,
                    'notes' => '',
                    'photos' => '',
                    'video' => '',
                    'document' => '',
                    "list" => '',
                    'isactive' => ''
                ];
                $user = Templatedata::create($data);
            }
            return redirect('/templates');
        } else {
            return back()->with('error', 'You can not delete this form');
        }
        return redirect('/templates');
    }
    public function show(Request $request, $id)
    {
        $get_templatedata_info = Templatedata::where('template_id', $id)->get();
        if ($get_templatedata_info->isEmpty()) {
            $show_new_form = 0;
        } else {
            $show_new_form = 1;
        }
        //return view('template.forms.list',compact('forms_count','id','show_new_form'));
        $number_of_form = Template::where('id', $id)->get();
        $get_templatedata_info_ = DB::table("template_data")
            ->select("form_id", "template_id")
            ->where("template_id", "=", $id)
            ->whereIn("form_id", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15])
            ->orderBy("template_data.form_id", "asc")
            ->get()->toArray();
        $new_array = json_decode(json_encode($get_templatedata_info_), true);
        $input = array_map("unserialize", array_unique(array_map("serialize", $new_array)));
        $get_data = array_values($input);
        $forms_count = count($get_data);
        return view('template.forms.list', compact('forms_count', 'id', 'get_data', 'show_new_form'));
    }
    public function destroy(Request $request, $id)
    {
        $template_id = $_POST['delete_form'];
        $delete_template_records = Templatedata::where('template_id', $template_id)->where('form_id', $id);
        $delete_template_records->delete();
        $template_update = Template::find($template_id);
        $updatedform_count = $template_update['form_count'] - 1;
        Template::where('id', $template_id)->update(array('form_count' => $updatedform_count));
        return redirect('/templates');
    }
}
