<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Templatedata;
use App\Models\UserTemplateResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelFFMpeg\Support\ServiceProvider;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;


class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
    }

    public function store(Request $request)
    {
        if (auth()->user()) {
            $allowedfileExtension = ['jpg', 'png'];
            $files = $request->file('photos');
            $notes = $_POST['notes'];
            $video = $request->file('videos');
            $documents = $request->file('document');
            $form_id = $_POST['form_id'];
            $section_id = $_POST['section_id'];
            $section_name = $_POST['section_name'];
            $form_number = $_POST['form_number'];
            $signature =  $request->file('signature');
            $data['form_id'] = $form_id;
            $data['section'] = $section_id;
            $data['section_name'] = $section_name;
            $data['notes'] = $notes;
            $data['photos'] = '';
            $data['videos'] = '';
            $data['documents'] = '';
            $data['signature'] = '';
            $data['field_value'] = $_POST['field_value'];

            $images = [];
            if ($request->photos) {
                foreach ($request->photos as $key => $image) {
                    $imageName = time() . rand(1, 99) . '.' . $image->extension();
                    $image->move(public_path('images'), $imageName);
                    $images[] = Config::get('app.url') . '/images' . '/' . $imageName;
                }
            }
            $data['photos'] = $images;
            if ($request->videos) {
                $videoName = time() . rand(1, 99) . '.' . $request->videos->extension();
                $request->videos->move(public_path('videos'), $videoName);
                $data['videos'] = Config::get('app.url') . '/videos' . '/' . $videoName;
            }
            if ($request->documents) {
                $documentName = time() . rand(1, 99) . '.' . $request->documents->extension();
                $request->documents->move(public_path('documents'), $documentName);
                $data['documents'] = Config::get('app.url') . '/documents' . '/' . $documentName;
            }
            if ($request->signature) {
                $signatureName = time() . rand(1, 99) . '.' . $request->signature->extension();
                $request->signature->move(public_path('images'), $signatureName);
                $data['signature'] = Config::get('app.url') . '/images' . '/' . $signatureName;
            }
            $template_data = Templatedata::where('template_id', $request->template_id)->where('form_id', $request->form_id)->get()->toArray();
            if ($template_data) {
                $usertemplate_records = UserTemplateResponse::where('user_id', $request->user_id)->where('template_id', $request->template_id)->where('form_id', $request->form_id)->where('section', $request->section_id)->where('section_name', $section_name)->where('form_number', $form_number);
                $usertemplate_records->delete();
                $data1 = [
                    'user_id' => $request->user_id,
                    'template_id' => $request->template_id,
                    'form_id' => $request->form_id,
                    'section' => $request->section_id,
                    'section_name' => $request->section_name ? $request->section_name : "",
                    'title' => $request->title,
                    'type' => $request->type,
                    'isrequired' => $request->isrequired ? $request->isrequired : "",
                    'field_type_response' => $request->field_type_response ? $request->field_type_response : "",
                    'field_value' =>  $request->field_value ? $request->field_value : "",
                    'notes' =>  $request->notes ? $request->notes : "",
                    'photos' => json_encode($images) ? json_encode($images) : "[]",
                    'video'      => $data['videos'] ? $data['videos'] : "",
                    'document' => $data['documents'] ? $data['documents'] : "",
                    'isactive' => $request->isactive ? $request->isactive : "",
                    'isLive' => $request->isLive,
                    'savedOnDate' =>  $request->savedOnDate,
                    'signature' => $data['signature'] ? $data['signature'] : "",
                    'form_number' => $form_number,
                ];
                $user = UserTemplateResponse::create($data1);
            } else {
                $usertemplate_records = UserTemplateResponse::where('user_id', $request->user_id)->where('template_id', $request->template_id)->where('form_id', $request->form_id)->where('section', $request->section_id)->where('section_name', $section_name)->where('form_number', $form_number);
                $usertemplate_records->delete();
            }
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Account has been deleted'
            ], 401);
        }
    }
}
