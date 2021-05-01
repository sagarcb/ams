$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addCourseBtn').on('click', function () {
        $('#msg').html(' ');
    });

    $("#addForm").on('submit', function (e) {
        e.preventDefault();
        let title = $("#addForm input[name='title']").val();
        let course_code = $('#addForm input[name="course_code"]').val();
        let msg = $("#msg");
        $.ajax({
            type: 'POST',
            url: '/admin/add-course',
            data: {
                title: title,
                course_code: course_code
            },
            success: function (data) {
                $(msg).html(" ");
                $(msg).append('<div class="alert alert-success" role="alert">\n' +
                    '  Data Successfully Added!!!\n' +
                    '</div>');
                $('tbody').prepend('' +
                    '<tr data-id="'+data.id+'">\n' +
                    '<td class="title">'+data.title+'</td>\n' +
                    '<td class="course_code">'+data.course_code+'</td>\n' +
                    '<td>\n' +
                    '<a href="#" data-toggle="tooltip" title="Edit Course">\n' +
                    '<button class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></button>\n' +
                    '</a>\n' +
                    '<a href="#" data-toggle="tooltip" title="Delete Course">\n' +
                    '<button id="deleteBtn" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i></button>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>')
                $("#addForm input[name='title']").val(' ');
                $('#addForm input[name="course_code"]').val(' ');
            },
            error: function (error) {
                $(msg).html(" ");
                $.each(error.responseJSON.errors, function (index, value) {
                    $(msg).append('<div class="alert alert-success" role="alert">\n' +
                        '  '+value[0]+'\n' +
                        '</div>');
                })
            }
        })
    })

    $(document).on('click','.editBtn',function () {
        $("#msgEdit").html(' ');
        let title = $(this).closest('td').prev().prev().text();
        let courseCode = $(this).closest('td').prev().text();
        let id = $(this).closest('td').parent().attr("data-id");
        $("#editForm input[name='title']").val(title)
        $("#editForm input[name='course_code']").val(courseCode);
        $("#editForm input[name='id']").val(id);
    });

    $("#editForm").on('submit',function (e) {
        e.preventDefault();
        let title = $("#editForm input[name='title']").val();
        let course_code = $('#editForm input[name="course_code"]').val();
        let id = $("#editForm input[name='id']").val();
        let msg = $("#msgEdit");
        let CourseRow = $('tbody').find('tr[data-id="'+id+'"]');
        $.ajax({
            type: 'PATCH',
            url: id+'/update-course',
            data: {
                title: title,
                course_code: course_code
            },
            success: function (data) {
                $(msg).html(" ");
                $(msg).append('<div class="alert alert-warning" role="alert">\n' +
                    '  Data Successfully Updated!!!\n' +
                    '</div>');
                $(CourseRow).find('.title').text(title);
                $(CourseRow).find('.course_code').text(course_code);
                $("#editForm input[name='title']").val('');
                $("#editForm input[name='course_code']").val('');
            },
            error: function (error) {
                $(msg).html(" ");
                $.each(error.responseJSON.errors, function (index, value) {
                    $(msg).append('<div class="alert alert-danger" role="alert">\n' +
                        '  '+value[0]+'\n' +
                        '</div>');
                })
            }
        })
    })

    $(document).on('click','.deleteBtn', function () {
        let id = $(this).closest('td').parent().attr("data-id");
        let courseRow = $('tbody').find('tr[data-id="'+id+'"]');
        if (confirm('Are you sure want to delete this Course Information')) {
            $.ajax({
                type: 'DELETE',
                url: id + '/delete-course',
                success: function (data) {
                    $(courseRow).remove();
                }
            })
        }
    });

});

