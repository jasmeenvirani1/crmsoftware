<div>
    <form action="{{ route('quotation.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Name</b></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="name" value="{{old('name',isset($data->name)?$data->name:'')}}" id="name" class="form-control" placeholder="Customer Name" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Designation</b></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="designation" value="{{old('designation',isset($data->designation)?$data->designation:'')}}" id="designation" class="form-control" placeholder="Designation" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Phone</b></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="tel" name="phone" value="{{old('phone',isset($data->phone)?$data->phone:'')}}" id="phone" class="form-control" placeholder="Phone" pattern="[0-9]{3}[0-9]{4}[0-9]{3}" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Email Id</b></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="email" name="email" value="{{old('email',isset($data->email)?$data->email:'')}}" id="email" class="form-control" placeholder="abc@gmail.com" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="card-body">
                                            <table class="table" id="products_table">
                                                <thead>
                                                <tr>
                                                    <th>Attribute Name</th>
                                                    <th>Attribute Value</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- @foreach ($orderProducts as $index => $orderProduct) -->
                                                    <tr>
                                                        <td>
                                                            <input type="text"
                                                                   name="orderProducts[{{$index}}][quantity]"
                                                                   class="form-control"
                                                                   wire:model="orderProducts.{{$index}}.quantity" />
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   name="orderProducts[{{$index}}][quantity]"
                                                                   class="form-control"
                                                                   wire:model="orderProducts.{{$index}}.quantity" />
                                                        </td>
                                                        <td>
                                                            <a href="#" wire:click.prevent="removeProduct({{$index}})">Delete</a>
                                                        </td>
                                                    </tr>
                                                <!-- @endforeach -->
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-sm btn-secondary"
                                                        wire:click.prevent="addProduct">+ Add Another Product</button>
                                                </div>
                                            </div>
                                        </div>                     
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
                                            <button type="submit" class="btn btn-success">{{$btn}}</button>&nbsp;
                                            <a href="{{route('quotation.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
</div>
