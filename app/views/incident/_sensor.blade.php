Incidentes con severidad <?php echo $severity ?>:<br>
<ul>
  <?php foreach ($incident as $i): ?>
    <?php if (isset($i->ticket->internal_number)): ?>
    <li><?php echo $i->title ?> <?php echo $i->ticket->internal_number ?>
    </li>
    <?php endif ?>
  <?php endforeach ?>
</ul>
