<div class="global-content">
	<div class="global-section">
		<?php echo $this->element('nav') ?>

		<div style="display: flex;">
			<div style="margin: 0 auto;">
				<div>
					<h1 style="color: #333333; font-weight: 700;">Escreva um blog...</h1>
				</div>

				<div>
					<?php echo $this->Form->create('Post');?>
						<div class="form-group">
							<?php echo $this->Form->input('title', ['label' => '', 'class' => 'form-control',  'tabindex' => '1', 'placeholder' => 'Título do Post']); ?>
						</div>

						<div class="form-group">
							<?php echo $this->Form->input('content', ['label' => '', 'class' => 'form-control',  'tabindex' => '1', 'placeholder' => 'Conteúdo do Post', 'rows' => '3']); ?>
						</div>

						<input type="submit" class="btn btn-danger" style="background-color: #b8403f;" value="Postar">
					<?php echo $this->Form->end();?>
				</div>
			</div>
		</div>
	</div>
</div>
