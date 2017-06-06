<link rel="stylesheet" href="/assets/bootstrap-datetimepicker/css/datetimepicker.css">
<link rel="stylesheet" href="/assets/bootstrap-datepicker/css/datepicker.css">
<script src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="/assets/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js"  charset="UTF-8"  type="text/javascript" ></script>
<script src="/assets/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"  charset="UTF-8"  type="text/javascript" ></script>
<script>
    $('[data-role*=date-picker]').datepicker({
        language:'zh-CN',
        format: 'yyyy-mm-dd',
        autoclose: true,
    });
    $("[data-role=datetime-picker]").datetimepicker({
        language:'zh-CN',
        format: 'yyyy-mm-dd hh:ii',
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });
    $("[data-role=year-picker]").datetimepicker({
        language:'zh-CN',
        startView: 'decade',
        minView: 'decade',
        format: 'yyyy',
        autoclose: true,
        maxView: 'decade',
    });
    $("[data-role*=month-picker]").datetimepicker({
        language:'zh-CN',
        startView: 'year',
        minView: 'year',
        format: 'yyyy-mm',
        autoclose: true,
        maxView: 'year',
    });
</script>