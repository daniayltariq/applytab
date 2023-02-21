<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
    </div>
    @php
        $route=route('backend.job_update',['id'=>$job->id,'type'=>$type]);
    
    @endphp
    <form action="{{$route}}" method="POST">
        @csrf
        
        <div class="modal-body">
            <div class="kt-scroll" data-scroll="true">
                    
                @if (request()->type=='url')
                    <div class="form-group">
                        <label class="form-control-label">Apply Url</label>
                        <input type="text" class="form-control" name="url" value="{{old('url') ?? ($job->apply_details ?? '')}}"/>
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                @elseif(request()->type=='budget')
                    <div class="form-group">
                        <label class="form-control-label">Job Budget</label>
                        <input type="text" class="form-control" name="budget" value="{{old('budget') ?? ($job->budget ?? '')}}"/>
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>