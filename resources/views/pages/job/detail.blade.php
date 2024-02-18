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
                    {{ $job->company->name }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Job Title
                    </a>
                    {{ $job->title }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Job Type
                    </a>
                    {{ $job->job_type->label }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Year Experience
                    </a>
                    {{ $job->year_of_experience }} yr

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Career Level
                    </a>
                    {{ $job->career_level->label }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Job Specialization
                    </a>
                    {{ $job->job_specialization->label }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Job Role
                    </a>
                    {{ $job->job_role->label }}

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Job Preferences
                    </a>
                    @foreach ($job->job_preferences as $item)
                        <span
                            class="px-2 py-1 rounded-full border text-slate-600 dark:border-darkmode-100/40 dark:text-slate-300 mr-1">{{ $item->label }}</span>
                    @endforeach

                    <br />

                    <a class="flex items-center mt-5" href="#">
                        <i data-lucide="box" class="w-4 h-4 mr-2"></i> Job Location
                    </a>
                    @foreach ($job->job_locations as $item)
                        <span
                            class="px-2 py-1 rounded-full border text-slate-600 dark:border-darkmode-100/40 dark:text-slate-300 mr-1">{{ $item->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END: FAQ Menu -->
        <!-- BEGIN: FAQ Content -->
        <div class="intro-y col-span-12 lg:col-span-8 xl:col-span-9">

            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Job Description
                    </h2>
                </div>
                <div id="faq-accordion-1" class="accordion p-5">
                    <div id="faq-accordion-content-1" class="accordion-header">
                        <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                            {!! $job->job_description !!}
                        </button>
                    </div>
                </div>
            </div>

            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Requirement
                    </h2>
                </div>
                <div id="faq-accordion-1" class="accordion p-5">
                    <div id="faq-accordion-content-1" class="accordion-header">
                        <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                            {!! $job->requirement !!}
                        </button>
                    </div>
                </div>
            </div>

            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Responsibilities
                    </h2>
                </div>
                <div id="faq-accordion-1" class="accordion p-5">
                    <div id="faq-accordion-content-1" class="accordion-header">
                        <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                            {!! $job->responsibilities !!}
                        </button>
                    </div>
                </div>
            </div>

            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Benefit
                    </h2>
                </div>
                <div id="faq-accordion-1" class="accordion p-5">
                    <div id="faq-accordion-content-1" class="accordion-header">
                        <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                            {!! $job->benefit !!}
                        </button>
                    </div>
                </div>
            </div>

            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Qualification
                    </h2>
                </div>
                <div id="faq-accordion-1" class="accordion p-5">
                    <div id="faq-accordion-content-1" class="accordion-header">
                        <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                            {!! $job->qualification !!}
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <!-- END: FAQ Content -->
    </div>

    <!-- BEGIN: Striped Rows -->
    <div class="intro-y box mt-5">
        <div class="p-5" id="striped-rows-table">
            <div class="preview">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Candidate Applied
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Candidate Name</th>
                                <th class="whitespace-nowrap">Applied Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appliedCandidates as $key => $data)
                            <tr>
                                <td>{{ $appliedCandidates->firstItem() + $key }}</td>
                                <td>{{ $data->candidate->name }}</td>
                                <td>{{ $data->created_at }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    <center>No Data</center>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <x-table-footer :per-page-route-name="'job.detail'" :data="$appliedCandidates" :route-attribute="['id' => $job->id ] "/>
                </div>
            </div>
        </div>
    </div>
@endsection
