<div class="modal fade in" id="modalConfirm" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="max-width: 250px">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <span class="fs-17">Вы уверены?</span>
            </div>
            <div class="modal-footer t-a-l">
                <form action="#" method="post" id="modalConfirmForm" style="display: inline-block;">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary">Да</button>
                </form>
                <button type="button" class="btn btn-link" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>
