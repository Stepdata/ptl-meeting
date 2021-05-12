<div class="footer"> 
	<div class="footer-inner">
		<div class="footer-content">

		</div>
	</div>
</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
                </div>
</div>     
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
                                <script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.sparkline.index.min.js"></script>
		<script src="assets/js/jquery.flot.min.js"></script>
		<script src="assets/js/jquery.flot.pie.min.js"></script>
		<script src="assets/js/jquery.flot.resize.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootbox.js"></script>
                                <!-- page specific plugin scripts -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/buttons.flash.min.js"></script>
		<script src="assets/js/buttons.html5.min.js"></script>
		<script src="assets/js/buttons.print.min.js"></script>
		<script src="assets/js/buttons.colVis.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<script src="assets/js/jquery.colorbox.min.js"></script>
		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		<!-- inline scripts related to this page -->        
        <script type="text/javascript" src="assets/fullcalendar-3.6.2/lib/moment.min.js"></script>
        <script type="text/javascript" src="assets/fullcalendar-3.6.2/fullcalendar.min.js"></script>
        <script type="text/javascript" src="assets/fullcalendar-3.6.2/locale/th.js"></script>
        <script type="text/javascript" src="assets/fullcalendar-3.6.2/script-3.6.2.js"></script> 
		<script src="assets/dist/js/bootstrap-datepicker-custom.js"></script>
		<script src="assets/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
        <!-- inline scripts related to this page -->
		<script type="text/javascript">
                                 $(document).ready(function () {
                                $('#dtBasicExample').DataTable();
                                $('.dataTables_length').addClass('bs-select');
                                });			
		</script>
		<script type="text/javascript">
			 $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            })
			$(".datepicker").each(function() {    
			$(this).datepicker('setDate', $(this).val());
});			//กำหนดเป็นวันปัจุบัน
        });
		</script>
		<script type="text/javascript">
			jQuery(function($) {
	var $overflow = '';
	var colorbox_params = {
		rel: 'colorbox',
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="ace-icon fa fa-arrow-left"></i>',
		next:'<i class="ace-icon fa fa-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'80%',
		maxHeight:'80%',
		onOpen:function(){
			$overflow = document.body.style.overflow;
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = $overflow;
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
	
	
	$(document).one('ajaxloadstart.page', function(e) {
		$('#colorbox, #cboxOverlay').remove();
   });
})
		</script>
		<script type="text/javascript">  
       var startDate = new Date('01/01/2009');
	   var FromEndDate = new Date();
	   var ToEndDate = new Date();

	   ToEndDate.setDate(ToEndDate.getDate()+365);

	   $('#startdatepicker').datepicker({
			format: 'yyyy-mm-dd',
			todayBtn: true,
    		startDate: '01/01/2009',
			//endDate: FromEndDate, 
			language: 'th',             
            thaiyear: true,
   	 		autoclose: true
	})
    .on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#enddatepicker').datepicker('setStartDate', startDate);
    }); 
		$('#enddatepicker').datepicker({
			format: 'yyyy-mm-dd',
			todayBtn: true,
        	startDate: startDate,
			endDate: ToEndDate,
			language: 'th',             
            thaiyear: true,
        	autoclose: true
    })
    .on('changeDate', function(selected){
        FromEndDate = new Date(selected.date.valueOf());
        FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
        $('#startdatepicker').datepicker('setEndDate', FromEndDate);
    });
    </script>  
	</body>
</html>

