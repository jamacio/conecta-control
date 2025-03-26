<div class="modal fade" id="filePickerModal" tabindex="-1" aria-labelledby="filePickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pb-0" id="filePickerModalLabel">Alterar Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="profile-pic-form" name="profile-pic-form" action="" method="POST">
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagem de Perfil</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <p class="text-danger" id="image-error"></p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-3">Atualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>