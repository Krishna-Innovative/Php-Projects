<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Forms') }}
        </h2>

    </x-slot>
    <!-- <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">
            
        </div>
    </div> -->
    <!-- <form method="POST" action="{{route('templates.create')}}">
        @csrf -->

    <!-- Name -->


    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg create_from">
                <div class="max-w-7xl mx-auto px-4">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Forms Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 mb-3">
                                {{ __("Create a new Form fields.") }}
                            </p>
                        </header>
                    </section>
                    <div class="grid grid-cols-1 gap-4">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li style="color:red;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="/templates/{{$id}}/create" method="POST" id=form_0>
                            <input type="hidden" value="{{$forms_count}}" id="form_count">

                            @csrf
                            @for ($i = 0; $i <$forms_count ; $i++) <div id="div{{$i}}">
                                <div class="section_detailed_id" style="display:none;">0</div>
                                <div class="add_new_form_repeater">
                                    <a href="javascript:void(0)"><b>Form {{$i+1}}</b></a>
                                </div>
                                <div class="add_new_section{{$i}}" onclick="add_new_section('{{$i}}')">
                                    <a href="javascript:void(0)" class="add_section_btn"><i class="fa-solid fa-plus"></i>New section</a>
                                    <input name="section_count_{{$i}}" type="hidden" value="0" class="section_count_{{$i}}">
                                </div>
                                <div class="row">
                                    <div class="customer_records_group customer_records_{{$i}}_section_0 remove active{{$i}}">
                                        <input name="section_name[]" type="text" value="" placeholder="Enter Section name">
                                        <input name="name_[]" type="text" value="" placeholder="Enter Question name *">
                                        <input name="count" type="hidden" value="{{($i+1)*1000}}" class="counting">
                                        <input name="form_id_[]" type="hidden" value="{{$i}}">
                                        <input name="section_[]" type="hidden" value="0">

                                        <input name="template_id_[]" type="hidden" value="{{$id}}" class="template_id">
                                        <select name="type_[]" onchange="getvalue(this,'{{$i}}');">
                                            <option value="text">TEXT</option>
                                            <option value="textarea">TEXTAREA</option>
                                            <option value="email">Email</option>
                                            <option value="date">Date</option>
                                            <option value="signature">Signature</option>
                                            <option value="location">Location</option>
                                            <option value="datetime">Datetime</option>
                                            <option value="tel">Phone</option>
                                            <option value="number">Number</option>
                                            <option value="option">Option</option>
                                            <option value="checkbox">Checkbox</option>
                                        </select>
                                        <textarea name="field_type_response[]" cols="35" rows="2" class="textarea{{$i}} removetextarea" placeholder="Enter Values with Enter button Press"></textarea>
                                        <select name="required_[]">
                                            <option value="1">IsRequired</option>
                                            <option value="0">Not Required</option>
                                        </select>
                                        <a class="add_more_btn extra-fields-customer{{$i}}" onclick="append_data('{{$i}}',0)"><i class="fa-solid fa-plus"></i></a>

                                    </div>
                                </div>
                                <div style="display:none;">
                                    <div class="flex items-center justify-end mt-4">
                                        <a class="ml-4" href="/templates">
                                            {{ __('Cancel') }}
                                        </a>
                                        <x-primary-button class="ml-4 " id="form_sumbit{{$i}}">
                                            {{ __('Add Templates') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <hr>
                                </div>
                    </div>
                    @endfor
                    </form>
                </div>
            </div>
        </div>
        <div>
            <div class="flex items-center justify-end mt-4">
                <a class="ml-4" href="/templates">
                    Cancel
                </a>
                <button id="final_submit" onclick="final_submission('{{$forms_count}}')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                    Add Forms
                </button>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
<script>
    function append_data(append_id, notincreamented) {
        var template_id = $(".template_id").val();
        var counting = $(".counting").val();
        counting++;
        $(".counting").val(counting * 10);
        var new_record = '<div class="new_customer_records customer_records p-2 remove' + counting + ' active' + counting + '"><input name="section_name[]" type="text" value="~" placeholder="Enter Section name" style="display:none;"><input name="name_[]" type="text" value="" placeholder="Enter Question name"><input name="form_id_[]" type="hidden" value="' + append_id + '"><input name="template_id_[]" type="hidden" value="' + template_id + '"><input name="section_[]" type="hidden" value="' + notincreamented + '"><select name="type_[]" onchange="getvalue(this,' + counting + ')"><option value="text">TEXT</option><option value="textarea">TEXTAREA</option><option value="email">Email</option><option value="date">Date</option><option value="signature">Signature</option><option value="location">Location</option><option value="datetime">Datetime</option><option value="tel">Phone</option><option value="number">Number</option><option value="option">Option</option><option value="checkbox">Checkbox</option></select><textarea name="field_type_response[]" cols="35" rows="2" class="removetextarea textarea' + counting + '" placeholder="Enter Values with Enter button Press"></textarea><select name="required_[]"><option value="1">IsRequired</option><option value="0">Not Required</option></select><a class="remove_btn extra-fields-customer" onclick="removefunction(' + counting + ')"><i class="fa-solid fa-trash"></i></a></div>';

        $('.customer_records_' + append_id + '_section_' + notincreamented).append(new_record);
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append('<a href="#" class="remove-field btn-remove-customer">Remove Fields</a>');
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
        var section_count = $('.section_count_' + form).val();
        increaseSetionn = parseInt(section_count) - 1;
        $('.section_count_' + form).val(increaseSetionn);
        $('.customer_records_' + form + '_section_' + section).remove();
    }

    function final_submission(form_id) {
        for (var i = 0; i < form_id; i++) {
            $('#form_sumbit' + i).click();
        }
    }

    function getvalue(get, form) {
        if (get.value == "option") {
            $('.textarea' + form).removeClass('removetextarea');
        } else if (get.value == "checkbox") {
            $('.textarea' + form).removeClass('removetextarea');
        } else {
            $('.textarea' + form).addClass('removetextarea').val('');
        }
    }

    function add_new_section(id) {
        var template_id = $(".template_id").val();
        var section_count = $('.section_count_' + id).val();
        increaseSetionn = parseInt(section_count) + 1;
        var section_id = parseInt(increaseSetionn * 100);
        var new_data = $('.counting').val();
        var new_section = '<br><div class="customer_records_' + id + '_section_' + (increaseSetionn) + ' active' + section_id + '"><div class="row"><div class="new_records_group"><input name="section_name[]" type="text" value="" placeholder="Enter Section name"><input name="name_[]" type="text" value="" placeholder="Enter Question name"><input name="count" type="hidden" value="3000" class="counting"><input name="form_id_[]" type="hidden" value="' + id + '"><input name="section_[]" type="hidden" value="' + increaseSetionn + '"><input name="template_id_[]" type="hidden" value="' + template_id + '" class="template_id"><select name="type_[]" onchange="getvalue(this,' + new_data + ')"><option value="text">TEXT</option><option value="textarea">TEXTAREA</option><option value="email">Email</option><option value="date">Date</option><option value="signature">Signature</option><option value="location">Location</option><option value="datetime">Datetime</option><option value="tel">Phone</option><option value="number">Number</option><option value="option">Option</option><option value="checkbox">Checkbox</option></select><textarea name="field_type_response[]" cols="35" rows="2" class="textarea' + new_data + ' removetextarea" placeholder="Enter Values with Enter button Press"></textarea><select name="required_[]"><option value="1">IsRequired</option><option value="0">Not Required</option></select><a class="add_more_btn extra-fields-customer" onclick="append_data(' + id + ',' + increaseSetionn + ')"><i class="fa-solid fa-plus"></i></a> <a class="remove_btn extra-fields-customer" onclick="removesection(' + id + ',' + increaseSetionn + ')"><i class="fa-solid fa-trash"></i></a></div><div class="customer_records_dynamic"></div></div></>';
        $('.customer_records_' + id + '_section_' + section_count).after(new_section);
        section_count++;
        $('.section_count_' + id).val(section_count);
        new_data++;
        $('.counting').val(new_data);
    }
</script>
<style>
    .removetextarea {
        display: none;
    }

    form#form_0 a {
        cursor: pointer;
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

    .new_customer_records {
        padding-left: 198px;
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

    .new_records_group input,
    .new_records_group select {
        margin-left: 7px;
    }

    .customer_records_group,
    .new_customer_records {
        display: flex;
        align-items: self-start;
        flex-wrap: wrap;
    }

    /* .create_from {
    background: #e9e9e9;
} */
    .create_from h2 {
        font-size: 26px;
        /* color: #38607c; */
    }
</style>