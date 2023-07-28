@extends('layouts.admin')
@section('content')
<style type="text/css">
@media print {
    #downloadPdf {
    display: none;
  }
}
/*table, th, td {*/
            /*border: 1px solid black;*/
            /*border-collapse: collapse;*/
                /*margin-top: 35px;*/
           /* padding: 6px;
            margin-top: 75px;*/
        /*}*/
        .my-border
        {
        	border: none !important;

        }
        .g-f>span
        {
        	line-height: 26px;
        }
        .row-border
        {
        	border-top: 2px solid #3f48cc;
        	border-bottom: 2px solid #f5b58c;
        	margin: 27px;
            padding: 12px;
        }
        .head-text >p>b
        {
        	font-size: 19px;
            color: black;
        }
        .g-f>input
        {
        	width: 90px;
        }
        
       </style>

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('dashboard')}}" class="kt-subheader__breadcrumbs-link">
                        Dashboard </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{url('admin/purchase')}}" class="kt-subheader__breadcrumbs-link">
                        </a>               
                </div>
            </div>         
        </div>
    </div>
    <!-- <div class="row">
    <div class="col-lg-4 col-xl-4"></div>
    <div class="col-lg-4 col-xl-4">
    </div>
    <div class="col-lg-4 col-xl-4"><button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button></div>
    </div> -->
     @foreach($data1 as $dt)
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="container">
  	<div class="kt-portlet kt-portlet--mobile">
        @include('errormessage')
        <div class="container">
        	<div class="row row-border">
        		<div class="col">
        			@foreach($organization as $dt2) 
                    <img style="width: 200px; height: 65px;" src="{{asset('images/'.$dt2->logo)}}" alt="" />
                    @endforeach
        		</div>
        		<div class="col text-right g-f">
        			@foreach($organization as $dt1)
                    <div class="d-flex flex-column flex-root">
                    <span class="opacity-91"><b>{{$dt1->organization_name}}</b></span>
                    <span class="opacity-91">{{$dt1->full_address}}</span>
                    <span class="opacity-91">Conatct No:+91 {{$dt1->contact_no[0]}},{{$dt1->contact_no[1]}}</span>
                    <span class="opacity-91">Email:{{$dt1->email[0]}}</span>
                    <span class="opacity-91">Website:{{$dt1->website}}</span>
                    <span class="opacity-91">GST No.:{{$dt1->gst_no}}</span>
                    </div>
                    @endforeach
        		</div>
        	</div>
	<div class="text-center head-text">
		<p><b>{{$dt->product_name}}</b> </p>
	</div>
	<div class="row">
		<div class="col" style="margin-left: 27px;">
			<p style="margin-bottom: 2px;"><b>{{$data['customer']->name}}</b></p>
            <p style="margin-bottom: 2px;">Company Details: {{$data['customer']->company_name}}</p>
            <p style="margin-bottom: 2px;">{{$data['customer']->company_address}}</p>
            <p style="margin-bottom: 2px;">Phone: {{$data['customer']->phone}}</p>
            <p style="margin-bottom: 2px;">Email: {{$data['customer']->email}}</p>
            <p style="margin-bottom: 2px;">GST No.: {{$data['customer']->gst_no}}</p>
            <p style="margin-bottom: 2px;">PAN No.: {{$data['customer']->pan_no}}</p>
		</div>
		<div class="col text-right g-f" style="margin-left: 550px; margin-right: 27px; ">
            <table class="table" border="2"><tr><th>Qtn. No. :</th><td>{{$data->quotation_of}}</td></tr><tr><th>Date:</th><td>{{date("d-m-Y")}}</td></tr></table>
		</div>
	</div>
    <div class="row justify-content-center py-8 px-8 py-md-0 px-md-0">
        <div class="col-md-10">
            <div class="table-responsive">
            <table class="table" border="2">
            <tr class="text-center">
                <th colspan="6">Description</th>
                <th>Remark</th>
                <th>HSNCode</th>
                <th>UnitPrice<br>(INR)</th>
                <th>Qty.</th>
                <th>TotalPrice<br>(INR)</th>
            </tr>
            <tr>
                <th colspan="6">{{$dt->product_name}}</th>
                <th rowspan="3"></th>
                <th rowspan="3"></th>
                <th rowspan="3"></th>
                <th rowspan="3"></th>
                <th rowspan="3"></th>
             </tr>
             <tr class="text-center">
                <th colspan="3">Internal Dimension</th>
                <th colspan="3">Internal Dimension</th>
            </tr>
            <tr>
                <th>Width</th>
                <th>Depth</th>
                <th>Height</th>
                <th>Width</th>
                <th>Depth</th>
                <th>Height</th>
            </tr>
            <?php $a = count($dt->i_d_height);?>
            <?php $i=0; ?>
            @for($j=0; $j<$a; $j++)
            <tr>
                <td>{{$dt->i_d_width[$i]}}</td>
                <td>{{$dt->i_d_depth[$i]}}</td>
                <td>{{$dt->i_d_height[$i]}}</td>
                <td>{{$dt->e_d_width[$i]}}</td>
                <td>{{$dt->e_d_depth[$i]}}</td>
                <td>{{$dt->e_d_height[$i]}}</td>
                <td>{{$dt->remark[$i]}}</td>
                <td>{{$dt->h_s_code[$i]}}</td>
                <td>{{$dt->unit_price[$i]}}</td>
                <td>{{$dt->quantity[$i]}}</td>
                <td>{{$dt->total_price[$i]}}</td>
            </tr>
            <?php $i++; ?>
            @endfor  
            <!-- <tr>
                <th colspan="6" style="color: red;">For 1 Year, Comprehensive Replacement of Controller and it's parts (Magnets,<br>
                 Display, Connection Cables) in case of any Fault or Damage.</th>
                <th rowspan="2"></th>
                <th rowspan="2"></th>
                <th rowspan="2"></th>
                <th rowspan="2"></th>
                <th rowspan="2"></th>
             </tr> -->
            <tr class="my-border">
                <td colspan="6">
                    <h5><b>Technical Specification</b></h5>
                    <ol>
                        <?php $a = count($dt['tech_specification']->title);?>
                        <?php $i=0; ?>
                        @for($j=0; $j<$a; $j++)
                        <li><b>{{$dt['tech_specification']->title[$i]}}</b>
                            <p>{{$dt['tech_specification']->details[$i]}}</p>
                        </li>
                        <?php $i++; ?>
                        @endfor
                    </ol>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="my-border ">
                <td colspan="10" class="text-right">
                 Total Basic Amount :
                </td>
                <td>Rs.{{ array_sum($dt->total_price)}}</td>
            </tr>
            <tr class="my-border ">
                <td colspan="10" class="text-right">
                 GST 18% :
                </td>
                <?php 
                $a = array_sum($dt->total_price);
                $b = ($a*18)/100;
                $c = ($a + $b);
                ?>
                <td>Rs.{{$b}} </td>
            </tr>
            <tr class="my-border ">
                <td colspan="10" class="text-right">
                <b>Total Amount :</b>
                </td>
                <td>Rs.{{$c}}</td>
            </tr>
         </table>
     </div>
        </div>
    </div>
