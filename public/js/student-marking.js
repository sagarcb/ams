$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".marking").on('keyup',function () {
        if ($(this).val() > parseInt($("#fullMark").text())) {
            alert("Mark cannot be greater than full mark");
            $(this).val('');
        }
    });

    $('.saveBtn').on('click',function (e) {
        e.preventDefault();
        let course_student_id = $(this).parent().prev().prev().find('input[class="course_student_id"]').val();
        let assignment_id = $(this).parent().prev().prev().find('input[class="assignment_id"]').val();
        let mark = $(this).parent().prev().prev().find('input[class="form-control marking"]');
        let comment = $(this).parent().prev().find('input[class="form-control comment"]');
            $.ajax({
                type: 'POST',
                url: '/admin/assignments/store-marking',
                data: {
                    course_student_id: course_student_id,
                    assignment_id : assignment_id,
                    mark : $(mark).val(),
                    comment: $(comment).val()
                },
                success: function (data) {
                    $(mark).attr('readonly','true');
                    $(comment).attr('readonly','true');
                    console.log(data);
                    new SnackBar({
                        message: 'Mark Added/Updated Successfully!!',
                        timeout: 3500,
                        status: 'Success'
                    })
                },
                error: function (error) {
                    $.each(error.responseJSON.errors, function (index, value) {
                        new SnackBar({
                            message: value[0],
                            timeout: 3500,
                            status: "danger"
                        })
                    });
                    console.log(error);
                }
            })
    });

    $('.editBtn').on('click',function () {
        $(this).parent().prev().prev().find('input[class="form-control marking"]').attr('readonly',false);
        $(this).parent().prev().find('input[class="form-control comment"]').attr('readonly',false);
    });

});
