{--
<li class="onhover-dropdown p-0">
    <button class="btn btn-primary-light" type="button"><a ><i
                data-feather="log-out"></i>Log out</a></button>
</li>
--}

<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <form id="delete-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">
                        Do you really want to delete these records?
                        <br>
                        This process cannot be undone.
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-tw-dismiss="modal"
                        class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" type="button" class="btn btn-danger w-24" >Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->
