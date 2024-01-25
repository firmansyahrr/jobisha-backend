@extends('../layouts/side-menu')

@section('subhead')
<title>{{ $pageTitle }}</title>
@endsection

@section('subcontent')

<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Profile {{ $candidate->name }}
    </h2>
</div>
<!-- BEGIN: Profile Info -->
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                <img alt="Midone - HTML Admin Template" class="rounded-full"
                    src="{{ asset('dist/images/profile-14.jpg') }}">
                <div
                    class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2">
                    <i class="w-4 h-4 text-white" data-lucide="camera"></i>
                </div>
            </div>
            <div class="ml-5">
                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $candidate->name }}</div>
                <div class="text-slate-500">{Job Specialization}</div>
            </div>
        </div>
        <div
            class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail"
                        class="w-4 h-4 mr-2"></i>{{ $candidate->email }}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="phone"
                        class="w-4 h-4 mr-2"></i>{{ $candidate->phone_number }}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="calendar"
                        class="w-4 h-4 mr-2"></i>{{ $candidate->place_of_birth }}, {{ date('d M Y', strtotime($candidate->birthday)); }}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="banknote"
                        class="w-4 h-4 mr-2"></i>Rp. {{ $candidate->current_sallary }} - {{ $candidate->expected_sallary }}</div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3"> 
                    <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="pencil" class="w-4 h-4 mr-2"></i> Edit Profile </button>
                </div>
            </div>
        </div>
        <div
            class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
            <div class="font-medium text-center lg:text-left lg:mt-3">About Me</div>
            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="truncate sm:whitespace-normal flex items-center tooltip" title="{{ $candidate->about_me }}">
                    {!! \Illuminate\Support\Str::limit($candidate->about_me, $limit = 500, $end = ' ...') !!}
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
        <li id="dashboard-tab" class="nav-item" role="presentation">
            <a href="javascript:;" class="nav-link py-4 active" data-tw-toggle="pill" data-tw-target="#work_experience"
                aria-controls="dashboard" aria-selected="true" role="tab"> Work Experience </a>
        </li>
        <li id="account-and-profile-tab" class="nav-item" role="presentation">
            <a href="javascript:;" class="nav-link py-4" data-tw-target="#education" aria-selected="false" role="tab">
                Education </a>
        </li>
        <li id="activities-tab" class="nav-item" role="presentation">
            <a href="javascript:;" class="nav-link py-4" data-tw-target="#skill" aria-selected="false" role="tab"> Skill
            </a>
        </li>
        <li id="tasks-tab" class="nav-item" role="presentation">
            <a href="javascript:;" class="nav-link py-4" data-tw-target="#resume" aria-selected="false" role="tab">
                Resume </a>
        </li>
    </ul>
</div>
<!-- END: Profile Info -->
<div class="intro-y tab-content mt-5">
    <div id="dashboard" class="tab-pane active" role="tabpanel" aria-labelledby="dashboard-tab">
        <div class="tab-content">

            <div id="work_experience" class="tab-pane leading-relaxed box active" role="tabpanel">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Work Experience
                    </h2>
                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#modal-form-work-experience" class="btn btn-primary btn-sm mr-1 mb-2">Add New</a>
                </div>
                <div class="p-5">
                    as
                </div>
            </div>

            <div id="education" class="tab-pane leading-relaxed box" role="tabpanel">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Education
                    </h2>
                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#modal-form-education" class="btn btn-primary btn-sm mr-1 mb-2">Add New</a> 
                </div>
                <div class="p-5">
                    as
                </div>
            </div>

            <div id="skill" class="tab-pane leading-relaxed box" role="tabpanel">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Skill
                    </h2>
                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#modal-form-skill" class="btn btn-primary btn-sm mr-1 mb-2">Add New</a>
                </div>
                <div class="p-5">
                    as
                </div>
            </div>

            <div id="resume" class="tab-pane leading-relaxed box" role="tabpanel">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Resume
                    </h2>
                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#modal-form-resume" class="btn btn-primary btn-sm mr-1 mb-2">Add New</a>
                </div>
                <div class="p-5">
                    as
                </div>
            </div>

        </div>
    </div>
</div>

<x-candidate-detail.work_experience />
<x-candidate-detail.education :candidate="$candidate" :applicationParams="$applicationParams"/>
<x-candidate-detail.skill />
<x-candidate-detail.resume />

@endsection