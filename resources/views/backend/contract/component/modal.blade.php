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
                        <div class="bg_valid_error bg-danger" id="budget_valid_errors">

                        </div>
                        <table id="budget_repeater" class="table table-sm m-0 budget_repeater">
                            <thead>
                                <tr>
                                    <th class="border-top-0" style="width: 50%">{{trans('Site')}}</th>
                                    <th class="border-top-0" style="width: 40%">{{trans('Budget')}}</th>
                                    <th class="border-top-0 text-right"></th>
                                </tr>
                            </thead>
                            <tbody data-repeater-list="budget">
                                <tr data-repeater-item>
                                    <td class="align-middle">
                                        <select class="form-control custom-select custom-border selectpicker" name="site_id" data-live-search="true" required="required">
                                            <option value="" selected disabled>Select Site</option>
                                            @foreach ($sites as $site)
                                                <option value="{{$site->id ?? ''}}">{{$site->site_name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <input type="text" class="form-control" name="budget" value="{{old('budget') ?? ($job->budget ?? '')}}"/>
                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="align-middle text-right">
                                        <a href="#">
                                            <i class="fa fa-trash-alt text-danger text-xl" data-repeater-delete=""></i>
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
                                            <i class="fa fa-plus text-primary text-xl" data-repeater-create></i>
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

<script>
    
	$elem = $('#budget_repeater').repeater({
        // (Optional)
        // start with an empty list of repeaters. Set your first (and only)
        // "data-repeater-item" with style="display:none;" and pass the
        // following configuration flag
        initEmpty: true,
        // (Optional)
        // "defaultValues" sets the values of added items.  The keys of
        // defaultValues refer to the value of the input's name attribute.
        // If a default value is not specified for an input, then it will
        // have its value cleared.
        defaultValues: {
            'text-input': 'foo'
        },
        // (Optional)
        // "show" is called just after an item is added.  The item is hidden
        // at this point.  If a show callback is not given the item will
        // have $(this).show() called on it.
        show: function () {
            $(this).slideDown();
            setSelectPicker();
            $('td>div.custom-select.custom-border>div.custom-select.custom-border').siblings('button.btn.dropdown-toggle.bs-placeholder').hide();
        },
        // (Optional)
        // "hide" is called when a user clicks on a data-repeater-delete
        // element.  The item is still visible.  "hide" is passed a function
        // as its first argument which will properly remove the item.
        // "hide" allows for a confirmation step, to send a delete request
        // to the server, etc.  If a hide callback is not given the item
        // will be deleted.
        hide: function (deleteElement) {
            /* if(confirm('Are you sure you want to delete this element?')) { */
                $(this).slideUp(deleteElement);
            /* } */
        },
        // (Optional)
        // You can use this if you need to manually re-index the list
        // for example if you are using a drag and drop library to reorder
        // list items.
        /* ready: function (setIndexes) {
            $dragAndDrop.on('drop', setIndexes);
        }, */
        // (Optional)
        // Removes the delete button from the first list item,
        // defaults to false.
        isFirstItemUndeletable: true
    })

    @if(request()->type=='budget')
        var tasks={!!json_encode($job->budgets->toArray())!!};
        $elem.setList(tasks);
    @endif
</script>