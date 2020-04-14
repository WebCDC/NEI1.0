<?php include('navbar.php'); ?>

<?php startblock('head') ?>
    <meta name="description" content="Mudança de password de utilizadores">
    <title>NEI - Pagamentos</title>
<?php endblock() ?>


<?php startblock('body') ?>
<?php if (isset($_SESSION['ok_msg'])) : ?>
    <section id="cdpasswd">
        <div class="container">
            <h5 align="center" style="color:green">
                <?php echo $_SESSION['ok_msg']; unset($_SESSION['ok_msg']); ?>
            </h5>
        </div>
    </section>
    <?php endblock() ?>
    <?php
    ob_end_flush();
    exit();
    ?>
<?php endif; ?>

<?php
if ($_POST && isset($_POST['chng_state']) && !empty($_POST['user_email']) && !empty($_SESSION['iddopagamento'])) {
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    $conn->select_db("aauav-nei");
    
    if ($stmt = $conn->prepare("SELECT 1 FROM inscricoes_nei WHERE user_login=? AND post_id=?")) {
        $stmt->bind_param("ss", $_POST['user_email'], $_SESSION['iddopagamento']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($stmt2 = $conn->prepare("UPDATE inscricoes_nei SET estado='1' WHERE user_login=? AND post_id=?")) {
                $stmt2->bind_param("ss",$_POST['user_email'], $_SESSION['iddopagamento']);
                $stmt2->execute();
                $_SESSION['ok_msg'] = 'Estado alterada com sucesso!';
            }
        }else{
            $_SESSION['change_msg'] =  "Email inválido";
        }
    }
    $conn->close();
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

?>

<?php if(isset($_SESSION['valid']) AND $_SESSION['valid'] AND isset($_SESSION['iddopagamento']) AND $_SESSION['iddopagamento'] AND isset($_SESSION['titulodopagamento']) AND $_SESSION['titulodopagamento'] AND isset($_SESSION['uaccess']) && $_SESSION['uaccess']>=499) : ?>
    <section id="cpasswd">
        <div class="container">
            <form class="form-signin col-8 offset-2 " role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                  method="post">
                
                <input type="text" class="form-control" name="username" placeholder="utilizador" disabled autofocus
				value="<?php echo $_SESSION['titulodopagamento'];?>">

                <input class="form-control mt-2" name="user_email" placeholder="email do utilizador" required>

                <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="chng_state">Marcar como pago</button>

                <h5 align="center" style="color:red">
                    <?php if(array_key_exists('change_msg',$_SESSION)){echo $_SESSION['change_msg']; unset($_SESSION['change_msg']);}?>
                </h5>
            </form>
        </div>
    </section>
<?php else : ?>
    <?php
    header("Location: index.php");
    exit();
    ?>
<?php endif; ?>
<?php endblock() ?>