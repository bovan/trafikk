<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!doctype html>
<html lang="no">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
                
                echo $this->Html->css('normalize');
                echo $this->Html->css('/libs/jquery.mobile-1.0/jquery.mobile-1.0.min.css');
                echo $this->Html->css('trafikk');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="home" data-role="page">
		<div data-role="header">
			<h1><?php echo $title ?></h1>
		</div>
		<div data-role="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div data-role="footer" data-theme="a" data-position="fixed">
                    <a href="#settings" data-prefetch>Innstillinger</a>
                    <button id="run_update">Oppdater</button>
                </div>
	</div>
    <div id="settings" data-role="page">
        <div data-role="content">
            <p>Innholdet er i utgangspunktet begrenset i avstand for å sikre
                optimal ytelse. Hvis du har en kraftig mobil/nettbrett kan du 
                utvide avstanden for å se flere trafikkmeldinger.</p>
            <div data-role="fieldcontain">
                <label for="flip-range">Utvid avstand</label>
                <select name="slider" id="flip-range" data-role="slider" data-theme="a">
                    <option value="off">Av</option>
                    <option value="on">På</option>
                </select> 
            </div>
        </div>
        <div data-role="footer" data-theme="a" data-position="fixed">
            <a href="#home" data-rel="back">Tilbake</a>
        </div>
    </div>
    <div id="dialog" data-role="dialog" data-rel="dialog" data-transition="pop" data-theme="c">
        <div data-role="header" data-theme="d">
            <h1>Dialog</h1>
        </div>
        <div data-role="content">
            <p class="msg"></p>
            <a href="#home" data-transition="pop">Tilbake</a>
        </div>
    </div>
	<?php echo $this->element('sql_dump'); ?>
    <?php
        echo $this->Html->script('/libs/jquery-1.7.min.js'); 
        echo $this->Html->script('/libs/jquery.mobile-1.0/jquery.mobile-1.0.min.js'); 
        echo $this->Html->script('http://maps.googleapis.com/maps/api/js?sensor=true'); 
        echo $this->Html->script('trafikk');
     ?>
</body>
</html>