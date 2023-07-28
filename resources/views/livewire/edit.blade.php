
   
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