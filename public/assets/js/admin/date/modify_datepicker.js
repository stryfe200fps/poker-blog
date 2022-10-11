
$(document).ready(function () { 

$('.date-picker').select()

$("input[name='title']").focus()

$("input[name='timezone']").val(Intl.DateTimeFormat().resolvedOptions().timeZone)

});

