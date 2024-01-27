@props(['candidate', 'applicationParams'])

<div class="grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">COMPANY NAME</th>
                    <th class="text-center whitespace-nowrap">CAREER LEVEL</th>
                    <th class="text-center whitespace-nowrap">JOB ROLE</th>
                    <th class="text-center whitespace-nowrap">JOB SPECIALIZATION</th>
                    <th class="text-center whitespace-nowrap">JOB TYPE</th>
                    <th class="text-center whitespace-nowrap">JOB TITLE</th>
                    <th class="text-center whitespace-nowrap">JOB DESCRIPTIOn</th>
                    <th class="text-center whitespace-nowrap">SALARY RANGE</th>
                    <th class="text-center whitespace-nowrap">START - END OF WORK</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($candidate->work_experiences as $key => $data)
                <tr class="intro-x">
                    <td class="w-10"> {{ $key + 1 }} </td>
                    <td class="!py-3.5">{{ $data->company_name }}</td>
                    <td class="text-center">{{ $data->career_level->label }}</td>
                    <td class="text-center capitalize">{{ $data->job_role->label }}</td>
                    <td class="text-center capitalize">{{ $data->job_specialization->label }}</td>
                    <td class="text-center">{{ $data->job_type->label }}</td>
                    <td class="text-center capitalize">{{ $data->job_title }}</td>
                    <td class="text-center">
                        <div title="{{ $data->description }}">
                            {!! \Illuminate\Support\Str::limit($data->description, $limit = 50, $end = ' ...') !!}
                        </div>
                    </td>
                    <td class="text-center">{{ $data->salary_range->label }}</td>
                    <td class="text-center">{{ $data->start_of_work }} - {{ ($data->is_till_current) ? 'NOW' : $data->end_of_work }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="javascript:;"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i></a>
                            <a class="flex items-center text-danger delete-button" data-action="{{ route('candidate.delete.work-experience', ['id' => $data->id]) }}" data-item="{{ json_encode($data) }}" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11">
                        <center>No Data</center>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
</div>