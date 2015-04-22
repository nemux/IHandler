<div class="col-md-12" style="min-width:800px;">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Ocurrencias por IP <i><?php echo $occurence_type?></i></h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover  ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>IP</th>
                        <th>Cantidad de Ocurrencias</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($ips as $ip): ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $ip->ip_rgx; ?></td>
                        <td><?php echo $ip->total; ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <a class="btn btn-primary"
                   href="/stats/ip/ie/doc/?s=<?php echo $start; ?>&e=<?php echo $end; ?>&t=<?php echo $ip_type; ?>&c=<?php echo $customer; ?>"
                   target="blank"><i
                            class="fa fa-file-word-o"></i>Generar doc</a>
            </div>
        </div>
    </div>
    <!-- end panel -->
</div>
<script>
    $(document).ready(function () {

        TableManageDefault.init();


    });
</script>