@extends('../layouts/side-menu')

@section('subhead')
<title>{{ $pageTitle }}</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Company
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">

    </div>
</div>

<!-- BEGIN: Striped Rows -->
<div class="intro-y box mt-5">
    <div class="p-5" id="striped-rows-table">
        <div class="preview">
            <div class="overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">Name</th>
                            <th class="whitespace-nowrap">Email</th>
                            <th class="whitespace-nowrap">Website</th>
                            <th class="whitespace-nowrap">Address</th>
                            <th class="whitespace-nowrap">Phone Number</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($companies as $key => $data)
                        <tr>
                            <td>{{ $companies->firstItem() + $key }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->website }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ $data->phone_number }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                No Data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<x-table-footer :per-page-route-name="'company.index'" :data="$companies" />
<!-- END: Striped Rows -->

@endsection