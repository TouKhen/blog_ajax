<script>
    $(function(){
        // show posts
        $.ajax({
            type : "GET",
            url : "<?= URL_ROOT ?>/posts/posts",
            success : (data)=>{
                let postCont = $('#post_container');
                postCont.html(data);
                console.log(data);

                // delete post
                $('.delete_post').on('click', function (event){
                    let id  =   $(this).data('id');
                    let post = $('#' + id);
                    event.preventDefault();
                    $.ajax({
                        url     :   "<?= URL_ROOT ?>/posts/delete/" + id,
                        data    :   {id:id},
                        type    :   "POST",
                        async   :   true,
                        success :   (res)=>{
                            console.log(res);
                            post.html('Post removed');
                        }
                    });
                })

                $('#form_create').on('submit', (event)=>{
                    event.preventDefault();
                    let post_ctn = $('#post_container');
                    let title = $('#create_title').val();
                    let slug = $('#create_slug').val();
                    let image = $('#create_image').val();
                    let body = $('#create_body').val();

                    $.ajax({
                        url : "<?= URL_ROOT ?>/posts/create",
                        data : {title:title, slug:slug, image:image, body:body},
                        type : "POST",
                        async : true,
                        success : (res)=>{
                            post_ctn.append(res);
                        },
                        error : (res)=>{
                            console.log("error : " + res);
                        }
                    });
                })

                // update post
                $('.update_post').on('click', function(event){
                    event.preventDefault();

                    let id = $(this).data('id');
                    let title = $('#title' + id).val();
                    let slug = $('#slug' + id).val();
                    let image = $('#image' + id).val();
                    let body = $('#body' + id).val();

                    $.ajax({
                        url : "<?= URL_ROOT ?>/posts/update/" + id,
                        data : {id:id, title:title, slug:slug, image:image, body:body},
                        type : "POST",
                        async : true,
                        success : (res)=>{
                            console.log({id:id, title:title, slug:slug, image:image, body:body});
                            console.log("success : " + res);
                            verif = true;
                            $('.show_update_' + id).css('display', 'none');
                            $('#' + id).children('.post_title').text(title);
                            $('#' + id).children('.post_body').text(body);
                        },
                        error : (res)=>{
                            console.log("error : " + res);
                        }
                    });
                })

                // post comment
                $('#send_comment').on('click', function (event){
                    event.preventDefault();
                    let post_id = $(this).data('id');
                    let body = $("#body").val();
                    let comment_ctn = $('#comment_container');

                    console.log(post_id);

                    $.ajax({
                        url : "<?= URL_ROOT ?>/posts/page/" + post_id,
                        data : {post_id:post_id, body:body},
                        type : "POST",
                        async : true,
                        success : (res)=>{
                            console.log(res);
                            comment_ctn.append("<div><h4><?= $_SESSION['username'] ?></h4><p>" + body + "</p></div>");
                        }
                    });
                })

                // reply comment
                $('.send_reply').on('click', function(event){
                    event.preventDefault();
                    let comment_id = $(this).data('id');
                    let rep_body = $("#rep_body" + comment_id).val();
                    let post_id = $("#post_id").val();
                    let reply_ctn = $('#reply_container' + comment_id);

                    $.ajax({
                        url : "<?= URL_ROOT ?>/posts/reply/" + comment_id,
                        data : {comment_id:comment_id, post_id:post_id, rep_body:rep_body},
                        type : "POST",
                        async : true,
                        success : (res)=>{
                            console.log({comment_id:comment_id, post_id:post_id, rep_body:rep_body});
                            console.log(res);
                            reply_ctn.append("<div class='reply'><h4><?= $_SESSION['username'] ?></h4><p>" + rep_body + "</p></div>");
                        }
                    });
                });
            }
        });
    });
</script>