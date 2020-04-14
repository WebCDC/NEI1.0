<?php include('navbar.php'); ?>

<?php
    if( !isset($_SESSION['uaccess']) || $_SESSION['uaccess']<498 || !isset($_GET['post']) || !($_GET['post']=="new"||is_numeric($_GET['post']))){
        header("Location: index.php");
        exit();
    }

    if( $_POST && isset($_SESSION['ulogin']) ){
        if(isset($_POST['add'])){
            $conn = new mysqli($servername, $username, $password);
            $conn->select_db("aauav-nei");
            if ($stmt = $conn->prepare("INSERT INTO n_posts (image_id, state, title, content, user_entry, pub_by, pub_date) VALUES (?, ?, ?, ?, ?, ?, CURRENT_DATE)")) {
                $stmt->bind_param("ssssss", $_POST['image'],$_POST['state'], $_POST['title'], $_POST['content'], $_POST['user_entry'], $_SESSION['ulogin']);
                $stmt->execute();
            }
        }else if(isset($_POST['save']) ){
        $conn = new mysqli($servername, $username, $password);
        $conn->select_db("aauav-nei");
        if ($stmt = $conn->prepare("UPDATE n_posts SET image_id=?, state=?, title=?, content=?, user_entry=?, chg_by=?, chg_date=CURRENT_DATE WHERE id=?")) {
            $stmt->bind_param("sssssss",  $_POST['image'],$_POST['state'], $_POST['title'], $_POST['content'], $_POST['user_entry'], $_SESSION['ulogin'], $_GET['post']);
            $stmt->execute();
        }
    }
        header('Location: adm_posts.php');
        exit();
    }

    $title = ""; $image = ""; $content =""; $state = "1"; $action = "add"; $entry="0";
    if($_GET['post']!="new"){
        $conn = new mysqli($servername, $username, $password); $conn->select_db("aauav-nei");
        if ($stmt = $conn->prepare("SELECT title, state, content, user_entry, image_id FROM n_posts WHERE n_posts.id=?")) {
            $stmt->bind_param("s", $_GET['post']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                header("Location: index.php");
                exit();
            }

            $row = $result->fetch_assoc();
            $title = $row['title'];
            $image = $row['image_id'];
            $content = $row['content'];
            $state = $row['state'];
            $entry = $row['user_entry'];
            $action = "save";
        }
    }

    $images = null;
    $conn = new mysqli($servername, $username, $password); $conn->select_db("aauav-nei");
    if ($stmt2 = $conn->prepare("SELECT id, name FROM images_nei")) {
        $stmt2->execute();
        $images = $stmt2->get_result();
    }
?>

<?php startblock('head') ?>
<meta name="description" content="Artigos Núcleo de Estudantes de Informática">
<title>NEI - Gestão - Artigos</title>
<?php endblock() ?>

<?php startblock('body') ?>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <form class="form" method="POST" accept-charset="ISO-8859-1">
                    <label for="title">Título</label>
                    <input id="title" name="title" class="form-control" type="text" maxlength="150"
                           value="<?php echo utf8_encode($title); ?>">

                    <label for="content" class="mt-3">Conteúdo</label>
                    <textarea id="content" name="content" class="form-control" maxlength="10000" style="height: 60vh;"><?php echo utf8_encode($content); ?></textarea>

                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-3">
                                <label for="image">Imagem</label>
                                <select id="image" name="image" class="form-control" style="min-width: 10em;">
                                    <?php while($row = $images->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['id']; ?>" <?php if($row['id']==$image){echo 'selected';} ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3">
                                <label for="state">Estado</label>
                                <select id="state" name="state" class="form-control" style="min-width: 10em;">
                                    <option value="1" <?php if($state=="1"){echo 'selected';} ?>>
                                        Público
                                    </option>
                                    <option value="0" <?php if($state=="0"){echo 'selected';} ?>>
                                        Desativado
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3">
                                <label for="user_entry">Incrições</label>
                                <select id="user_entry" name="user_entry" class="form-control" style="min-width: 10em;">
                                    <option value="0" <?php if($entry=="0"){echo 'selected';} ?>>
                                        Não
                                    </option>
                                    <option value="1" <?php if($entry=="1"){echo 'selected';} ?>>
                                        Sim, Ativas
                                    </option>
                                    <option value="2" <?php if($entry=="2"){echo 'selected';} ?>>
                                        Sim, Fechadas
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3" align="center" style="display: flex;">
                                <button type="submit" name="<?php echo $action; ?>" class="btn btn-success" style="min-width: 10em; margin: 0 auto;">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php endblock() ?>
