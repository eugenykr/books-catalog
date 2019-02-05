<?php
/**
 * The main template file
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
        <?php wp_head(); ?>
    </head>
    <body>
    <header>
        <nav class="navbar navbar-dark bg-dark box-shadow">
            <div class="container">
                <a href="<?php home_url(); ?>" class="navbar-brand">
                    <strong><?php bloginfo('name'); ?></strong>
                </a>
            </div>
        </nav>
    </header>
    <main>
        <?php if ( is_user_logged_in() ) { ?>
            <section class="jumbotron bg-white">
                <div class="container">
                    <h1 class="jumbotron-heading text-center">Добавить книгу</h1><br>
                    <div id="add-book-wrapper">
                        <form class="add-book-form">
                            <div class="form-group row">
                                <label for="book_title" class="col-4 col-form-label text-right">Название книги</label>
                                <div class="col-8">
                                    <input id="book_title" name="book_title" type="text" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="book_description" class="col-4 col-form-label text-right">Описание</label>
                                <div class="col-8">
                                    <textarea id="book_description" name="book_description" cols="40" rows="5" class="form-control" required="required"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-success">Отправить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        <?php } ?>
        <?php
            $query = new WP_Query(array(
                'post_type' => 'book',
                'post_status' => 'publish'
            ));

            if ($query->have_posts()){ ?>
                <section class="books-list jumbotron bg-light">
                    <div class="container">
                        <h2 class="text-center">Список книг</h2><br>
                        <table class="table table-striped bg-white">
                            <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Название</th>
                                <th scope="col">Описание</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $num = 1;
                                    while ($query->have_posts()) {
                                        $query->the_post(); ?>
                                        <tr>
                                            <th scope="row"><?php echo $num++ ?></th>
                                            <td><?php echo $post->post_title ?></td>
                                            <td><p><?php echo $post->post_content ?></p></td>
                                        </tr>
                                    <?php } wp_reset_query(); ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            <?php } ?>

    </main>

        <?php wp_footer(); ?>
    </body>
</html>