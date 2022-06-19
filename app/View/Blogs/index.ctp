<div class="global-content">
	<div class="global-section">
		<?php echo $this->element('nav') ?>

		<main class="wrap" style="padding: 1rem;">
			<?php if ($this->Session->read('Auth.User')) { ?>
				<h1 class="welcome-title">Bem vindo, 
					<span style="color: #b8403f">
						<?php 
							$userName = explode(' ', $this->Session->read('Auth.User.name'));
							$firstName = array_shift($userName);
							
							echo $firstName; 
						?>
					</span>, ao CakeBLOG!
				</h1>
			<?php } else { ?>
				<h1 class="welcome-title">Bem vindo ao CakeBLOG!</h1>
			<?php } ?>
		</main>

		<hr style="width: 30%; display: flex; margin: 2.4rem auto;">

		<div class="container">
			<section class="content-blog">
				<div class="row">
				<?php if (!empty($dados)) {  ?>
					<?php foreach ($dados as $k => $v) { ?>
						<div class="col-md-6 col-lg-6 col-sm-6 padding-card">
							<div class="card">
								<div class="row">
									<div class="col-md-5 wrapthumbnail">
										<a href="/posts/post/<?php echo $v['Post']['id']; ?>">
											<?php if (empty($v['Post']['img'])) { ?>
												<div class="thumbnail" style="background-image:url(/img/favicon.png);"></div>
											<?php } else { ?>
												<div class="thumbnail" style="background-image:url(/img/<?php echo $v['Post']['img']; ?>);"></div>
											<?php } ?>
										</a>
									</div>
									<div class=" col-md-7 wrapcontent">
										<div class="card-block">
											<h2 class="card-title">
												<a href="/posts/post/<?php echo $v['Post']['id']; ?>"><?php echo $v['Post']['title']; ?></a>
											</h2>
											<span class="card-text d-block"><?php echo strip_tags(substr($v['Post']['content'],0,120)); ?>...</span>
											<div>
												<div class="wrapfooter">
													<span class="meta-footer-thumb">
														<a href="/users/profile/<?php echo $v['User']['username']; ?>">
															<?php if (empty($v['User']['photo'])) { ?>
																<img alt="Author Photo" src="/img/upload/avatar/default.svg" class="avatar avatar-40 photo jetpack-lazy-image jetpack-lazy-image--handled" height="40" width="40" data-lazy-loaded="1" loading="eager"/>
															<?php } else { ?>
																<img alt="Author Photo" src="/img/upload/avatar/<?php  echo $v['User']['photo']; ?>" class="avatar avatar-40 photo jetpack-lazy-image jetpack-lazy-image--handled" height="40" width="40" data-lazy-loaded="1" loading="eager"/>
															<?php } ?>
														</a>
													</span>
													<span class="author-meta">
														<span class="post-name">
															<a href="/users/profile/<?php echo $v['User']['username']; ?>"><?php echo $v['User']['name']; ?></a>
														</span>
														<br>
														<span class="post-date"><?php echo date("d/m/Y", strtotime($v['Post']['created'])); ?></span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php echo $this->element('pagination') ?>
				<?php } else { ?>
					<h1>Não existem posts.</h1>
				<?php } ?>
			</section>
		</div>
	</div>
</div>
