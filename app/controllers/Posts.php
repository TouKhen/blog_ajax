<?php
/**
 * Class Posts
 * Gère les articles du blog.
 */
class Posts extends Controller {
    /**
     * @var mixed
     */
    private $postModel;

    /**
     * Posts constructor
     * Charge le model des articles
     */
    public function __construct() {
        $this->postModel = $this->loadModel('Post');
    }

    /**
     * Récupère tous les articles et les retourne à la vue.
     * @throws JsonException
     */
    public function index() {
        $posts = $this->postModel->findAllPosts();

        $postsArray = '';
        $data = [
            'posts' => $posts,
            'post' => '',
            'title' => '',
            'slug' => '',
            'image' => '',
            'body' => '',
            'titleError' => '',
            'slugError' => '',
            'imageError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            var_dump($_POST);
            $data = [
                'post_id' => $_POST['id'],
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'slug' => trim($_POST['slug']),
                'image' => trim($_POST['image']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'slugError' => '',
                'imageError' => '',
                'bodyError' => ''
            ];

            if (empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }
            if (empty($data['slug'])) {
                $data['slugError'] = 'The slug of a post cannot be empty';
            }
            if (empty($data['image'])) {
                $data['imageError'] = 'The title of a post cannot be empty';
            }
            if (empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

//            if($data['title'] == $this->postModel->findPostById($id)->title) {
//                $data['titleError'] == 'At least change the title!';
//            }
//            if($data['slug'] == $this->postModel->findPostById($id)->slug) {
//                $data['slugError'] == 'At least change the title!';
//            }
//            if($data['image'] == $this->postModel->findPostById($id)->image) {
//                $data['imageError'] == 'At least change the title!';
//            }
//            if($data['body'] == $this->postModel->findPostById($id)->body) {
//                $data['bodyError'] == 'At least change the body!';
//            }

            if (empty($data['titleError']) && empty($data['slugError']) && empty($data['imageError']) && empty($data['bodyError'])) {
                if ($this->postModel->updatePost($data)) {
                    return true;
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->render('posts/index', $posts);
            }
        }

        $this->render('posts/index', $posts);
    }

    public function posts() {
        $posts = $this->postModel->findAllPosts();

        $postsArray = '';

        foreach($posts as $post) {
            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id){
                $postsArray .=
                '
                <div class="container-item" id="' . $post->post_id . '">
                <button class="btn orange update_'.$post->post_id .'" href="' . URL_ROOT . '/posts/update/' . $post->post_id . '">
                    Update
                </button>
                <div class="show_update_' . $post->post_id . '">
                    <form method="POST" class="update_form" id="' . $post->post_id . '">
                        <div class="form-item">
                            <input type="text" name="title' . $post->post_id . '" id="title' . $post->post_id . '"
                                   value="' . $post->title . '"
                                   data-target="' . $post->title . '">
                            <span class="invalidFeedback"></span>
                        </div>
        
                        <div class="form-item">
                            <input type="text" name="slug' . $post->post_id . '" id="slug' . $post->post_id . '"
                                   value="' . $post->slug . '"
                                   data-target="' . $post->slug . '">
                            <span class="invalidFeedback"></span>
                        </div>
        
                        <div class="form-item">
                            <input type="text" name="image' . $post->post_id . '" id="image' . $post->post_id . '"
                                   value="' . $post->image . '"
                                   data-target="' . $post->image . '">
                            <span class="invalidFeedback"></span>
                        </div>
        
                        <div class="form-item">
                                                    <textarea name="body' . $post->post_id . '" id="body' . $post->post_id . '"
                                                              placeholder="Enter your post..."
                                                              data-target="' . $post->body . '">' . $post->body . '</textarea>
                            <span class="invalidFeedback"></span>
                        </div>
        
                        <button class="btn green update_post" name="submit" data-id="' . $post->post_id . '"
                                type="submit">
                            Submit
                        </button>
                    </form>
                </div>
                <form action="' . URL_ROOT . '/posts/delete/' . $post->post_id . '"
                      method="POST">
                    <input type="submit" name="delete" value="Delete"
                           class="btn red delete_post">
                </form>
                <script>
                    let verif_' . $post->post_id . ' = true;
                    $(function () {
                        $(".show_update_' . $post->post_id . '").css("display", "none");
                        $(".update_' . $post->post_id . '").on("click", () => {
                            if (verif_' . $post->post_id . ') {
                                $(".show_update_' . $post->post_id .'").css("display", "block");
                                verif_' . $post->post_id . ' = false;
                            } else if (!verif_' . $post->post_id . ') {
                                $(".show_update_' . $post->post_id . '").css("display", "none");
                                verif_' . $post->post_id . ' = true;
                            }
                        })
                    });
                </script>
                        <h2 class="post_title">
                            ' . $post->title . '
                        </h2>

                        <h3>
                            Created on: ' . date('F j h:m', strtotime($post->created_at)) . '
                        </h3>

                        <p class="post_body">
                            ' . $post->body . '
                        </p>
                    </div>
                </div>
                ';
                } else {
            $postsArray .= '
                                <div class="container-item" id="' . $post->post_id . '">
                                    <h2 class="post_title">
                                        ' . $post->title . '
                                    </h2>

                                    <h3>
                                        Created on: ' . date('F j h:m', strtotime($post->created_at)) . '
                                    </h3>

                                    <p class="post_body">
                                        ' . $post->body . '
                                    </p>
                                </div>
                            </div>
                                                    ';
}
        }
        echo $postsArray;

        $this->render('posts/posts', $postsArray);
    }

    public function create()
    {
        if (!isLoggedIn()) {
            header("Location: " . URL_ROOT . '/posts');
        }

        $data = [
            'title' => '',
            'slug' => '',
            'image' => '',
            'body' => '',
            'published' => 0,
            'titleError' => '',
            'slugError' => '',
            'imageError' => '',
            'bodyError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'slug' => trim($_POST['slug']),
                'image' => $_POST['image'],
                'body' => trim($_POST['body']),
                'published' => 0,
                'titleError' => '',
                'slugError' => '',
                'imageError' => '',
                'bodyError' => '',
            ];

            if (empty($data['title'])) {
                $data['titleError'] = "le titre de  l'article est requis";
            }

            if (empty($data['slug'])) {
                $data['slugError'] = "le titre de  l'article est requis";
            }

            if (empty($data['image'])) {
                $data['imageError'] = "le titre de  l'article est requis";
            }

            if (empty($data['body'])) {
                $data['bodyError'] = "le titre de  l'article est requis";
            }

            if (empty($data['titleError']) && empty($data['slugError']) && empty($data['imageError']) && empty($data['bodyError'])) {
                if ($this->postModel->addPost($data)) {
                    header("Location: " . URL_ROOT . '/posts');
                } else {
                    die("Quelque chose c'est mal passé ! Réessayer");
                }
            } else {
                $this->render('posts/create', $data);
            }
        }
        $this->render('posts/create', $data);
    }

  /*  public function update($id) {
        $post = $this->postModel->findPostById($id);

        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/posts");
        } elseif($post->user_id != $_SESSION['user_id']){
            header("Location: " . URL_ROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => '',
            'slug' => '',
            'image' => '',
            'body' => '',
            'titleError' => '',
            'slugError' => '',
            'imageError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'post_id' => $id,
                'post' => $post,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'slug' => trim($_POST['slug']),
                'image' => trim($_POST['image']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'slugError' => '',
                'imageError' => '',
                'bodyError' => ''
            ];

            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }
            if(empty($data['slug'])) {
                $data['slugError'] = 'The slug of a post cannot be empty';
            }
            if(empty($data['image'])) {
                $data['imageError'] = 'The title of a post cannot be empty';
            }
            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if($data['title'] == $this->postModel->findPostById($id)->title) {
                $data['titleError'] == 'At least change the title!';
            }
            if($data['slug'] == $this->postModel->findPostById($id)->slug) {
                $data['slugError'] == 'At least change the title!';
            }
            if($data['image'] == $this->postModel->findPostById($id)->image) {
                $data['imageError'] == 'At least change the title!';
            }
            if($data['body'] == $this->postModel->findPostById($id)->body) {
                $data['bodyError'] == 'At least change the body!';
            }

            if (empty($data['titleError']) && empty($data['slugError']) && empty($data['imageError']) && empty($data['bodyError'])) {
                if ($this->postModel->updatePost($data)) {
                    header("Location: " . URL_ROOT . "/posts");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->render('posts/update', $data);
            }
        }

        $this->render('posts/update', $data);
    }*/

    public function delete($id) {
        $post = $this->postModel->findPostById($id);

        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/posts");
        } elseif($post->user_id != $_SESSION['user_id']){
            header("Location: " . URL_ROOT . "/posts");
        }

        $data = [
            'post' => $post,
            'title' => '',
            'body' => '',
            'titleError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->postModel->deletePost($id)) {
                header("Location: " . URL_ROOT . "/posts");
            } else {
                die('Something went wrong!');
            }
        }
    }
}
