<?php include('navbar.php'); ?>

<?php startblock('head') ?>
<meta name="description" content="Faina de Engenharia Informática">
<title>NEI - Gestão - Faina</title>
<?php endblock() ?>

<?php
    if( !isset($_SESSION['uaccess']) || $_SESSION['uaccess']<400){
        header("Location: index.php");
        exit();
    }
    if( $_POST && isset($_SESSION['ulogin']) && isset($_POST['post_id']) ){
        if(isset($_POST['toggle_state'])){
            $conn = new mysqli($servername, $username, $password);
            $conn->select_db("aauav-nei");
            if ($stmt = $conn->prepare("UPDATE f_posts SET state=CASE WHEN state=1 THEN 0 ELSE 1 END, chg_by=?, chg_date=CURRENT_DATE WHERE id=?")) {
                $stmt->bind_param("ss", $_SESSION['ulogin'], $_POST['post_id']);
                $stmt->execute();
            }
        }
        header('Location: '.$_SERVER['PHP_SELF']);
        exit();
    }
?>

<?php startblock('body') ?>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <table id="posts" class="display responsive nowrap table table-sm table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td colspan="4"></td>
                            <td>
                                <a href="adm_faina_post.php?post=new" class="btn btn-sm btn-success ml-3">
                                    Nova publicação
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Publicado a</th>
                            <th>Última edição</th>
                            <th>Acções</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $conn = new mysqli($servername, $username, $password);
                        $conn->select_db("aauav-nei");
                        if ($stmt = $conn->prepare("SELECT id, title, state, concat(pub_date, ' (por ', pb_users.u_name, ')') as publication, (case when chg_by IS NULL THEN '' ELSE concat(chg_date, ' (por ', chg_users.u_name, ')') END) as last_change FROM f_posts LEFT JOIN users AS chg_users ON chg_by = chg_users.u_login LEFT JOIN users AS pb_users ON pub_by = pb_users.u_login ORDER BY pub_date DESC")) {
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td>
                                        <a href="faina_post.php?post=<?php echo $row['id']; ?>" target="_blank">
                                            <?php echo utf8_encode($row['title']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo utf8_encode($row['publication']); ?></td>
                                    <td><?php echo utf8_encode($row['last_change']); ?></td>
                                    <td align="center">
                                        <form class="form-inline" method="POST" style="max-width: 15em;">
                                            <input type="numeric" name="post_id" value="<?php echo $row['id']; ?>" hidden>
                                            <button type="submit" name="toggle_state" class="btn btn-sm btn-warning">
                                                <?php if($row['state'] == 1){ echo 'Desativar'; }else{ echo 'Ativar'; } ?>
                                            </button>
                                            <a href="adm_faina_post.php?post=<?php echo $row['id']; ?>" class="btn btn-sm btn-success ml-3">
                                                Editar
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php endblock() ?>

<?php startblock('custom_js') ?>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#posts').DataTable({reponsive: true, paging: false, searching: false, info: false, ordering: true, order: [[2, 'desc']]});
    } );
</script>

<?php endblock() ?>
