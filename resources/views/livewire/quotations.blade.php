<div>
<form action="{{ route('quotation.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
@csrf                    
    <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
    <div class="kt-portlet__body">
        <div class="kt-section kt-section--first">
            <div class="kt-section__body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Quotation No.</b></label>
                    <div class="col-lg-9 col-xl-4">  
                        <input type="text"  name="quotation_no" value="{{$data}}" id="quotation_no" class="form-control" placeholder="Quotation_No" readonly> 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Customer Name</b></label>
                    <div class="col-lg-4 col-xl-4">  
                        <select class="form-control" id="customer_name" name="customer_name[]">
                            <option value="">---SELECT---</option>
                            @foreach($customer as $customers)
                            <option value="{{$customers->name}}">{{$customers->name}}</option>
                            @endforeach
                        </select></div>
                        <div class="col-lg-5 col-xl-5">
                        <a href="#" wire:click="customer" class="btn btn-brand btn-icon-sm" aria-expanded="false">
                                <i class="flaticon2-plus"></i>Add New Customer
                            </a> 
                    </div>
                </div>
                @for($i=0; $i<$c; $i++)
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label"><b></b></label>
                    <div class="col-lg-9 col-xl-4">
                    <input type="text" name="customer_name[]" class="form-control" placeholder="New Customer" required>
                </div>
                </div>
                @endfor
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Product Name</b></label>
                    <div class="col-lg-9 col-xl-4">  
                        <input type="text" name="product_name" value="{{old('product_name',isset($data->product_name)?$data->product_name:'')}}" id="product_name" class="form-control" placeholder="product_name" required> 
                    </div>
                </div>
                <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Priority</b></label>
                <div class="col-lg-9 col-xl-4">  
                    <select class="form-control" id="priority" name="priority">
                        <option value="">---SELECT---</option>
                        <option value="High">High</option>
                        <option value="Medium" >Medium</option>
                        <option value="Low" >Low</option>
                    </select> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>FollowUp On Quotation</b></label>
                <!--begin::Daterange-->
                <div class="col-lg-4 col-xl-4"> 
                    <div class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_daterangepicker" data-toggle="tooltip"  title="Select dashboard daterange" data-placement="left">
                        <span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_daterangepicker_title">Today</span>
                        <span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_daterangepicker_date">Aug 16</span>
                    </div>
                </div>
                    <!--end::Daterange-->
                <!-- <div class="col-lg-4 col-xl-4">  
                    <select class="form-control" name="follow_up[]">
                        <option value="">---SELECT---</option>
                        <option value="today">Today Evening</option>
                        <option value="tomorrow">Tomorrow</option>
                        <option value="After5Days">After 5 Days</option>
                        <option value="After10Days">After 10 Days</option>
                        <option value="After15Days">After 15 Days</option>
                        <option value="After30Days">After 30 Days</option>
                    </select> 
                </div> -->
                <div class="col-lg-5 col-xl-4"> 
                <input type="date" name="follow_up[]" class="form-control" >  
                </div>
            </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Item Description</b></label>
                    <a href="#" wire:click="increment" class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" aria-expanded="false">
                        <i class="flaticon2-plus"></i>Add Item
                    </a>
                </div>
                @for($i=0; $i<$count; $i++)
                    <table class="col-xl-12 col-lg-12 table table-striped" border="2">
                    <tr>
                    <th><label class="col-form-label"><b>Internal Dimension</b></label></th>
                    <td><label class="col-form-label"><b>Height</b></label></td>
                    <td><input type="number" name="i_d_height[]" class="form-control"  required></td>
                    <td><label class="col-form-label"><b>Width</b></label></td>
                    <td><input type="number" name="i_d_width[]" class="form-control" required></td>
                    <td><label class="col-form-label"><b>Depth</b></label></td>
                    <td><input type="number" name="i_d_depth[]" class="form-control" required></td>
                    </tr>
                    <tr>
                    <th><label class="col-form-label"><b>External Dimension</b></label></th>
                    <td><label class="col-form-label"><b>Height</b></label></td>
                    <td><input type="number" name="e_d_height[]" class="form-control"  required></td>
                    <td><label class="col-form-label"><b>Width</b></label></td>
                    <td><input type="number" name="e_d_width[]" class="form-control"  required></td>
                    <td><label class="col-form-label"><b>Depth</b></label></td>
                    <td><input type="number" name="e_d_depth[]" class="form-control"  required></td>
                    </tr>
                    <tr>
                    <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>HSN/SAC Code</b></label></td>
                    <td colspan="4"><input type="number" name="h_s_code[]" class="form-control" required></td>
                    </tr>
                    <tr>
                    <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Unit Price(INR)</b></label></td>
                    <td colspan="4"><input type="number" name="unit_price[]" class="form-control" required></td>
                    </tr>
                    <tr>
                    <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Quantity</b></label></td>
                    <td colspan="4"><input type="number" name="quantity[]" class="form-control"  required></td>
                    </tr>
                    <tr>
                    <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Total Price</b></label></td>
                    <td colspan="4"><input type="number" name="total_price[]" class="form-control" readonly></td>
                    </tr>
                    </table>    
                @endfor
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Technical Specification</b></label>
                    <a href="#" wire:click="increment1" class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" aria-expanded="false">
                                <i class="flaticon2-plus"></i>Add
                            </a>
                </div>
                @for($i=0; $i<$count1; $i++)
                <table class="col-xl-12 col-lg-12 table table-striped" border="2">
                <tr>
                    <th><label class="col-form-label"><b>Title</b></label></th>
                    <td><input type="text" name="title[]" class="form-control"  required></td>
                </tr>
                <tr>
                    <th><label class="col-form-label"><b>Description</b></label></th>
                    <td><textarea class="form-control" name="details[]"  required></textarea></td>
                </tr>
                </table>
                @endfor
                <div class="form-group row">            
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row">
                <div class="col-lg-3 col-xl-3">
                </div>
                <div class="col-lg-9 col-xl-9">
                    <button type="submit" class="btn btn-success">Update</button>&nbsp;
                    <a href="{{route('quotation.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

