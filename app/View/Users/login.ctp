<?php

	echo $this->Form->create('User');
	echo $this->Form->input('username');
	echo $this->Form->input('password', array('type' => 'password'));
	echo $this->Form->end('Submit');
