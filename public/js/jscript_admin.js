$(document).ready(function() {
	$(".validate").validate();
	$(".focus").focus();
    $('#IMAGES').change(function(){
        $('#IMAGES_VALUE').attr('src',$(this).val());
    });
    $('.onlyNumbers').priceFormat({
        prefix: '',//VNĐ 
        suffix: '',//VNĐ 
        centsSeparator: '.',
        thousandsSeparator: '.',
        limit: 12,
        centsLimit: 3
    });
});
function checkForm(){
    $('.onlyNumbers').each(function(){
        value = $(this).val();
        value = value.replace(".", "");
        value = value.replace(" VNĐ", "");
        
        $(this).val(value);
    });
}
$(function() {
	$(".datepicker").datepicker({
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true,
		yearRange: "1970:2012",
		monthNamesShort: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"]
	});
	$(".datepicker-2").datepicker({
	   showButtonPanel: true,
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true,
		yearRange: "2012:2022",
		monthNamesShort: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"]
	});
	$(".datepicker-3").datetimepicker({
	    showButtonPanel: true,
		dateFormat: "dd/mm/yy",
    	showSecond: true,
    	timeFormat: 'HH:mm:ss',
		changeMonth: true,
		changeYear: true,
		yearRange: "2012:2022",
		monthNamesShort: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"]
	});
});