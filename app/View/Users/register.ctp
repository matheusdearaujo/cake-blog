<img class="wave" src="img/auth/wave.png">

<div class="container">
	<div class="img">
		<img src="img/auth/bg.svg">
	</div>
	<div class="login-content">
	<?php echo $this->Form->create('User');?>
		<h2 class="title">Faça sua conta</h2>

		<?php echo $this->Form->input('username', ['label' => '', 'class' => 'input-auth',  'tabindex' => '1', 'placeholder' => 'Nome de Usuário']); ?>

		<?php echo $this->Form->input('name', ['label' => '', 'class' => 'input-auth',  'tabindex' => '1', 'placeholder' => 'Nome Completo']); ?>

		<?php echo $this->Form->input('email', ['label' => '', 'class' => 'input-auth',  'tabindex' => '1', 'placeholder' => 'E-mail']); ?>

		<?php echo $this->Form->input('password', ['label' => '', 'class' => 'input-auth',  'tabindex' => '1', 'placeholder' => 'Senha']); ?>

		<button type="submit" class="btn btnRegister">Registrar</button>

		<a href="/login">Já possue uma conta?</a>

	<?php echo $this->Form->end();?>
	</div>
</div>
