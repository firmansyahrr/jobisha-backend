@props(['candidate', 'applicationParams'])

<div class="grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">NAME</th>
                    <th class="text-center whitespace-nowrap">EDUCATION LEVEL</th>
                    <th class="text-center whitespace-nowrap">GRADUATION DATE</th>
                    <th class="text-center whitespace-nowrap">IS TILL CURRENT</th>
                    <th class="text-center whitespace-nowrap">DESCRIPTION</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($candidate->educations as $key => $data)
                <tr class="intro-x">
                    <td class="w-10"> {{ $key + 1 }} </td>
                    <td class="!py-3.5">{{ $data->name }}</td>
                    <td class="text-center">{{ $data->education_level->label }}</td>
                    <td class="text-center capitalize">{{ $data->graduation_date }}</td>
                    <td class="w-40">@if($data->is_till_current) YES @else NO @endif</td>
                    <td class="text-center">{{ $data->description }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a class="flex items-center mr-3" href="javascript:;"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i></a>
                            <a class="flex items-center text-danger delete-button" data-action="{{ route('candidate.delete.education', ['id' => $data->id]) }}" data-item="{{ json_encode($data) }}" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <center>No Data</center>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
</div>