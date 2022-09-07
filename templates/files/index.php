<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header <?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"><?=_ucwords(__('files'))?></h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords(__('files'))?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <button class="btn btn-secondary btn-round" onclick="document.querySelector('.upload-form').classList.remove('d-none')"><?=_ucwords(__('uploads'))?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5 d-none upload-form">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" id="postform">
                                <div class="form-group">
                                    <label for="">File</label>
                                    <input type="file" name="files[]" id="" multiple>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if(!empty($datas) || count($datas)): ?>
                            <div class="row">
                                <?php foreach($datas as $data): ?>
                                <div class="col-sm-6 col-md-3">
                                    <?php if(startWith($data->file_type,'image')): ?>
                                    <img src="<?=$data->file_url?>" alt="<?=$data->file_name?>" class="w-100" style="height:200px;object-fit:cover;">
                                    <?php else: ?>
                                    <h2>
                                        <i class="fas fa-file"></i>
                                    </h2>
                                    <?php endif ?>
                                    <br>
                                    <p align="center"><?=$data->file_name?></p>
                                    <div class="row">
                                        <a href="<?=$data->file_url?>" target="_blank" class="btn btn-success col m-2"><i class="fas fa-eye"></i> Lihat</a>
                                        <a href="<?=routeTo('files/delete',['id'=>$data->id])?>" onclick="if(confirm('Apakah anda yakin akan menghapus file ini ?')){return true}else{return false}" class="btn btn-danger col m-2"><i class="fas fa-trash"></i> Hapus</a>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <?php if($pagination['is_prev']): ?>
                                    <a href="<?=routeTo('files/index',['page'=>$page-1])?>" class="btn btn-outline btn-success">Sebelumnya</a>
                                    <?php endif ?>
                                    <?php if($pagination['is_next']): ?>
                                    <a href="<?=routeTo('files/index',['page'=>$page+1])?>" class="btn btn-outline btn-success">Selanjutnya</a>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="row">
                                <div class="col-12">
                                    <center><i>Tidak ada data!</i></center>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>