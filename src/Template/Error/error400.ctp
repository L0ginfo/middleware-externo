<?php

use Cake\Core\Configure;

//redireciona caso não tiver permissão
if (@$_SESSION['redirect_error_permission']) {
    $redirect = $_SESSION['redirect_error_permission'];
    unset($_SESSION['redirect_error_permission']);
    header('Location: ' . $redirect);
    header("Refresh:0");
    die();
}

if (Configure::read('debug')):
    $this->layout = 'dev_error';
    
    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?= h($error->queryString) ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?= Debugger::dump($error->params) ?>
    <?php endif; ?>
    <?= $this->element('auto_table_warning') ?>
    <?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<h2><?= h($message) ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Error') ?>: </strong>
    <?=
    sprintf(
            __d('cake', 'The requested address %s was not found on this server.'), "<strong>'{$url}'</strong>"
    )
    ?>
</p>
