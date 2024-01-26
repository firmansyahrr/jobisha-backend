@props(['candidate', 'applicationParams'])

<div id="modal-form-resume" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="vertical-form" class="p-5">
                <form method="POST" action="{{ route('candidate.update.resume', ['id' => $candidate->id]) }}"
                    class="max-w-4xl m-auto" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="frm-rsm-id" name="id" />

                    <div class="preview">
                        <div class="@error('resume') input-form has-error @enderror">
                            <label for="frm-resume" class="form-label">File</label>
                            <div class="fallback"> <input name="resume" type="file" /> </div>
                            @error('resume')
                            <div class="pristine-error text-danger mt-2">{{ $message }}</div>
                            @enderror

                        </div>

                        <button type="submit" class="btn btn-primary mt-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>