<!-- <script>// Initialization for ES Users

</script> -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Templates') }}
        </h2>
    </x-slot>
    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg create_from">
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @else
                <div class="alert alert-danger" style="color:red;">
                    {{ session('error') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <section>
                    <header class="pb-3">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Templates Information') }}
                        </h2>
                    </header>
                    <div class="get_section_count" onclick="codeAddress('{{$form_id}}');"></div>
                    <input type="hidden" id="template_id" value="{{$template_id}}">
                    <form method="POST" action="{{route('templates.forms.update',$template_id)}}">
                        @csrf
                        @method('PUT')
                        <input name="form_id_info" type="hidden" value="{{$form_id+1}}" id="form_id_info">
                        <input name="number_of_form" type="hidden" value="{{$form_id}}">
                        <div class="row">
                            <div class="add_new_section{{$form_id}}" onclick="add_new_section('{{$form_id}}')">
                                <a href="javascript:void(0)" class="add_section_btn"><i class="fa-solid fa-plus"></i>New section</a>
                                <input name="section_count_{{$form_id}}" type="hidden" value="{{$form_id}}" class="section_count_{{$form_id}}">
                            </div>
                            <?php $currentFormNumber = 0;
                            $formsectionArray = [];
                            $divValue = '';
                            ?>
                            @foreach($get_template_info as $key=>$template_info)
                            <?php
                            $isSectionChange = False;
                            $formsectionString =  $template_info['form_id'] . $template_info['section'];
                            if (array_search($formsectionString, $formsectionArray) !== false) {
                                $divValue = '';
                            } else {
                                $divValue = '<div class="customer_records_group customer_records_' . $template_info['form_id'] . '_section_' . $template_info['section'] . ' remove' . $form_id . $form_id . $template_info['form_id'] . $template_info['section'] . ' active0">';
                                $isSectionChange = True;
                            }
                            $formsectionArray[] = $formsectionString;
                            echo $divValue;
                            if ($isSectionChange) {
                                //  echo '<input name="section_name[]" type="text" value="' . $template_info["section_name"] . '" placeholder="Enter Section name ">';
                            } else {
                                echo '<div class="new_customer_records customer_records p-2 remove' .  $template_info['id'] . ' active1001">';
                            }
                            ?>
                            <input name="section_name[]" type="text" value="{{$template_info['section_name']}}" placeholder="Enter Section name" class="{{ $template_info['section_name'] =='~' ? 'd-none' : 'd-block' }}">
                            <input name="name_[]" type="text" value="{{$template_info['title']}}" placeholder="Enter Question name *">
                            <input name="count" type="hidden" value="100120" class="counting">
                            <input name="form_id_[]" type="hidden" value="{{$template_info['form_id']}}">
                            <input name="section_[]" type="hidden" value="{{$template_info['section']}}">
                            <input name="template_id_[]" type="hidden" value="{{$template_info['template_id']}}" class="template_id">
                            <select name="type_[]" onchange="getvalue(this,'{{$key}}');">
                                <option value="text" {{ $template_info['type'] =="text" ? 'selected' : '' }}>TEXT</option>
                                <option value="textarea" {{ $template_info['type'] =="textarea" ? 'selected' : '' }}>TEXTAREA</option>
                                <option value="email" {{ $template_info['type'] =="email" ? 'selected' : '' }}>Email</option>
                                <option value="date" {{ $template_info['type'] =="date" ? 'selected' : '' }}>Date</option>
                                <option value="tel" {{ $template_info['type'] =="tel" ? 'selected' : '' }}>Phone</option>
                                <option value="signature" {{ $template_info['type'] =="signature" ? 'selected' : '' }}>Signature</option>
                                <option value="location" {{ $template_info['type'] =="location" ? 'selected' : '' }}>Location</option>
                                <option value="number" {{ $template_info['type'] =="number" ? 'selected' : '' }}>Number</option>
                                <option value="datetime" {{ $template_info['type'] =="datetime" ? 'selected' : '' }}>Datetime</option>
                                <option value="option" {{ $template_info['type'] =="option" ? 'selected' : '' }}>Option</option>
                                <option value="checkbox" {{ $template_info['type'] =="checkbox" ? 'selected' : '' }}>Checkbox</option>
                            </select>
                            @if($template_info['type'] =="option" || $template_info['type'] =="checkbox")
                            <textarea name="field_type_response[]" cols="35" rows="2" class="textarea{{$key}} " placeholder="Enter Values with Enter button Press">{{str_replace(",","\n",$template_info['field_type_response'])}}</textarea>
                            @else
                            <textarea name="field_type_response[]" cols="35" rows="2" class="textarea{{$key}} removetextarea" value="" placeholder="Enter Values with Enter button Press"></textarea>
                            @endif
                            <select name="required_[]">
                                <option value="1" {{ $template_info["isrequired"] == "1" ? 'selected' : '' }}>IsRequired</option>
                                <option value="0" {{ $template_info["isrequired"] == "0" ? 'selected' : '' }}>Not Required</option>
                            </select>

                            <?php
                            if ($isSectionChange) {
                                echo '<a class="add_more_btn extra-fields-customer0" onclick="append_data(' . $template_info["form_id"] . ',' . $template_info["section"] . ',' . $template_info["id"] . ')"><i class="fa-solid fa-plus"></i></a>';
                                echo '<a class="remove_btn extra-fields-customer" onclick="removesection('  . $template_info["form_id"] . ',' . $template_info["section"] . ')"><i class="fa-solid fa-trash"></i></a>';
                            } else {
                                echo '<a class="remove_btn extra-fields-customer" onclick="removefunction(' . $template_info['id'] . ')"><i class="fa-solid fa-trash"></i></a>';
                                echo '</div>';
                            }
                            if (count($get_template_info) == 1) {
                                $closeDiv = true;
                            } elseif (count($get_template_info) > 1) {
                                $nextKey = $key + 1;
                                if (array_key_exists($nextKey, $get_template_info)) {
                                    $nextFormSection = $get_template_info[$nextKey]['form_id'] . $get_template_info[$nextKey]['section'];
                                    if ($formsectionString != $nextFormSection) {
                                        $closeDiv = true;
                                    } else {
                                        $closeDiv = false;
                                    }
                                } else {
                                    $closeDiv = true;
                                }
                            } else {
                                $closeDiv = true;
                            }
                            ?>
                            <?php if ($closeDiv) {
                                echo '</div>';
                            }
                            $currentFormNumber++;
                            ?>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> -->
                            <a class="ml-4" href="/templates">
                                Cancel
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Update Template Forms') }}
                            </x-primary-button>
                        </div>
                    </form>

                </section>
            </div>
        </div>
    </div>

</x-app-layout>

<style>
    div#exampleModal {
        top: 90px;
    }

    .removetextarea {
        display: none;
    }

    input.d-none {
        visibility: hidden;
    }

    .create_from {
        background: #e9e9e9;
    }

    .customer_records_group input,
    .customer_records_group select,
    .customer_records_group textarea {
        margin-left: 7px;
        margin-bottom: 10px;
    }

    .customer_records_group textarea,
    .new_customer_records textarea {
        height: 41.6px;
    }

    .customer_records_group input:first-child {
        margin-left: 0;
    }

    .customer_records_group textarea {
        margin-left: 205px;
        width: 336px;
    }

    .customer_records_group {
        display: flex;
        flex-wrap: wrap;
    }

    .add_more_btn {
        background: transparent;
        border: 1px solid #7dc653;
        display: inline-block;
        padding: 8.8px 10px;
        cursor: pointer;
        margin-left: 10px;
        color: #7dc653;
        width: 46px;
        text-align: center;
        border-radius: 4px;
    }

    .add_more_btn:hover {
        background: #7dc653;
        color: #fff;
    }

    .remove_btn {
        background: transparent;
        border: 1px solid #ec4134;
        display: inline-block;
        padding: 8.8px 10px;
        cursor: pointer;
        color: #ec4134;
        width: 46px;
        text-align: center;
        margin-left: 10px;
        border-radius: 4px;
    }

    .remove_btn:hover {
        background: #ec4134;
        color: #fff;
    }

    .add_section_btn {
        background: #7dc653;
        border: 1px solid #7dc653;
        display: inline-block;
        padding: 8.8px 10px;
        cursor: pointer;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        margin-bottom: 10px;
        margin-top: 15px;
    }

    .add_section_btn i {
        margin-right: 5px;
    }
</style>
<script>
    function getvalue(get, form) {
        if (get.value == "option") {
            //alert(form);
            $('.textarea' + form).removeClass('removetextarea');
        } else if (get.value == "checkbox") {
            $('.textarea' + form).removeClass('removetextarea');
        } else {
            $('.textarea' + form).addClass('removetextarea').val('');
        }
    }

    function add_new_section(id) {
        var template_id = $("#template_id").val();
        var section_count = $('.section_count_' + id).val();
        increaseSetionn = parseInt(section_count) + 1;
        var section_id = parseInt(increaseSetionn * 100);
        var new_data = $('.counting').val();
        var new_section = '<div class="customer_records_' + id + '_section_' + (increaseSetionn) + ' active' + section_id + '"><div class="row"><div class="new_records_group"><input name="section_name[]" type="text" value="" placeholder="Enter Section name"><input name="name_[]" type="text" value="" placeholder="Enter Question name"><input name="count" type="hidden" value="3000" class="counting"><input name="form_id_[]" type="hidden" value="' + id + '"><input name="section_[]" type="hidden" value="' + increaseSetionn + '"><input name="template_id_[]" type="hidden" value="' + template_id + '" class="template_id"><select name="type_[]" onchange="getvalue(this,' + new_data + ')"><option value="text">TEXT</option><option value="textarea">TEXTAREA</option><option value="email">Email</option><option value="date">Date</option><option value="datetime">Datetime</option><option value="tel">Phone</option><option value="signature">Signature</option><option value="location">Location</option><option value="number">Number</option><option value="option">Option</option><option value="checkbox">Checkbox</option></select><textarea name="field_type_response[]" cols="35" rows="2" class="textarea' + new_data + ' removetextarea" placeholder="Enter Values with Enter button Press"></textarea><select name="required_[]"><option value="1">IsRequired</option><option value="0">Not Required</option></select><a class="add_more_btn extra-fields-customer" onclick="append_data(' + id + ',' + increaseSetionn + ',' + '0' + ')"><i class="fa-solid fa-plus"></i></a>  <a class="remove_btn extra-fields-customer" onclick="removesection(' + id + ',' + increaseSetionn + ')"><i class="fa-solid fa-trash"></i></a></div><div class="customer_records_dynamic"></div></div></>';
        if (section_count == -1) {
            var section_name_id = $("#form_id_info").val();
            var assign_id = section_name_id - 1;
            $('.add_new_section' + assign_id).after(new_section);
        } else {
            $('.customer_records_' + id + '_section_' + section_count).after(new_section);
        }
        section_count++;
        $('.section_count_' + id).val(section_count);
        new_data++;
        $('.counting').val(new_data);
    }

    function append_data(append_id, notincreamented, template_ids) {
        var template_id = $("#template_id").val();
        var counting = $(".counting").val();
        counting++;
        $(".counting").val(counting * 10);
        var new_record = '<div class="new_customer_records customer_records p-2 remove' + template_ids + ' active' + template_ids + '"><input name="section_name[]" type="text" value="~" placeholder="Enter Section name" style="visibility:hidden;"><input name="name_[]" type="text" value="" placeholder="Enter Question name"><input name="form_id_[]" type="hidden" value="' + append_id + '"><input name="template_id_[]" type="hidden" value="' + template_id + '"><input name="section_[]" type="hidden" value="' + notincreamented + '"><select name="type_[]" onchange="getvalue(this,' + counting + ')"><option value="text">TEXT</option><option value="textarea">TEXTAREA</option><option value="email">Email</option><option value="date">Date</option><option value="signature">Signature</option><option value="location">Location</option><option value="datetime">Datetime</option><option value="tel">Phone</option><option value="number">Number</option><option value="option">Option</option><option value="checkbox">Checkbox</option></select><textarea name="field_type_response[]" cols="35" rows="2" class="removetextarea textarea' + counting + '" placeholder="Enter Values with Enter button Press"></textarea><select name="required_[]"><option value="1">IsRequired</option><option value="0">Not Required</option></select><a class="remove_btn extra-fields-customer" onclick="removefunction(' + template_ids + ')"><i class="fa-solid fa-trash"></i></a></div>';

        $('.customer_records_' + append_id + '_section_' + notincreamented).append(new_record);
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<a href="#" class="remove_btn remove-field btn-remove-customer"><i class="fa-solid fa-trash"></i></a>');
        $('.customer_records_dynamic > .single').attr("class", "remove");
        $('.customer_records_dynamic input, .customer_records_dynamic select').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count);
            count++;
        });
    }

    function removefunction(remove_id) {
        $('.remove' + remove_id).remove();
    }

    function removesection(form, section) {
        // alert(form + 'xsse' + section);
        var section_count = $('.section_count_' + form).val();
        increaseSetionn = parseInt(section_count) - 1;
        $('.section_count_' + form).val(increaseSetionn);
        // alert($('.section_count_' + form).val(increaseSetionn));
        $('.customer_records_' + form + '_section_' + section).remove();

    }


    function codeAddress(id) {
        var divlenght = $('.customer_records_group').length;
        $('.section_count_' + id).val(parseInt(divlenght) - 1);
    }
    $(document).ready(function() {
        $(".get_section_count").click();
    });
</script>