<!-- BEGIN: Account Menu -->
<div class="intro-x dropdown w-8 h-8">
    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button"
        aria-expanded="false" data-tw-toggle="dropdown">
        <img alt="Midone - HTML Admin Template" src="{{ asset('/dist//images/profile-5.jpg') }}">
    </div>
    <div class="dropdown-menu w-56">
        <ul class="dropdown-content bg-primary text-white">
            <li class="p-2">
                @if(request()->session()->get('authenticated'))
                <div class="font-medium">{{ request()->session()->get('user')['name'] }}</div>
                <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{ request()->session()->get('user')['role'] }}</div>
                @endif
            </li>
            {{--
            <li>
                <hr class="dropdown-divider border-white/[0.08]">
            </li>
            <li>
                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                    Profile </a>
            </li>
            <li>
                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                    Add Account </a>
            </li>
            <li>
                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i>
                    Reset Password </a>
            </li>
            <li>
                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle"
                        class="w-4 h-4 mr-2"></i> Help </a>
            </li>
            <li>
                <hr class="dropdown-divider border-white/[0.08]">
            </li>
            --}}
            <li>
                <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right"
                        class="w-4 h-4 mr-2"></i> Logout </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Account Menu -->