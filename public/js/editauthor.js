$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.click').click(function() {
        var id = $(this).data("id");
        // const AUTHORURL = '{{ route("admin.authors.update", [id => ' + id + ']   }}';
        // console.log(AUTHORURL);
        var all = $('.btn.btn-primary.click');
        all.hide();
        $(this).parent().append('<a  class="btn btn-primary save">Lưu</a>');
        $(this).parent().append('<a  class="btn btn-primary cancel">Hủy</a>');
        $(this).addClass('hidden');
        var tdname = $(this).parents('tr');
        var name = tdname.children(".name");
        var nameval = name.text();
        // console.log(nameval);
        var IName = $('<input type="text" class="ajaxname" value="' + nameval + '" />');

        name.html(IName);

        // author.children('span').hide();
        // select.removeClass("hidden");
        // $('#editauthor' + id).select2({
        //     tags: true,
        //     tokenSeparators: [',']
        // });
        var save = $(this).parent().children('.save');
        var cancel = $(this).parent().children('.cancel');


        save.click(function() {
            // var authornew = select.val();
            var author = name.children('.ajaxname').val();
            $.ajax({
                url: "/admin/changeauthor",
                type: 'post',
                data: { author: author, id: id },
                success: function(response) {

                    save.remove();
                    cancel.remove();
                    all.show();
                    // select.addClass('hidden');
                    // $('#editauthor' + id).select2('destroy');
                    $('.click').removeClass("hidden");
                    // author.children('span').html(authornew).show();
                    name.html(author);
                    $('.edit').removeClass("hidden");
                    $('.edit').html(response);


                }
            });

        })

        cancel.click(function() {
            // var authornew = select.val();
            // var namebook = name.children('.ajaxname').val();
            save.remove();
            cancel.remove();
            all.show();
            $('.click').removeClass("hidden");
            // author.children('span').show();
            // select.addClass('hidden');
            name.html(nameval);
            // $('#editauthor' + id).select2('destroy');
        })




    })
})