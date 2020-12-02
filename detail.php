
<!doctype html>
<html lang="en">
<head>
    <?php include "includes/head.php"?>
    <title>Hello, world!</title>
</head>
<body>
    <?php $page = "home"; include "includes/nav_detail.php"?>

        <div class="container container_detail" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="view">       
                        <h1 class="header_detail">Hello World</h1>     
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-lg-3">
                            <div class="up_coming">
                                <p class="my-4">UpComming</p>
                                <ul class="list-group ">
                                    <span>Woohoo, no work due soon!</span>
                                </ul>
                                <a href="" class="my-4">View All</a>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-9">
                            <div class="col-12">
                                <div class="post_comment" >
                                    <div class="post_text">
                                        <textarea  placeholder="share with your class"  id="post_textarea" cols="70" rows="3">
                                        </textarea>
                                    </div>
                                    <div class="post_button">
                                        <input type="file" name="image" id="url_post"/>

                                        <button type='submit' id = "button_post">Post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "includes/script.php"?>
     </body>
</html>