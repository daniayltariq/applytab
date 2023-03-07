<div class="modal-content">
    <div class="modal-header mx-auto">
        <h4 class="modal-title" id="exampleModalLabel">{{$type=='pixel' ? 'Job Pixel' : 'Update Job' }}</h4>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
        </button>
    </div>
    @if ($type=='pixel')
        <div class="modal-body">
            <div class="row p-4">
                <div class="col-md-10 mx-auto">
                    <h4 style="color:#485080;font-weight: 800;">Here is your Tracking Pixel, now you can track webpage visits (page views).</h4>
                    <textarea class="codeblock w-100" onclick=" this.select() "><img src="{{route('pixel.watch',$job->unique_id)}}"></textarea>
                </div>
            </div>
            
        </div>
        
    @else
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
                        <table id="budget_repeater" class="table table-sm m-0 budget_repeater">
                            <thead>
                                <tr>
                                    <th class="border-top-0" style="width: 50%">{{trans('Activity')}}</th>
                                    <th class="border-top-0" style="width: 40%">{{trans('Action')}}</th>
                                    <th class="border-top-0 text-right"></th>
                                </tr>
                            </thead>
                            <tbody data-repeater-list="task">
                                <tr data-repeater-item>
                                    <td class="align-middle">
                                        <select class="form-control custom-select custom-border selectpicker" name="site_id" data-live-search="true" required="required">
                                            <option value="" selected disabled>Select Site</option>
                                            @foreach ($sites as $site)
                                                <option value="{{$site->id ?? ''}}">{{$site->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <div class="form-group">
                                            <label class="form-control-label">Job Budget</label>
                                            <input type="text" class="form-control" name="budget" value="{{old('budget') ?? ($job->budget ?? '')}}"/>
                                            @error('name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </td>
                                    <td class="align-middle text-right">
                                        <a href="#">
                                            <i class="fa fa-trash-alt text-danger text-xl" data-repeater-delete="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="align-middle text-right">
                                        <a href="#">
                                            <i class="fa fa-plus text-primary text-xl" data-repeater-create data-toggle="tooltip" data-placement="top" title="" data-original-title="Add"></i>
                                        </a>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        
                    @endif
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    @endif
        
</div>