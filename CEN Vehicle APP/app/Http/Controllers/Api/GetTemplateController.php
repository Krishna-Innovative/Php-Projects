<?php

namespace App\Http\Controllers\Api;
//use JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserTemplate;
use App\Models\Template;
use App\Models\Templatedata;
use App\Models\UserTemplateResponse;
use App\Models\UserFilledTemplateForm;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Driver;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmittedPdf;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Dompdf\Options;

class GetTemplateController extends Controller
{
    use HasFactory;
    public $token = true;
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }
    public function get_driver_assign_template(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate($request->token);
        if ($user) {
            // $template_info=array();
            $get_assign_user_tempate = UserTemplate::select('id', 'user_id', 'template_id', 'created_at', 'updated_at')->where('user_id', $id)->orderBy('id', 'DESC')->get();
            $template_info = array();
            // die;
            foreach ($get_assign_user_tempate as $key => $assign_template) {
                $template_id = $assign_template['template_id'];
                //$template_info[$key]['id'] = intval($template_id);
                $template_info[$key]['template_id'] = intval($template_id);
                $template_infos = Template::select('name', 'description', 'form_count', 'status', 'createdby')->where('id', $template_id)->get();
                $template_info[$key]['name'] = $template_infos[0]['name'];
                $template_info[$key]['description'] = $template_infos[0]['description'];
                $template_info[$key]['form_count'] = $template_infos[0]['form_count'];
                $template_info[$key]['createdby'] = $template_infos[0]['createdby'];
                $template_info[$key]['status'] = $template_infos[0]['status'];
                $template_info[$key]['created_at'] = $assign_template['created_at'];
                $template_info[$key]['updated_at'] = $assign_template['updated_at'];
                $template_info[$key]['form_number'] = 0;
                //$template_info[$key]['user_id']=$assign_template['user_id'];

            }
            if ($template_info) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Assign User Template list',
                    'data' => $template_info
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No template assign',
                    'data' => $template_info
                ], 401);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Account has been deleted.'
            ], 401);
        }
    }
    public function get_template_info(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate($request->token);
        if ($user) {
            $user_template = UserTemplate::where('user_id', $id)->get();
            $template_info = array();
            foreach ($user_template as $assign_template) {
                $template_id = $assign_template['template_id'];
                $get_template_info = Templatedata::where('template_id', $template_id)->orderBy('form_id', 'ASC')->get();
                foreach ($get_template_info as $template_response) {
                    $template_id = $template_response['id'];
                    $template_response['template_info_id'] = intval($template_id);
                    $template_response['field_value'] = "";
                    $template_response['signature'] = "";
                    $template_response['section_name'] = $template_response['section_name'] == "" ? '~' : $template_response['section_name'];
                    unset($template_response['id']);
                    $template_info[] = $template_response;
                    //$template_info[]['']="";
                }
            }
            if ($template_info) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Get all form fields',
                    'data' => $template_info
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No template assign',
                    'data' => []
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Account has been deleted'
            ], 401);
        }
    }
    public function get_user_answer_info(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate($request->token);
        if ($user) {
            $user_template = UserTemplate::where('user_id', $id)->get();
            $template_info = array();
            foreach ($user_template as $assign_template) {
                $template_id = $assign_template['template_id'];
                $get_template_info = UserTemplateResponse::where('template_id', $template_id)->get();
                foreach ($get_template_info as $template_response) {
                    $template_info[] = $template_response;
                    //$template_info[]['']="";
                }
            }
            if ($template_info) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Get all form fields',
                    'data' => $template_info
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No template assign',
                    'data' => []
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Account has been deleted.'
            ], 401);
        }
    }
    public function check_user_completed_form(Request $request, $user_id, $template_id, $form_number)
    {
        $user = JWTAuth::parseToken()->authenticate($request->token);
        if ($user) {
            $usersubmitted_result = UserTemplateResponse::where('user_id', $user_id)->where('template_id', $template_id)->where('form_number', $form_number)->orderBy('form_id', 'ASC')->get();
            $user_name = Driver::find($user_id);
            $email_id = $user_name['email'];
            $time = time() . rand(1, 99);
            $data = [
                'title' => 'Incident Report - Full Investigation & Report',
                'date' => date('d/m/Y'),
                'pdf_id' => $time . '_user',
                'usersubmitted_result' => $usersubmitted_result
            ];
            $pdf = App::make('dompdf.wrapper');

            $options = new Options();
            $pdf = PDF::loadView('pdf.createpdf', $data)->setPaper('a4', 'landscape')->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
            $pdf->save(public_path('/userpdf/' . $time . '_user' . '.pdf'));
            //$mail_send = Mail::to($email_id)->send(new SubmittedPdf($data));
            $pdflink = Config::get('app.url') . '/userpdf' . '/' . $time . '_user' . '.pdf';
            $data = [
                'user_id' => $user_id,
                'template_id' => $template_id,
                'iscompleted' => 1,
                'form_number' => $form_number,
                'pdf' => $pdflink
            ];
            $user = UserFilledTemplateForm::create($data);
            //$usertemplates = UserTemplate::where('user_id', $user_id)->where('template_id', $template_id)->update(array('iscompleted' => 1, 'pdf' => $pdflink));
            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Template status is updated',
                    'pdf' => $pdflink
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No template assign',
                    'data' => []
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Account has been deleted.'
            ], 401);
        }
    }
    public function get_completed_templates(Request $request, $user_id)
    {
        $user = JWTAuth::parseToken()->authenticate($request->token);
        if ($user) {
            $user_template = UserFilledTemplateForm::where('user_id', $user_id)->where('iscompleted', 1)->get();
            if ($user_template) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Get all form fields',
                    'data' => $user_template
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'No template assign',
                    'data' => []
                ], 200);
            }
        }
    }
    public function delete_from_template(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate($request->token);
        if ($user) {
            $user_id = $_POST['user_id'];
            $template_id = $_POST['template_id'];
            $form_id = $_POST['form_id'];
            $form_deleted = UserTemplateResponse::where('user_id', $user_id)->where('template_id', $template_id)->where('form_id', $form_id);
            $form_deleted->delete();
        }
    }
}
