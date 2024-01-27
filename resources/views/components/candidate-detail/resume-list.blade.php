@props(['candidate', 'applicationParams'])

<div class="grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">
                        #
                    </th>
                    <th class="whitespace-nowrap">UPLOADED AT</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($candidate->resumes as $key => $data)
                    <tr class="intro-x">
                        <td class="w-10"> {{ $key + 1 }} </td>
                        <td class="!py-3.5">{{ $data->created_at }}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" title="Download" href="{{ $data->download_link }}"> <i
                                        data-lucide="download"class="w-4 h-4 mr-1"></i></a>
                                <a class="flex items-center mr-3" title="Edit" href="javascript:;"> <i
                                        data-lucide="check-square" class="w-4 h-4 mr-1"></i></a>
                                <a class="flex items-center text-danger delete-button" data-action="{{ route('candidate.delete.resume', ['id' => $data->id]) }}" data-item="{{ json_encode($data) }}" title="Delete" href="javascript:;"
                                    data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i
                                        data-lucide="trash-2" class="w-4 h-4 mr-1"></i></a>
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
