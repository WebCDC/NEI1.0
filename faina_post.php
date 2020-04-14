<?php include('navbar.php'); ?>

<?php startblock('head') ?>
	<meta name="description" content="Faina de Engenharia Informática">
	<title>NEI - Faina</title>
<?php endblock() ?>


<?php
    if (!isset($_GET['post']) OR !is_numeric($_GET['post'])) {
        header("Location: index.php");
        exit();
    }

    if( $_POST && isset($_SESSION['ulogin']) && isset($_POST['guests']) ){
        if(isset($_POST['confirm'])){
            $conn = new mysqli($servername, $username, $password);
            $conn->select_db("aauav-nei");
            if ($stmt = $conn->prepare("INSERT INTO inscricoes (post_id, user_login, guests) SELECT id, ?, ? FROM f_posts WHERE user_entry='1' AND id=?")) {
                $stmt->bind_param("sss",$_SESSION['ulogin'], $_POST['guests'], $_GET['post']);
                $stmt->execute();
            }
            $conn->commit();
        }
        header('Location: '.$_SERVER['REQUEST_URI']);
        exit();
    }




    $conn = new mysqli($servername, $username, $password);
    $conn->select_db("aauav-nei");

    $post = null;
    if ($stmt = $conn->prepare("SELECT title, content, name, path, user_entry FROM f_posts JOIN images ON images.id = image_id WHERE state=1 AND f_posts.id =?")) {
        $stmt->bind_param("s", $_GET['post']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            header("Location: faina.php");
            exit();
        }
        $post = $result->fetch_assoc();
    }

    $post_has_user_entry = $post['user_entry'];
    $user_login = null;
    $user_current_entry = null;
    $user_current_entry_guests = null;
    if( isset($_SESSION['ulogin']) ){
        $user_login = $_SESSION['ulogin'];
    }

    if( $post_has_user_entry!="0" && $user_login ) {
        if ($stmt2 = $conn->prepare("SELECT estado, guests FROM inscricoes WHERE post_id=? AND user_login=?")) {
            $stmt2->bind_param("ss", $_GET['post'], $user_login);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if ($result2->num_rows > 0) {
                $row2 = $result2->fetch_assoc();
                $user_current_entry = $row2['estado'];
                $user_current_entry_guests = $row2['guests'];
            }
        }
    }

    $registered_users = null;
    if( $user_login ) {
        if ($stmt3 = $conn->prepare("SELECT u_name, guests, estado FROM inscricoes JOIN users ON user_login = u_login WHERE post_id = ?")) {
            $stmt3->bind_param("s", $_GET['post']);
            $stmt3->execute();
            $registered_users = $stmt3->get_result();
        }
    }


?>

<?php startblock('body') ?>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-5" style="width: 100%;">
                    <img class="card-img-top" src="<?php echo implode("/",array_slice(explode('/', $_SERVER['PHP_SELF']), 0, -1)); ?>/upload/faina/<?php echo utf8_encode($post['path']); ?>" style="width: 100%;" title="<?php echo utf8_encode($post['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo utf8_encode($post['title']); ?></h5>
                        <hr>
                        <p class="card-text" style="text-align: justify; text-justify: inter-word;">
                            <?php echo str_replace('&nbsp;', '<br>', utf8_encode($post['content'])); ?>
                        </p>
                    </div>
                    <?php if($user_login && $post_has_user_entry!="0"){  // utilizador com login ?>
                    <div class="card-footer text-center">
                        <table class="table table-sm table-striped">
                            <tr>
                                <th>Nome</th>
                                <th>Acomp.</th>
                                <th>Obs.</th>
                            </tr>
                        <?php $incritos = 0; ?>
                        <?php $confirmados = 0; ?>
                        <?php while( !is_null($registered_users) && $row = $registered_users->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo utf8_encode($row['u_name']); ?></td>
                                <td><?php echo $row['guests']; ?></td>
                                <td><?php if( $row['estado'] == '0'){ echo 'Aguarda Pagamento'; }?></td>
                            </tr>
                            <?php $incritos += 1+$row['guests']; ?>
                            <?php if( $row['estado'] != '0' ) {$confirmados += 1+$row['guests']; } ?>
                        <?php } ?>
                            <tr>
                                <th colspan="3" style="text-align: right">Total: <?php echo $confirmados; ?> / <?php echo $incritos; ?></th>
                            </tr>
                        </table>
                    </div>
                    <?php } ?>
                    <?php if($post_has_user_entry=="1"){  // inscricoes ativas?>
                    <div class="card-footer text-center">
                        <?php if($user_login){  // utilizador com login ?>
                            <?php if(!is_null($user_current_entry)){  // utilizador inscrito?>
                                <p class="card-text" style="text-align: justify; text-justify: inter-word;">
                                    Já se encontra inscrito (com <?php echo $user_current_entry_guests;?> acompanhantes) para este evento!
                                </p>
                            <?php }else{  // utilizador não inscrito?>
                                <form class="form form-inline  text-center" method="POST">
                                    <label class="mr-5">Inscreve-te:</label>

                                    <label for="guests">Acompanhantes</label>
                                    <select id="guests" name="guests" class="form-control ml-2 mr-5">
                                        <option val="0">0</option>
                                        <option val="1">1</option>
                                        <option val="2">2</option>
                                    </select>
                                    <button name="confirm" class="btn btn-success btn-sm">Inscrever</button>
                                </form>
                            <?php } ?>
                        <?php }else{  // utilizador sem login?>
                            <p class="card-text" style="text-align: justify; text-justify: inter-word;">
                                Faça login para se inscrever neste evento!
                            </p>
                        <?php }?>
                    <?php }else if($post_has_user_entry=="2"){  // inscricoes finalizadas?>
                        <?php if($user_login){  // utilizador com login?>
                            <?php if($user_current_entry!=null){  // utilizador inscrito?>
                                <p class="card-text" style="text-align: justify; text-justify: inter-word;">
                                    Já se encontra inscrito (com <?php echo $user_current_entry_guests;?> acompanhantes) para este evento!
                                </p>
                            <?php }else{  // utilizador não inscrito?>
                                <p class="card-text" style="text-align: justify; text-justify: inter-word;">
                                    As incrições para este evento encontram-se encerradas!
                                </p>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endblock() ?>
