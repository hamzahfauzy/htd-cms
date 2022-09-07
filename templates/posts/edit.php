<?php load_templates('layouts/top') ?>
<?php load_templates('modal/file') ?>
    <div class="content">
        <div class="panel-header <?=config('theme')['panel_color']?>">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Buat <?=_ucwords(__($_GET['type_as']))?> Baru</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data <?=_ucwords(__($_GET['type_as']))?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    <a href="<?=routeTo('crud/index',['table'=>$table,'type_as'=>$_GET['type_as']])?>" class="btn btn-warning btn-round">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <?php if($success_msg): ?>
            <div class="alert alert-success"><?=$success_msg?></div>
            <?php endif ?>
            <form action="" method="post" id="postform">
            <div class="row row-card-no-pd">
                <div class="col-12">
                    <?php if($error_msg): ?>
                    <div class="alert alert-danger"><?=$error_msg?></div>
                    <?php endif ?>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                            foreach($fields as $key => $field): 
                                $label = $field;
                                $type  = "text";
                                if(is_array($field))
                                {
                                    $field_data = $field;
                                    $field = $key;
                                    $label = $field_data['label'];
                                    if(isset($field_data['type']))
                                    $type  = $field_data['type'];
                                }
                                $label = _ucwords(__($label));
                            ?>
                            <div class="form-group">
                                <label for=""><?=$label?></label>
                                <?= Form::input($type, $table."[".$field."]", ['class'=>"form-control","placeholder"=>$label,"value"=>$old[$field]??$data->{$field}]) ?>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for=""><?=_ucwords(__('status'))?></label>
                                <?= Form::input('options:Draft|Publish', "posts[status]", ['class'=>"form-control","placeholder"=>_ucwords(__('status')),"value"=>$old['status']??$data->status]) ?>
                            </div>
                            <div class="form-group">
                                <label class="form-label w-100"><?=ucwords(__('categories'))?></label>
                                <div class="selectgroup selectgroup-pills">
                                    <?php foreach($categories as $category): ?>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="categories[]" value="<?=$category->id?>" class="selectgroup-input" <?=in_array($category->id, $data->categories) ? 'checked' : ''?>>
                                        <span class="selectgroup-button"><?=$category->name?></span>
                                    </label>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""><?=_ucwords(__('thumbnail'))?></label>
                                <input type="hidden" name="posts[thumb_url]" id="thumb_url" value="<?=$data->thumb_url?>">
                                <div class="img-preview <?=$data->thumb_url?'':'d-none'?>" style="position:relative">
                                    <button type="button" class="btn btn-sm btn-danger" style="position:absolute;right:10px;top:10px;" onclick="removeThumb()"><i class="fas fa-trash"></i></button>
                                    <img src="<?=$data->thumb_url?>" alt="" class="thumb-img" style="width:100%;height:150px;object-fit:cover;">
                                </div>
                                <button class="btn btn-default btn-block" type="button" data-toggle="modal" data-target="#exampleModal" onclick="fetchFile()">Browse File</button>
                            </div>
                            <?php if($_GET['type_as'] == 'pages'): ?>
                            <div class="form-group">
                                <label for=""><?=_ucwords(__('template'))?></label>
                                <select name="posts[template]" id="" class="form-control">
                                    <?php foreach(templates() as $name => $value): ?>
                                    <option value="<?=$value?>" <?=$data->template==$value?'selected':''?>><?=$name?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="posts[template]" value="default.php">
                            <?php endif ?>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>