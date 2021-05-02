$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#saveBtn').on('click', function () {

        let studentName = $('#student_name').val();
        let studentId = $('#student_id').val();
        let courseId = $('#course_id').val();
        let courseCode = $('#course_code').val();
        let id = $('#courseStudentId').val();
        let tbody = $('tbody');

            $.ajax({
                type: 'POST',
                url: '/admin/course/store-student',
                data: {
                    course_id: courseId,
                    student_name: studentName,
                    student_id: studentId,
                    id: id
                },
                success: function (data) {
                    if (!id){
                        $(tbody).prepend(`
                            <tr data-id='${data.course_id}'>
                                <td class="courseCode">${courseCode}</td>
                                <td class="studentName">${data.student_name}</td>
                                <td class="studentId">${data.student_id}</td>
                                <td>
                                    <button data-id="${data.id}" class="btn btn-warning btn-sm editBtn" data-toggle="tool-tip" title="Edit Student">
                                        <i class="fa fa-edit"></i></button>
                                    <button data-id="${data.id}" class="btn btn-danger btn-sm deleteBtn" data-toggle="tool-tip" title="Delete Student">
                                        <i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        `);
                    }else {
                        let tableRow = $('tr[data-id="'+id+'"]');
                        $(tableRow).find('.studentName').text(studentName);
                        $(tableRow).find('.studentId').text(studentId);
                    }

                    $('#student_name').val('');
                    $('#student_id').val('');
                    new SnackBar({
                        message: 'Student Added/Updated Successfully!!',
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
                }
            })
    });
});
    $(document).ready(function () {
        $(document).on('click','.editBtn',function () {
            let studentName = $(this).closest('td').prev().prev().text();
            let studentId = $(this).closest('td').prev().text();
            let id = $(this).attr('data-id');
            $('#student_name').val(studentName);
            $('#student_id').val(studentId);
            $('#courseStudentId').val(id);
        });

    });



    $(document).ready(function () {
        $(document).on('click','.deleteBtn',function () {
            let id = $(this).attr('data-id');
            if (confirm("Are you sure want to delete this student Information?")) {
                $.ajax({
                    type: 'DELETE',
                    url: '/admin/course/' + id + '/delete-student',
                    success: function () {
                        new SnackBar({
                            message: "Successfully Deleted",
                            timeout: 3500,
                            status: 'danger'
                        });
                        $('tr[data-id="'+id+'"]').remove();
                    }
                })
            }
        });
    });


