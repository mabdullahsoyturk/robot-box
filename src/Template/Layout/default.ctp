<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$title = 'ROS Kinetic Visualizer';
?>
<!DOCTYPE html>
<html>
<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        <?= $title ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <?= ""//$this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" rel="stylesheet">
    <?= $this->Html->css('creative.css') ?>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <strong><?= $this->Html->link(__('ROBOT BOX'), ['action' => 'index', 'controller' => 'pages'], ['class' => 'navbar-brand']) ?></strong>
            <?php if ($loggedIn): ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <?= $this->Html->link(__('My Robots'), ['action' => 'index', 'controller' => 'robots'], ['class' => 'nav-link custom-link link-myrobot' ]) ?>
                        </li> 
                        <li class="nav-item"> 
                            <?= $this->Html->link(__('My Topics'), ['action' => 'index', 'controller' => 'topics'], ['class' => 'nav-link custom-link' ]) ?>
                        </li>
                        <li class="nav-item">
                            <?= $this->Html->link(__('My Message Types'), ['action' => 'index', 'controller' => 'MesTypes'], ['class' => 'nav-link custom-link' ]) ?>
                        </li>
                    </ul>
                    <?= $this->Html->link("Logout", ['controller' => 'users', 'action' => 'logout'], ['class' => 'btn btn-action btn-sm' ]) ?>

                </div>
            <?php endif; ?>
        </div>
    </nav>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <footer>
    </footer>

    <?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js') ?>

    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js') ?>
    <?= $this->Html->script('https://unpkg.com/scrollreveal/dist/scrollreveal.min.js') ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js') ?>
    <?= $this->Html->script('creative.js'); ?>
</body>
</html>
