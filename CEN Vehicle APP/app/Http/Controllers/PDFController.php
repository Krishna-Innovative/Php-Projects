<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Driver;
use App\Models\UserTemplateResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmittedPdf;
//use PDF;

class PDFController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $_GET['user_id'];
        $template_id = $_GET['template_id'];
        $usersubmitted_result  = UserTemplateResponse::where('user_id', $user_id)->where('template_id', $template_id)->orderBy('form_id')->get();
        $user_name = Driver::find($user_id);
        $email_id = $user_name['email'];
        $time = time() . rand(1, 99);
        $data = [
            'title' => 'Incident Report - Full Investigation & Report',
            'date' => date('d/m/Y'),
            'pdf_id' => $time . '_user',
            'usersubmitted_result' => $usersubmitted_result
        ];
        $pdf = PDF::loadView('pdf.createpdf', $data)->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->download('usersubmitted.pdf');
        //$pdf->save(public_path('/userpdf/' . $time . '_user' . '.pdf'));
        //$mail_send = Mail::to($email_id)->send(new SubmittedPdf($data));
        // return $pdf->download('index.pdf');

        return view('pdf/createpdf', compact('usersubmitted_result'));
    }
}