</div>
</div>
</div>
<p class="add"></p>
@endforeach
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="container">
    <div class="kt-portlet kt-portlet--mobile">
        @include('errormessage')
<div class="container">
    <div class="row row-border">
        <div class="col">
            @foreach($organization as $dt2) 
            <img style="width: 200px; height: 65px;" src="{{asset('images/'.$dt2->logo)}}" alt="" />
            @endforeach
        </div>
        <div class="col text-right g-f">
            @foreach($organization as $dt1)
            <div class="d-flex flex-column flex-root">
            <span class="opacity-91"><b>{{$dt1->organization_name}}</b></span>
            <span class="opacity-91">{{$dt1->full_address}}</span>
            <span class="opacity-91">Conatct No:+91 {{$dt1->contact_no[0]}},{{$dt1->contact_no[1]}}</span>
            <span class="opacity-91">Email:{{$dt1->email[0]}}</span>
            <span class="opacity-91">Website:{{$dt1->website}}</span>
            <span class="opacity-91">GST No.:{{$dt1->gst_no}}</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="text-center head-text">
        <p><b>Terms & Condition</b> </p>
    </div>
    <div class="row justify-content-center py-8 px-8 py-md-0 px-md-0">
        <ol>
        @foreach($term as $terms)
        <li><b>{{$terms->title}}</b>
            <p>{{$terms->description}}</p>
        </li>
        @endforeach
        </ol>
    </div>
</div>
</div>
</div>
<div class="row">
    <div class="col-lg-4 col-xl-4"></div>
    <div class="col-lg-4 col-xl-4"><label class="col-form-label" style="font-size: 15px;"><b>Prepared By: {{$data->prepared_by}}</b></label>
    </div>
    <div class="col-lg-4 col-xl-4"></div>
</div>
<div class="row">
    <div class="col-lg-4 col-xl-4"></div>
    <div class="col-lg-4 col-xl-4">
    <button type="button" class="btn btn-primary font-weight-bold" id="downloadPdf" onclick="window.print();">Print Invoice</button></div>
    <div class="col-lg-4 col-xl-4"></div>
</div>



@endsection
@section('script')
<script src="{{url('assets/admin/js/pages/purchase.js')}}" type="text/javascript"></script>
@endsection


