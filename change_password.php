<?php include('navbar.php'); ?>

<?php startblock('head') ?>
    <meta name="description" content="Mudança de password de utilizadores">
    <title>NEI - Mudar Password</title>
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
if ($_POST && isset($_POST['chng_passwd']) && !empty($_POST['user_search']) && !empty($_POST['new_password'])) {
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    $conn->select_db("aauav-nei");
    
    if ($stmt = $conn->prepare("SELECT 1 FROM users WHERE u_email=?")) {
        $stmt->bind_param("s", $_POST['user_search']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($stmt2 = $conn->prepare("UPDATE users SET u_pwd=ENCRYPT(?) WHERE u_email=?")) {
                $stmt2->bind_param("ss", $_POST['new_password'], $_POST['user_search']);
                $stmt2->execute();
                $_SESSION['ok_msg'] = 'Password alterada com sucesso!';
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

<?php if(isset($_SESSION['valid']) AND $_SESSION['valid'] AND isset($_SESSION['uaccess']) && $_SESSION['uaccess']>=500) : ?>
    <section id="cpasswd">
        <div class="container">
            <form class="form-signin col-8 offset-2 " role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                  method="post">
                
                <input class="form-control mt-2" name="user_search" placeholder="email do utilizador" required>
                
                <input type="password" class="form-control mt-2" name="new_password" placeholder="nova password" required>

                <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="chng_passwd">Alterar</button>

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