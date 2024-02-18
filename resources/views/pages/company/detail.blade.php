@extends('../layouts/side-menu')

@section('subhead')
    <title>{{ $pageTitle }}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Job Detail
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: FAQ Menu -->
        <div class="intro-y col-span-12 lg:col-span-4 xl:col-span-3">
            <div class="box mt-5">
                <div class="p-5">
                    <a class="flex items-center font-medium" href="#">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Company Name
                    </a>
                    {{ $company->name }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Website
                    </a>
                    {{ $company->website }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Email
                    </a>
                    {{ $company->email }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Since
                    </a>
                    {{ $company->since_year }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Company Phone Number
                    </a>
                    {{ $company->phone_number }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Address
                    </a>
                    {{ $company->address }}, {{ $company->province->name }}, {{ $company->city->name }},
                    {{ $company->zip_code }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i> description
                    </a>
                    {{ $company->description }}

                    <br />

                </div>
            </div>
        </div>
        <!-- END: FAQ Menu -->

        <!-- BEGIN: FAQ Content -->
        <div class="intro-y col-span-12 lg:col-span-8 xl:col-span-9">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Job List
                    </h2>
                </div>
                <div id="faq-accordion-1" class="accordion p-5">
                    <div class="overflow-x-auto">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">Company</th>
                                    <th class="whitespace-nowrap">Title</th>
                                    <th class="whitespace-nowrap">Job Type</th>
                                    <th class="whitespace-nowrap">Specialization</th>
                                    <th class="whitespace-nowrap">Role</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobs as $key => $data)
                                    <tr>
                                        <td>{{ $jobs->firstItem() + $key }}</td>
                                        <td>{{ $data->company->name }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->job_type->label }}</td>
                                        <td>{{ $data->job_specialization->label }}</td>
                                        <td>{{ $data->job_role->label }}</td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center">
                                                <a class="flex items-center mr-3"
                                                    href="{{ route('job.detail', ['id' => $data->id]) }}" title="View">
                                                    <i data-lucide="glasses" class="w-4 h-4 mr-1"></i></a>
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
            <x-table-footer :per-page-route-name="'company.detail'" :data="$jobs" :route-attribute="['id' => $company->id ] "/>
        </div>
        <!-- END: FAQ Content -->
    </div>
@endsection
