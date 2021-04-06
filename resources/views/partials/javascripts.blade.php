<script src="{{ url('adminlte/js') }}/jquery.min.js"></script>
<script src="{{ url('adminlte/js') }}/dataTables.min.js"></script>
<script src="{{ url('adminlte/js') }}/dataTables.buttons.min.js"></script>
<script src="{{ url('adminlte/js') }}/buttons.flash.min.js"></script>
<script src="{{ url('adminlte/js') }}/jszip.min.js"></script>
<script src="{{ url('adminlte/js') }}/pdfmake.min.js"></script>
<script src="{{ url('adminlte/js') }}/vfs_fonts.js"></script>
<script src="{{ url('adminlte/js') }}/buttons.html5.min.js"></script>
<script src="{{ url('adminlte/js') }}/buttons.print.min.js"></script>
<script src="{{ url('adminlte/js') }}/buttons.colVis.min.js"></script>
<script src="{{ url('adminlte/js') }}/dataTables.select.min.js"></script>
<script src="{{ url('adminlte/js') }}/jquery-ui.min.js"></script>
<script src="{{ url('adminlte/js') }}/bootstrap.min.js"></script>
<script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
<script src="{{ url('adminlte/js') }}/main.js"></script>
<script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>

<script>
    window._token = '{{ csrf_token() }}';
</script>

<script type="text/javascript">
	$(function(){
		$(".datepicker").datepicker({
		  dateFormat: 'yy-mm-dd',
		  autoclose: true,
		  todayHighlight: true,
		});
	});
</script>

<script type="text/javascript">
  	$(document).ready(function() {
    	$('.table').dataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": true,
	      "info": true,
	      "autoWidth": true,
	      "bDestroy": true,
	      "columnDefs": [{
  		    	"defaultContent": "-",
  		    	"targets": "_all"
  		  }]
	    });
	});
</script>

<script type="text/javascript">
  	$(document).ready(function() {
    	$('.dynamic').change(function(){
    		if($(this).val() != ''){
    			var select = $(this).attr("id");
    			var value = $(this).val();
    			var dependent = $(this).data('dependent');
    			var _token = $('input[name="_token"]').val();
    			$.ajax({
    				url:"{{ route('dev.applicationscontroller.fetch') }}",
    				method:"POST",
    				data:{select:select, value:value, _token:_token, dependent:dependent},
    				success:function(result)
    				{
    					$('#'+dependent).html(result);
    				}
    			})
    		}
    	});
	});
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('.dynamics').change(function(){
        if($(this).val() != ''){
          var select = $(this).attr("id");
          var value = $(this).val();
          var dependent = $(this).data('dependent');
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url:"{{ route('ba.bapocontroller.fetch') }}",
            method:"POST",
            data:{select:select, value:value, _token:_token, dependent:dependent},
            success:function(result)
            {
              $('#'+dependent).html(result);
            }
          })
        }
      });
  });
</script>

