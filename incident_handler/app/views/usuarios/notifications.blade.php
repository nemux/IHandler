<table class="table">
  <thead>
          <tr>
            <th >Fecha</th>
            <th>Mensaje</th>
          </tr>
  </thead>
      <tbody>
        
        <?php foreach ($notifications as $n): ?>
       
        
          <tr class="info">
              <td><?php echo $n->created_at ?> </td>
              <td><?php echo $n->content ?> </td>  
          </tr>
        <?php endforeach ?>
          
          
      </tbody>
</table>
<script type="text/javascript">
  //$("#count_notifications").text("")
</script>
