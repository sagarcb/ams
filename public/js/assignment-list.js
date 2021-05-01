$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    })
});


$(document).ready(function (e) {
    $('.deleteBtn').on('click',function () {
        let id = $(this).attr('data-id');
        let tableRow = $(this).closest('td').parent();
        if (confirm("Are you sure want to delete this Assignment?")){

            $.ajax({
                type: 'DELETE',
                url: 'assignments/'+id+'/delete',
                success: function (data) {
                    alert('Data Successfully Deleted');
                    $(tableRow).remove();
                },
                error: function (error) {
                    console.log(error);
                }
            })

        }
    });
});
