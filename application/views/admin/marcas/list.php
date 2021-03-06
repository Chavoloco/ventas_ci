
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Marcas
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>mantenimiento/marcas/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Marca</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($marcas)):?>
                                    <?php foreach($marcas as $marcas):?>
                                        <tr>
                                            <td><?php echo $marcas->id;?></td>
                                            <td><?php echo $marcas->nombre;?></td>
                                            <?php $datamarcas = $marcas->id."*".$marcas->nombre;?> 
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view-marcas" data-toggle="modal" data-target="#modal-default" value="<?php echo $datamarcas?>">
                                                        <span class="fa fa-search"></span>
                                                    </button>
                                                    <a href="<?php echo base_url()?>mantenimiento/marcas/edit/<?php echo $marcas->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <a href="<?php echo base_url();?>mantenimiento/marcas/delete/<?php echo $marcas->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /fin.box-body -->
        </div>
        <!-- /fin.box -->
    </section>
    <!-- /fin.content -->
</div>
<!-- /fin.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Marca</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- fin.modal-content -->
  </div>
  <!-- fin.modal-dialog -->
</div>
<!-- fin.modal -->
