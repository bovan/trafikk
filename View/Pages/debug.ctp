<h1>Debug info</h1>

<?php if ($counter) : ?>
    <?php print $this->Html->tag('h2', $counter); ?>
<?php endif; ?>

<ul>
<?php foreach ($messages as $message): ?>
    <li><?php
        print $this->Html->tag('h3', $message->heading);
        print $this->Html->tag('span', $message->messageType);
        print $this->Html->tag('p', $message->ingress);
    ?>
    </li>
<?php endforeach; ?>
</ul>