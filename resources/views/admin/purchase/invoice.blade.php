@extends('layouts.admin')
@section('content')
<style type="text/css">
@media print {
  #print {
    display: none;
  }
  #print1 {
    display: none;
  }
  @page{
  	margin: 0;
  }
  .kt-header__topbar{
  	display: none;
  }
  #kt_header_mobile{
  	display: none;
  }
  #kt_footer{
    display: none;
  }
  #kt_scrolltop{
    display: none;
  }
  #kt_subheader{
  	display: none;
  }
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
                    <a href="{{url('admin/purchase/invoice')}}" class="kt-subheader__breadcrumbs-link">
                        Invoice</a>               
                </div>
            </div>         
        </div>
    </div>
    <!-- begin:: Content -->
   <div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!-- begin::Card-->
								<div class="card card-custom overflow-hidden">
									<div class="card-body p-0">
										<!-- begin: Invoice-->
										<!-- begin: Invoice header-->
										<div class="row justify-content-center py-8 px-8 py-md-0 px-md-0">
											<div class="col-md-10">
												<div class="d-flex justify-content-between pb-10 pb-md-0 flex-column flex-md-row">
													<div class="col-xl-4 col-lg-4 d-flex flex-column align-items-md-start px-0">
														<!--begin::Logo-->
														<!-- <a href="#" class="mb-5"> -->
															@foreach($data1 as $dt2)	
															<img style="width: 200px; height: 65px;" src="{{asset('images/'.$dt2->logo)}}" alt="" />
															@endforeach
														<!-- </a> -->
														
														<!--end::Logo-->
													</div>
													<div class="col-xl-5 col-lg-5 d-flex flex-column align-items-md-end px-0">
														@foreach($data1 as $dt1)
														<div class="d-flex flex-column flex-root">
														<span class="opacity-91"><b>{{$dt1->organization_name}}</b></span>
														<span class="opacity-91">{{$dt1->full_address}}</span>
														<span class="opacity-91">Conatct No:+91 {{$dt1->contact_no[0]}},{{$dt1->contact_no[1]}}</span>
														<span class="opacity-91">Email:{{$dt1->email_id}}</span>
														<span class="opacity-91">Website:{{$dt1->website}}</span>
														<span class="opacity-91">GST No.:{{$dt1->gst_no}}</span>
														</div>
														@endforeach
													</div>
												</div>
												<div class="border-bottom w-100"></div>
												<h1 class="display-4 font-weight-boldest mb-10" style="text-align: center;">PURCHASE ORDER</h1>
													<table class="table" border="2" style="width:25%; margin-left: auto;"><tr><th>Date:</th><td>{{date("d-m-Y")}}</td></tr><tr><th>PO No:</th><td>{{$data->po_no}}</td></tr></table>
												<div class="d-flex justify-content-between pt-6">
													@foreach($data2 as $dt)
													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2">VENDOR</span>
														<span class="opacity-91">{{$dt->vendor_company_name}}</span>
														<span class="opacity-91">{{$dt->vendor_company_address}}</span>
														<span class="opacity-91">Conatct No:+91 {{$dt->vendor_contact_no}} Mr.{{$dt->vendor_name}}</span>														
													</div>
													@endforeach
													<!-- <div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2">INVOICE NO.</span>
														<span class="opacity-70">{{$data->lpm_no}}</span>
													</div> -->
													<div class="d-flex flex-column flex-root" style="text-align:right;">
														<span class="font-weight-bolder mb-2">SHIP TO</span>
														<span class="opacity-91">{{$data->ship_to}}</span>
													</div>
												</div>
											</div>
										</div>
										<!-- end: Invoice header-->
										<!-- begin: Invoice body-->
										<div class="row justify-content-center py-8 px-8 py-md-0 px-md-0">
											<div class="col-md-10">
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th class="pl-0 font-weight-bold text-muted text-uppercase">Product Name</th>
																<th class="pl-0 font-weight-bold text-muted text-uppercase text-right">Quantity</th>
																<th class="pl-0 font-weight-bold text-muted text-uppercase text-right">Unit Price</th>
																<th class="pl-0 font-weight-bold text-muted text-uppercase text-right">Total Price</th>
																
															</tr>
														</thead>
														<tbody>														
	                                                             <?php 
                                                                  $countfiles = count($data->product_name);?>
                                                                  <?php $i=0; ?>
                                                                  @for($j=0; $j<$countfiles; $j++)
                                                                      <tr class="font-weight-boldest border-bottom-0">
                                                                         <td class="pl-0 pt-0">{{$data->product_name[$i]}}</td>
                                                                         <td class="pl-0 pt-0 text-right">{{$data->quantity[$i]}}</td>
                                                                         <td class="pl-0 pt-0 text-right">{{$data->unit_price[$i]}}</td>
                                                                         <td class="text-danger  pr-0 py-0 text-right">₹ {{$data->total_price[$i]}}</td>
                                                                      </tr>
                                                                  <?php $i++; ?>
                                                                  @endfor
                                                                  <tr class="font-weight-boldest border-bottom-0">
                                                                  		<td colspan="2"></td>
                                                                  		<td class="pl-0 pt-0 text-right">SUB TOTAL</td>
                                                                  		<td class="text-danger  pr-0 py-0 text-right">₹ {{ array_sum($data->total_price)}}</td>
                                                                  </tr>
                                                                  <tr class="font-weight-boldest border-bottom-0">
                                                                  		<td colspan="2"></td>
                                                                  		<td class="pl-0 pt-0 text-right">CGST</td>
                                                                  		<?php 
                                                                  		// dd($data3);
                                                                  		$a = array_sum($data->total_price);
                                                                  		$b = $data3[0]->cgst;
                                                                  		$c = ($a*$b)/100;
                                                                  		$d = ($a + $c);
                                                                  		?>
                                                                  		<td class="text-danger  pr-0 py-0 text-right">₹ {{$c}}</td>
                                                                  </tr>
                                                                  <tr class="font-weight-boldest border-bottom-0">
                                                                  		<td colspan="2"></td>
                                                                  		<td class="pl-0 pt-0 text-right">SGST</td>
                                                                  		<?php 
                                                                  		// dd($data3);
                                                                  		$a = array_sum($data->total_price);
                                                                  		$b = $data3[0]->sgst;
                                                                  		$c = ($a*$b)/100;
                                                                  		$d = ($a + $c);
                                                                  		?>
                                                                  		<td class="text-danger  pr-0 py-0 text-right">₹ {{$c}}</td>
                                                                  </tr>
                                                                  <!-- <tr class="font-weight-boldest border-bottom-0">
                                                                  		<td colspan="2"></td>
                                                                  		<td class="pl-0 pt-0 text-right">SHIPPING</td>
                                                                  		<td class="text-danger  pr-0 py-0 text-right">₹00.00</td>
                                                                  </tr> -->
                                                                  <tr class="font-weight-boldest border-bottom-0">
                                                                  		<td colspan="2"></td>
                                                                  		<td class="pl-0 pt-0 text-right">OTHER</td>
                                                                  		<td class="text-danger  pr-0 py-0 text-right">₹00.00</td>
                                                                  </tr>
                                                                  <tr class="font-weight-boldest border-bottom-0"></tr>
                                                                  <tr class="font-weight-boldest border-bottom-0">
                                                                  	<td colspan="2"></td>
                                                                  		<td class="pl-0 pt-0 text-right">TOTAL AMOUNT</td>
                                                                  		<?php 
                                                                  		// dd($data3);
                                                                  		$a = array_sum($data->total_price);
                                                                  		$b = $data3[0]->cgst;
                                                                  		$c = $data3[0]->sgst;
                                                                  		$d = ($a*$b)/100;
                                                                  		$e = ($a*$c)/100;
                                                                  		$f = ($a + $d + $e);
                                                                  		?>
                                                                  		<td class="text-danger  pr-0 py-0 text-right">₹ {{$f}}</td>
                                                                  </tr>	
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- end: Invoice body-->
										<!-- begin: Invoice footer-->
										<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
											<div class="col-md-10">
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th class="font-weight-bold text-muted text-uppercase">Payment Type</th>
																<th class="font-weight-bold text-muted text-uppercase">Expected Delivery DATE</th>
															</tr>
														</thead>
														<tbody>
															<tr class="font-weight-bolder">
																<td>{{$data->payment_terms}}</td>
																<td>{{date('d-m-Y', strtotime($data->delivery_date));}}</td>
															</tr>
															<tr>
																<th class="font-weight-bold text-muted text-uppercase">Comments</th>
																<td class="font-weight-bolder" colspan="2">{{$data->comments}}</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0 new-class">
											<div class="col-md-10">
												<!-- <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
													
												</div> -->
												
												<div class="border-bottom w-100"></div>
												<div class="d-flex justify-content-between pt-6">
													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2"><b>Prepared By : </b>{{$data->prepared_by}}</span>												
													</div>
													<!-- <div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2">INVOICE NO.</span>
														<span class="opacity-70">{{$data->lpm_no}}</span>
													</div> -->
													<div class="d-flex flex-column flex-root">
														<span class="font-weight-bolder mb-2"><b>Approved By : </b>{{$data->approved_by}}</span>
														<span class="opacity-70"></span>
													</div>
												</div>
											</div>
										</div>
										<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0 new-class">
											<div class="col-md-10">
												<div class="d-flex justify-content-between pt-6">
													<div class="d-flex flex-column flex-root">
														<center><span class="font-weight-bolder mb-2"><b>If you have any questions about this purchase order, please contact Mr. Hemang Parmar</b></span></center><center>
														<span class="font-weight-bolder mb-2"><b>Contact: +91 75671 38386; +91 99040 38386 | Email : purchase@laxmipharmamach.com</b></span></center>
													</div>	
												</div>
											</div>
										</div>

										<!-- end: Invoice footer-->
										<!-- begin: Invoice action-->
										<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
											<div class="col-md-10">
												<div class="d-flex justify-content-between">
													<button type="button" id="print" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
													<button type="button" id="print1" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>
												</div>
											</div>
										</div>
										<!-- end: Invoice action-->

										
										<!-- end: Invoice-->
									</div>
								</div>
								<!-- end::Card-->
							</div>
							
							<!--end::Container-->
						</div>
    <!-- end:: Content -->



@endsection
@section('script')
<script src="{{url('assets/admin/js/pages/purchase.js')}}" type="text/javascript"></script>
@endsection


