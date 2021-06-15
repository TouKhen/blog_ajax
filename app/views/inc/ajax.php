<script>
    $(function(){
        // show posts
        $.ajax({
            type : "GET",
            url : "<?= URL_ROOT ?>/posts/posts",
            success : (data)=>{
                let postCont = $('#post_container');
                postCont.html(data);

                // delete post
                $('.delete_post').on('click', function() {
                    let id  =   $(this).data('id');
                    $.ajax({
                        url     :   "<?= URL_ROOT ?>/posts/delete",
                        data    :   {id:id},
                        type    :   "POST",
                        async   :   true,
                        success :   (res)=>{
                        }
                    });
                })

                // update post
                $('.update_post').on('click', function(event) {
                    event.preventDefault();
                    let id = $(this).data('id');
                    let title = $('#title' + id).val();
                    let slug = $('#slug' + id).val();
                    let image = $('#image' + id).val();
                    let body = $('#body' + id).val();

                    $.ajax({
                        url : "<?= URL_ROOT ?>/posts/update",
                        data : {id:id, title:title, slug:slug, image:image, body:body},
                        type : "POST",
                        async : true,
                        success : (res)=>{
                            console.log({id:id, title:title, slug:slug, image:image, body:body});
                            console.log("success : " + res);
                            $('.show_update_' + id).css('display', 'none');
                            $('#' + id).children('.post_title').text(title);
                            $('#' + id).children('.post_body').text(body);
                        },
                        error : (res)=>{
                            console.log("error : " + res);
                        }
                    });
                })
            }
        });
    });
</script>