/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
         /*===================================++++++++++++++++  Auto Generate Row For Expense start+++++++++++++===================================================*/
         var i=$('.expenseTable tr').length;
           $(".addCF").on('click',function(){
                   html = '<tr class="spaceUnder">';
                   html += '<td><input class="case" type="checkbox"/></td>';
                   html += '<td style="width: 15%; padding-right: 10px;"><input type="text" class="form-control" required="true" id="expName_'+i+'" name="expenseName[]" placeholder="Enter Expense Name"></td>';
                   html += '<td style="width: 15%; padding-right: 10px;"><input type="text" class="form-control datepicker" required="true" id="expDate_'+i+'" name="expDate[]" placeholder="Enter Expense Date"></td>';
                   html += '<td style="width: 15%; padding-right: 10px;"><input type="number" class="form-control" required="true" id="expAmt_'+i+'"  name="expAmt[]" placeholder="Enter Expense Amount"></td>';
                   html += '<td style="width: 20%;"><textarea type="text" class="form-control" required="true" id="expDesc_'+i+'" name="expDesc[]" placeholder="Enter Expense Description"></textarea></td>';
                   html += '</tr>';
                   $('.expenseTable').append(html);
                   i++;
                   $('.datepicker').datepicker({format: "yyyy-mm-dd"}); 
           });

                //to check all checkboxes
                $(document).on('change','#check_all',function(){
                        $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
                });

                //deletes the selected table rows
                $(".delCF").on('click', function() {
                        $('.case:checkbox:checked').parents("tr").remove();
                        $('#check_all').prop("checked", false); 
        });

 /*===================================++++++++++++++++  Auto Generate Row For Expense end+++++++++++++===================================================*/
