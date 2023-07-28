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
                                                <input type="text"  name="quotation_no" value="{{old('quotation_no',isset($data->quotation_no)?$data->quotation_no:'')}}" id="quotation_no" class="form-control" placeholder="Quotation_No" readonly> 
                                            </div>
                                        </div>

                                        @foreach($data as $demo)
                                        <?php 
                                        $countfiles = count($demo->customer_name);?>
                                        <?php $i=0; ?>
                                        @for($j=0; $j<$countfiles; $j++)
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Customer Name</b></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="text" name="customer_name[]" value="{{old('customer_name',isset($demo->customer_name[$i])?$demo->customer_name[$i]:'')}}"  class="form-control" placeholder="New Customer" required></div>
                                        </div>
                                        <?php $i++; ?>
                                        @endfor
                                        @endforeach
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
                                                <option value="High" >High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>FollowUp On Quotation</b></label>
                                        <div class="col-lg-4 col-xl-4">  
                                            <select class="form-control" name="follow_up[]">
                                                <option value="">---SELECT---</option>
                                                <option value="today">Today Evening</option>
                                                <option value="tomorrow">Tomorrow</option>
                                                <option value="After5Days">After 5 Days</option>
                                                <option value="After10Days" >After 10 Days</option>
                                                <option value="After15Days" >After 15 Days</option>
                                                <option value="After30Days">After 30 Days</option>
                                            </select> 
                                        </div>
                                        <div class="col-lg-5 col-xl-4"> 
                                        <input type="text" name="follow_up[]" class="form-control" >  
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Item Description</b></label>
                                            <a href="#" wire:click="increment" class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" aria-expanded="false">
                                                        <i class="flaticon2-plus"></i>Add Item
                                                    </a>
                                        </div>
                                       
                                        @foreach($data1 as $demo1)
                                        <?php 
                                        $countfiles = count($demo1->i_d_height);?>
                                        <?php $i=0; ?>
                                        @for($j=0; $j<$countfiles; $j++)
                                            <table class="col-xl-12 col-lg-12 table table-striped" border="2">
                                            <tr>
                                            <th><label class="col-form-label"><b>Internal Dimension</b></label></th>
                                            <td><label class="col-form-label"><b>Height</b></label></td>
                                            <td><input type="number" value="{{old('i_d_height',isset($demo1->i_d_height[$i])?$demo1->i_d_height[$i]:'')}}" name="i_d_height[]" class="form-control"  required></td>
                                            <td><label class="col-form-label"><b>Width</b></label></td>
                                            <td><input type="number" value="{{old('i_d_width',isset($demo1->i_d_width[$i])?$demo1->i_d_width[$i]:'')}}" name="i_d_width[]" class="form-control" required></td>
                                            <td><label class="col-form-label"><b>Depth</b></label></td>
                                            <td><input type="number" value="{{old('i_d_depth',isset($demo1->i_d_depth[$i])?$demo1->i_d_depth[$i]:'')}}" name="i_d_depth[]" class="form-control" required></td>
                                            </tr>
                                            <tr>
                                            <th><label class="col-form-label"><b>External Dimension</b></label></th>
                                            <td><label class="col-form-label"><b>Height</b></label></td>
                                            <td><input type="number" value="{{old('e_d_height',isset($demo1->e_d_height[$i])?$demo1->e_d_height[$i]:'')}}" name="e_d_height[]" class="form-control"  required></td>
                                            <td><label class="col-form-label"><b>Width</b></label></td>
                                            <td><input type="number" value="{{old('e_d_width',isset($demo1->e_d_width[$i])?$demo1->e_d_width[$i]:'')}}" name="e_d_width[]" class="form-control"  required></td>
                                            <td><label class="col-form-label"><b>Depth</b></label></td>
                                            <td><input type="number" value="{{old('e_d_depth',isset($demo1->e_d_depth[$i])?$demo1->e_d_depth[$i]:'')}}" name="e_d_depth[]" class="form-control"  required></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>HSN/SAC Code</b></label></td>
                                            <td colspan="4"><input type="number" value="{{old('h_s_code',isset($demo1->h_s_code[$i])?$demo1->h_s_code[$i]:'')}}" name="h_s_code[]" class="form-control" required></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Unit Price(INR)</b></label></td>
                                            <td colspan="4"><input type="number" value="{{old('unit_price',isset($demo1->unit_price[$i])?$demo1->unit_price[$i]:'')}}" name="unit_price[]" class="form-control" required></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Quantity</b></label></td>
                                            <td colspan="4"><input type="number" value="{{old('quantity',isset($demo1->quantity[$i])?$demo1->quantity[$i]:'')}}" name="quantity[]" class="form-control"  required></td>
                                            </tr>
                                            <tr>
                                            <td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Total Price</b></label></td>
                                            <td colspan="4"><input type="number" value="{{old('total_price',isset($demo1->total_price[$i])?$demo1->total_price[$i]:'')}}" name="total_price[]" class="form-control" readonly></td>
                                            </tr>
                                        </table>
                                        <?php $i++; ?>
                                        @endfor    
                                        @endforeach
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Technical Specification</b></label>
                                            <a href="#" wire:click="increment" class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" aria-expanded="false">
                                                        <i class="flaticon2-plus"></i>Add Item
                                                    </a>
                                        </div>
                                        @foreach($data2 as $demo2)
                                        <?php 
                                        $countfiles = count($demo2->title);?>
                                        <?php $i=0; ?>
                                        @for($j=0; $j<$countfiles; $j++)
                                        <table class="col-xl-12 col-lg-12 table table-striped" border="2">
                                            <tr>
                                                <th><label class="col-form-label"><b>Title</b></label></th>
                                                <td><input type="text" name="title[]" value="{{old('title',isset($demo2->title[$i])?$demo2->title[$i]:'')}}" class="form-control"  required></td>
                                            </tr>
                                            <tr>
                                                <th><label class="col-form-label"><b>Description</b></label></th>
                                                <td><textarea class="form-control" name="details[]" 
                                                    required>{{old('details',isset($demo2->details[$i])?$demo2->details[$i]:'')}}</textarea></td>
                                            </tr>
                                        </table>
                                        <?php $i++; ?>
                                        @endfor
                                        @endforeach
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
