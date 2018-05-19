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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <?= ""//$this->Html->css('base.css') ?>
    <?= ""//$this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<nav class="top-bar expanded" data-topbar role="navigation">

    <?php if ($loggedIn): ?>
        <div class="top-bar-section">
            <ul class="left">
                <li><?= $this->Html->link(__('Home'), ['action' => 'index', 'controller' => 'pages']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="left">
                <li><?= $this->Html->link(__('My Robots'), ['action' => 'index', 'controller' => 'robots']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="left">
                <li><?= $this->Html->link(__('My Topics'), ['action' => 'index', 'controller' => 'topics']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="left">
                <li><?= $this->Html->link(__('My Message Types'), ['action' => 'index', 'controller' => 'MesTypes']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="right">
                <li><?= $this->Html->link("Log out", ['controller' => 'users', 'action' => 'logout']) ?></li>
            </ul>
        </div>
    <?php endif; ?>
</nav>
<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
