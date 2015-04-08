Incidentes con severidad <?php echo $severity ?>:<br>
<ul>
  <?php foreach ($incidents as $i): ?>
    <?php $in=Incident::find($i->id) ?>
    <?php if (isset($in->ticket->internal_number)): ?>
      <li><?php echo $in->title ?> <?php echo $in->ticket->internal_number ?></li>
    <?php endif ?>
  <?php endforeach ?>
</ul>
