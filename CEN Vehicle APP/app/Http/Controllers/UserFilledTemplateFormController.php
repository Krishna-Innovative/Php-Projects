<?php

namespace App\Http\Controllers;

use App\Models\UserFilledTemplateForm;
use Illuminate\Http\Request;

class UserFilledTemplateFormController extends Controller
{
    public function index(Request $request)
    {
    }
    public function user_filled_form(Request $request, $user_id, $template_id)
    {
        $number_of_form_filled_by_user = UserFilledTemplateForm::join('templates', 'templates.id', '=', 'user_filled_template_form.template_id')
            ->where('user_id', $user_id)->where('template_id', $template_id)->get(['templates.name as template_name', 'user_filled_template_form.user_id', 'user_filled_template_form.template_id', 'user_filled_template_form.iscompleted', 'user_filled_template_form.form_number', 'user_filled_template_form.pdf']);

        //$number_of_form_filled_by_user = UserFilledTemplateForm::where('user_id', $user_id)->where('template_id', $template_id)->get();
        return view('driver.assigntemplates.form-filled', compact('number_of_form_filled_by_user'));
    }
}
