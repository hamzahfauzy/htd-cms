<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body file-data">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function fetchFile(page = 1)
{
    fetch('<?=routeTo('api/v1/file')?>?page='+page+'&type_as=image')
    .then(res => res.json())
    .then(res => {
        var elFileData = document.querySelector('.file-data')
        var fileDataHtml = '<div class="row">'
        // document.querySelector('.file-data').innerHTML = JSON.stringify(res)
        res.datas.forEach(d => {
            if(!d.file_type.includes('image') == -1) return

            fileDataHtml += `<div class="col-sm-6 col-md-3">`
            fileDataHtml += `<img src="${d.file_url}" alt="${d.file_name}" class="w-100" style="height:150px;object-fit:cover;">`
            
            fileDataHtml += `<br>
                                    <p align="center">${d.file_name}</p>
                                    <div class="row">
                                        <button href="${d.file_url}" onclick="pilih('${d.file_url}')" class="btn btn-success col m-2"><i class="fas fa-eye"></i> Pilih</button>
                                    </div>
                                </div>`
        })
        fileDataHtml += `</div>
                            <div class="row mt-5">
                                <div class="col-12">`
        if(res.pagination.is_prev)
        {
            fileDataHtml += `<button class="btn btn-outline btn-success">Sebelumnya</button>`
        }
        if(res.pagination.is_next)
        {
            fileDataHtml += `<button class="btn btn-outline btn-success">Selanjutnya</button>`
        }
        fileDataHtml += `</div>
                            </div>`

        elFileData.innerHTML = fileDataHtml
    })
}

function pilih(file_url)
{
    var thumb_url_input = document.querySelector('#thumb_url')
    thumb_url_input.value = file_url
    document.querySelector('.img-preview').classList.remove('d-none')
    var img = document.querySelector('.thumb-img')
    img.src = file_url
    $('#exampleModal').modal("hide")
}

function removeThumb()
{
    document.querySelector('#thumb_url').value = ""
    document.querySelector('.img-preview').classList.add('d-none')
    var img = document.querySelector('.thumb-img')
    img.src = ""
}
</script>