<script type="text/javascript">
<?php foreach ($alerts as $n): ?>
						$.gritter.add({
							title:"<?php echo $n->created_at ?>",
							text:"<a onmouseover='readed(<?php echo $n->id ?>)' href='/incident/view/<?php echo $n->incidents_id ?>'>Comentario sobre incidente<br><?php echo $n->incident->title ?></a>",
							image:"/assets/img/handler.png",
							sticky:true,
							time:"",
							class_name:"my-sticky-class"
						});
					<?php endforeach ?>

</script>