<script type="text/javascript">  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var employee_id = $(this).attr("id");  
           var _token = $('input[name="_token"]').val();
           $.ajax({  
                url:"{{ route('dev.applicationscontroller.serverprod') }}",
                method:"post",  
                data:{employee_id:employee_id, _token:_token},  
                success:function(data){  
                     $('#serverDetail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      });  
 });  
</script>


<script type="text/javascript">
  
  function isRenualFunction() {

    var e = document.getElementById("isRenual");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("license_expired_date").disabled = false;
    }else if(val == "NO"){
      document.getElementById('license_expired_date').disabled = true;
    }

  }

</script>

<script type="text/javascript">

  function isPKSfunction() {

    var e = document.getElementById("isPKS");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("pks_id").disabled = false;
    }else if(val == "NO"){
      document.getElementById('pks_id').disabled = true;
    }

  }

  function isPaymentFunction() {

    var e = document.getElementById("isPayment");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("payment_date").disabled = false;
    }else if(val == "NO"){
      document.getElementById('payment_date').disabled = true;
    }

  }

  function isPaymentTypeFunction() {

    var e = document.getElementById("payment_type");
    var val = e.options[e.selectedIndex].value;

    if(val == "Full Payment"){
      document.getElementById("isPayment1").disabled = true;
      document.getElementById("isPayment2").disabled = true;
      document.getElementById("isPayment3").disabled = true;
      document.getElementById("isPayment4").disabled = true;
      document.getElementById("isPayment5").disabled = true;
      document.getElementById("payment_date_1").disabled = true;
      document.getElementById("payment_date_2").disabled = true;
      document.getElementById("payment_date_3").disabled = true;
      document.getElementById("payment_date_4").disabled = true;
      document.getElementById("payment_date_5").disabled = true;
      document.getElementById("isPayment").disabled = false;
      document.getElementById("payment_date").disabled = false;
    }else if(val == "Down Payment"){
      document.getElementById("isPayment1").disabled = false;
      document.getElementById("isPayment2").disabled = false;
      document.getElementById("isPayment3").disabled = false;
      document.getElementById("isPayment4").disabled = false;
      document.getElementById("isPayment5").disabled = false;
      document.getElementById("payment_date_1").disabled = false;
      document.getElementById("payment_date_2").disabled = false;
      document.getElementById("payment_date_3").disabled = false;
      document.getElementById("payment_date_4").disabled = false;
      document.getElementById("payment_date_5").disabled = false;
      document.getElementById("isPayment").disabled = true;
      document.getElementById("payment_date").disabled = true;
    }

  }

  function isGAfunction(){

    var e = document.getElementById("isGA");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){

      document.getElementById('p_date_1').disabled = true;
      document.getElementById('p_date_2').disabled = true;
      document.getElementById('p_date_3').disabled = true;
      document.getElementById('p_date_4').disabled = true;
      document.getElementById('p_date_5').disabled = true;
      document.getElementById('nominal_1').disabled = true;
      document.getElementById('nominal_2').disabled = true;
      document.getElementById('nominal_3').disabled = true;
      document.getElementById('nominal_4').disabled = true;
      document.getElementById('nominal_5').disabled = true;
      document.getElementById('note_1').disabled = true;
      document.getElementById('note_2').disabled = true;
      document.getElementById('note_3').disabled = true;
      document.getElementById('note_4').disabled = true;
      document.getElementById('note_5').disabled = true;
      document.getElementById('bill_no').disabled =   true;
      document.getElementById('bill_no_1').disabled =   true;
      document.getElementById('bill_no_2').disabled =   true;
      document.getElementById('bill_no_3').disabled =   true;
      document.getElementById('bill_no_4').disabled =   true;
      document.getElementById('bill_no_5').disabled =   true;
      document.getElementById('bill_date').disabled = true;
      document.getElementById('bill_date_1').disabled = true;
      document.getElementById('bill_date_2').disabled = true;
      document.getElementById('bill_date_3').disabled = true;
      document.getElementById('bill_date_4').disabled = true;
      document.getElementById('bill_date_5').disabled = true;
      document.getElementById('payment_type').disabled = true;
      document.getElementById('isPayment').disabled =   true;
      document.getElementById('payment_date').disabled = true;

    }else{

      document.getElementById('p_date_1').disabled =  false;
      document.getElementById('p_date_2').disabled =  false;
      document.getElementById('p_date_3').disabled =  false;
      document.getElementById('p_date_4').disabled =  false;
      document.getElementById('p_date_5').disabled =  false;
      document.getElementById('nominal_1').disabled = false;
      document.getElementById('nominal_2').disabled = false;
      document.getElementById('nominal_3').disabled = false;
      document.getElementById('nominal_4').disabled = false;
      document.getElementById('nominal_5').disabled = false;
      document.getElementById('note_1').disabled =    false;
      document.getElementById('note_2').disabled =    false;
      document.getElementById('note_3').disabled =    false;
      document.getElementById('note_4').disabled =    false;
      document.getElementById('note_5').disabled =    false;
      document.getElementById('bill_no').disabled =   false;
      document.getElementById('bill_no_1').disabled =   false;
      document.getElementById('bill_no_2').disabled =   false;
      document.getElementById('bill_no_3').disabled =   false;
      document.getElementById('bill_no_4').disabled =   false;
      document.getElementById('bill_no_5').disabled =   false;
      document.getElementById('bill_date').disabled = false;
      document.getElementById('bill_date_1').disabled = false;
      document.getElementById('bill_date_2').disabled = false;
      document.getElementById('bill_date_3').disabled = false;
      document.getElementById('bill_date_4').disabled = false;
      document.getElementById('bill_date_5').disabled = false;
      document.getElementById('payment_type').disabled = false;
      document.getElementById('isPayment').disabled =   false;
      document.getElementById('payment_date').disabled = false;
    }

  }

  function isPaymentBillFunction() {

    var e = document.getElementById("isPayment");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("payment_date").disabled = false;
    }else if(val == "NO"){
      document.getElementById('payment_date').disabled = true;
    }

  }

  function isPaymentTypeBillFunction() {

    var e = document.getElementById("payment_type");
    var val = e.options[e.selectedIndex].value;

    if(val == "Full Payment"){
      document.getElementById('p_date_1').disabled = true;
      document.getElementById('p_date_2').disabled = true;
      document.getElementById('p_date_3').disabled = true;
      document.getElementById('p_date_4').disabled = true;
      document.getElementById('p_date_5').disabled = true;
      document.getElementById('nominal_1').disabled = true;
      document.getElementById('nominal_2').disabled = true;
      document.getElementById('nominal_3').disabled = true;
      document.getElementById('nominal_4').disabled = true;
      document.getElementById('nominal_5').disabled = true;
      document.getElementById('note_1').disabled = true;
      document.getElementById('note_2').disabled = true;
      document.getElementById('note_3').disabled = true;
      document.getElementById('note_4').disabled = true;
      document.getElementById('note_5').disabled = true;
      document.getElementById('bill_no_1').disabled =   true;
      document.getElementById('bill_no_2').disabled =   true;
      document.getElementById('bill_no_3').disabled =   true;
      document.getElementById('bill_no_4').disabled =   true;
      document.getElementById('bill_no_5').disabled =   true;
      document.getElementById('bill_date_1').disabled = true;
      document.getElementById('bill_date_2').disabled = true;
      document.getElementById('bill_date_3').disabled = true;
      document.getElementById('bill_date_4').disabled = true;
      document.getElementById('bill_date_5').disabled = true;
      document.getElementById('isPayment').disabled =   false;
      document.getElementById('payment_date').disabled = false;
    }else if(val == "Down Payment"){
      document.getElementById('p_date_1').disabled =  false;
      document.getElementById('p_date_2').disabled =  false;
      document.getElementById('p_date_3').disabled =  false;
      document.getElementById('p_date_4').disabled =  false;
      document.getElementById('p_date_5').disabled =  false;
      document.getElementById('nominal_1').disabled = false;
      document.getElementById('nominal_2').disabled = false;
      document.getElementById('nominal_3').disabled = false;
      document.getElementById('nominal_4').disabled = false;
      document.getElementById('nominal_5').disabled = false;
      document.getElementById('note_1').disabled =    false;
      document.getElementById('note_2').disabled =    false;
      document.getElementById('note_3').disabled =    false;
      document.getElementById('note_4').disabled =    false;
      document.getElementById('note_5').disabled =    false;
      document.getElementById('bill_no_1').disabled =   false;
      document.getElementById('bill_no_2').disabled =   false;
      document.getElementById('bill_no_3').disabled =   false;
      document.getElementById('bill_no_4').disabled =   false;
      document.getElementById('bill_no_5').disabled =   false;
      document.getElementById('bill_date_1').disabled = false;
      document.getElementById('bill_date_2').disabled = false;
      document.getElementById('bill_date_3').disabled = false;
      document.getElementById('bill_date_4').disabled = false;
      document.getElementById('bill_date_5').disabled = false;
      document.getElementById('isPayment').disabled =   true;
      document.getElementById('payment_date').disabled = true;
      document.getElementById('bill_no').disabled =   true;
      document.getElementById('bill_date').disabled =   true;
    }

  }

  function isPayment1Function() {

    var e = document.getElementById("isPayment1");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("payment_date_1").disabled = false;
    }else if(val == "NO"){
      document.getElementById('payment_date_1').disabled = true;
    }

  }

  function isPayment2Function() {

    var e = document.getElementById("isPayment2");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("payment_date_2").disabled = false;
    }else if(val == "NO"){
      document.getElementById('payment_date_2').disabled = true;
    }

  }

  function isPayment3Function() {

    var e = document.getElementById("isPayment3");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("payment_date_3").disabled = false;
    }else if(val == "NO"){
      document.getElementById('payment_date_3').disabled = true;
    }

  }

  function isPayment4Function() {

    var e = document.getElementById("isPayment4");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("payment_date_4").disabled = false;
    }else if(val == "NO"){
      document.getElementById('payment_date_4').disabled = true;
    }

  }

  function isPayment5Function() {

    var e = document.getElementById("isPayment5");
    var val = e.options[e.selectedIndex].value;

    if(val == "YES"){
      document.getElementById("payment_date_5").disabled = false;
    }else if(val == "NO"){
      document.getElementById('payment_date_5').disabled = true;
    }

  }  

</script>

<script type="text/javascript">  

  function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
  }

</script>


@yield('javascript')