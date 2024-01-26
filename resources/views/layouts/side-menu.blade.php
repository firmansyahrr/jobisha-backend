@extends('../layouts/base')

@section('head')
@yield('subhead')
@endsection


@section('content')


@php
$r = Route::current()->getName();
$expl = explode('.', $r);

@endphp

<div class="py-2">

    <x-mobile-menu />

    <div class="mt-[4.7rem] flex md:mt-0">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('/dist//images/logo.svg') }}">
                <span class="hidden xl:block text-white text-lg ml-3"> Jobisha </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="side-menu @if($expl[0] == 'home') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="side-menu__title">
                            Home
                        </div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('candidate.index') }}" class="side-menu @if($expl[0] == 'candidate') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                        <div class="side-menu__title">
                            Candidates
                        </div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('job.index') }}" class="side-menu @if($expl[0] == 'job') side-menu--active @endif">
                        <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                        <div class="side-menu__title">
                            Job
                        </div>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- END: Side Menu -->

        <!-- BEGIN: Content -->
        <div class="content">
            <x-top-bar />
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
</div>
@endsection

@once
@push('scripts')

@endpush
@endonce

@once
@push('scripts')

@endpush
@endonce