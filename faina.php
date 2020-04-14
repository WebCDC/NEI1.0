<?php include('navbar.php'); ?>

<?php startblock('head') ?>
	<meta name="description" content="Faina de Engenharia Informática">
	<title>NEI - Faina</title>
<?php endblock() ?>

<?php startblock('body') ?>
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					
					<?php
						$conn = new mysqli($servername, $username, $password);
						$conn->select_db("aauav-nei"); 
						if ($stmt = $conn->prepare("SELECT f_posts.id as id, title, content, name, path FROM f_posts JOIN images ON images.id = image_id WHERE state=1 ORDER BY pub_date DESC")) {
							$stmt->execute();
							$result = $stmt->get_result();
							while($row = $result->fetch_assoc()) {
								?>
								<div class="card mb-5" style="width: 100%;">
									<img class="card-img-top" src="<?php echo implode("/",array_slice(explode('/', $_SERVER['PHP_SELF']), 0, -1)); ?>/upload/faina/<?php echo utf8_encode($row['path']); ?>" style="width: 100%;" title="<?php echo utf8_encode($row['name']); ?>">
									<div class="card-body">
										<h5 class="card-title"><?php echo utf8_encode($row['title']); ?></h5>
										<hr>
										<p class="card-text"><?php echo mb_substr(strip_tags(utf8_encode($row['content'])), 0, 222); ?></p>
										<a class="btn btn-success" href="faina_post.php?post=<?php echo utf8_encode($row['id']); ?>">Continuar a ler...</a>
									</div>
								</div>
								<?php
							}
						}
					?>
					
				</div>
			</div>
		</div>
	</section>	
<?php endblock() ?>
