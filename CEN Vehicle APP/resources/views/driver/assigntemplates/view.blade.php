<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Form Status') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="pb-3">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Driver Submitted Information') }}
                        </h2>
                        @if(count($usersubmitted_result)>0)
                        <a href="{{ route('pdf.createpdf',['user_id'=>$user_id,'template_id'=>$template_id,'download'=>'pdf']) }}" target="_blank" style="text-align: right;display: block;">Download PDF</a>
                        @endif

                    </header>
                    <div>
                        <table class="w-full completed-co-table">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answers </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if(count($usersubmitted_result)>0)
                                <?php $currentFormNumber = '~'; ?>
                                @foreach($usersubmitted_result as $key=>$finalresult)
                                <tr class="form{{$finalresult['form_id']}}">
                                    <?php $photos = json_decode($finalresult['photos'], true);
                                    ?>
                                    @if($finalresult['section_name']!="" && $finalresult['section_name']!="~")
                                <tr class="" style="background-color: #b2b1f7;">
                                    <td>{{$finalresult['section_name']}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>{{$finalresult['title']}}
                                        <p>
                                        <div style="display:flex;">
                                            <?php
                                            $i = 1;
                                            foreach ($photos as $photo) {
                                            ?>
                                                <div>
                                                    <a href="<?php echo $photo; ?>" target="_blank"><img src="<?php echo $photo; ?>" style="width:100px!important;height:100px;margin-right: 2px;"></a>
                                                    <span>Photo <?php echo $i; ?></span>
                                                </div>
                                            <?php
                                                $i++;
                                            } ?>
                                        </div>
                                        </p>
                                        <p>@if($finalresult['video'] != '')
                                            <?php $document = $finalresult['video'];
                                            $video = str_replace("http://103.164.67.227:8000/video/", '', $document); ?>
                                            <a href="{{$finalresult['video']}}" target="_blank"><?php echo $video; ?></a>
                                            @else
                                            @endif
                                        </p>
                                        <p>@if($finalresult['document'] != '')
                                            <?php $document = $finalresult['document'];
                                            $document = str_replace("http://103.164.67.227:8000/documents/", '', $document); ?>
                                            <a href="{{$finalresult['document']}}" target="_blank"><?php echo $document; ?></a>

                                            @else
                                            @endif
                                        </p>
                                        <p>{{$finalresult['notes']}}</p>
                                    </td>
                                    <td> {{$finalresult['field_value']}}</td>
                                </tr>
                                @else
                                <td class="sss">
                                    {{$finalresult['title']}}
                                    <p>
                                    <div style="display:flex;">
                                        <?php
                                        $i = 1;
                                        foreach ($photos as $photo) {
                                        ?>
                                            <div>
                                                <a href="<?php echo $photo; ?>" target="_blank"><img src="<?php echo $photo; ?>" style="width:100px!important;height:100px;margin-right: 2px;"></a>
                                                <span>Photo <?php echo $i; ?></span>
                                            </div>
                                        <?php
                                            $i++;
                                        } ?>
                                    </div>
                                    </p>
                                    <p>@if($finalresult['video'] != '')
                                        <a href="{{$finalresult['video']}}" target="_blank">View Videos </a>

                                        @else
                                        @endif
                                    </p>
                                    <p>@if($finalresult['document'] != '')
                                        <a href="{{$finalresult['document']}}" target="_blank">View Document </a>
                                        @else
                                        @endif
                                    </p>
                                    <p>{{$finalresult['notes']}}</p>
                                </td>
                                <td>
                                    {{$finalresult['field_value']}}
                                </td>
                                @endif
                                </tr>
                                @endforeach
                                @else
                                <tr class="text-center">
                                    <td colspan="3">Driver not submitted form Yet</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <?php if ($finalresult['signature'] != "") { ?>
                            <div class="signature" style="text-align:left;">
                                <h3>Name & signature of Investigator</h3>
                                <img style="display:inline-block;height: 50px;width: 70px;" src="{{$finalresult['signature']}}">
                                <p>{{$finalresult['field_value']}}</p>
                            </div>
                        <?php } ?>
                    </div>

                </section>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    th,
    td {
        border-bottom: 1px solid #ddd;
        padding: 8px;
    }

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #625FF3;
        color: black;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>