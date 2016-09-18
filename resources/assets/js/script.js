
// --------------------------------
// Сортировка списков:
// --------------------------------
var changePosition = function(requestData, action) {
    $.ajax({
        'url': action,
        'type': 'POST',
        'data': requestData,
        'success': function(data) {
            if (! data.success) {
                console.error(data.errors);
            }
        },
        'error': function() {
            console.error('Order change failed!');
        }
    });
};
function sortableMove(a, b, entityName, action) {
    var $sorted = b.item;

    var $previous = $sorted.prev();
    var $next = $sorted.next();

    if ($previous.length > 0) {
        changePosition({
            parentId: $sorted.data('parent-id'),
            type: 'moveAfter',
            entityName: entityName,
            id: $sorted.data('item-id'),
            positionEntityId: $previous.data('item-id')
        }, action);
    } else if ($next.length > 0) {
        changePosition({
            parentId: $sorted.data('parent-id'),
            type: 'moveBefore',
            entityName: entityName,
            id: $sorted.data('item-id'),
            positionEntityId: $next.data('item-id')
        }, action);
    } else {
        console.error('Something wrong!');
    }
}

$(document).ready(function() {

    // --------------------------------
    // Добавление CSRF-токена в заголовки jQuery запросов:
    // --------------------------------
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // --------------------------------
    // Обратный отсчёт:
    // --------------------------------
    $('.trade-list-countdown').each(function() {
        $(this).countdown($(this).data('countdown-to'), function(event) {
            $(this).html(event.strftime('%I:%M:%S'));
        });
    });

    // --------------------------------
    // Датавремяпикер:
    // --------------------------------
    $('.datetimepicker').datetimepicker({
        lang: 'ru',
        timepicker: true,
        format: 'd.m.Y H:i',
        startDate: new Date()
    });

    // --------------------------------
    // Исчезновение сообщений через промежуток времени:
    // --------------------------------
    var $topAlerts = $('.alert:not(.do-not-disappear)');
    if ($topAlerts.length) {
        window.setTimeout(function() {
            $topAlerts.fadeOut();
        }, 5000);
    }

    //--------------------------------
    // Автоподстройка высоты textarea:
    //--------------------------------
    autosize($('textarea:not(.not-resized)'));

    // --------------------------------
    // Модальные окна:
    // --------------------------------
    // Подтверждение действия:
    $('#modalConfirm').on('show.bs.modal', function (event) {
        var $button       = $(event.relatedTarget),
            link          = $button.data('link'),
            formId        = $button.data('form'),
            method        = $button.data('method') ? $button.data('method') : 'post',
            $modal        = $(this),
            $form         = $modal.find('#modalConfirmForm'),
            $submitButton = $form.find('button[type=submit]');

        if (formId && formId.length) {
            $submitButton.attr('form', formId);
        } else {
            $form.attr('action', link);
            $form.attr('method', method);
        }
    });

    // --------------------------------
    // Сортировка списков:
    // --------------------------------
    var $sortableBlock = $('.sortable');
    if ($sortableBlock.length > 0) {
        $sortableBlock.sortable({
            handle: '.list-group-handler',
            axis: 'y',
            update: function(a, b){
                sortableMove(a, b, $(this).data('entity'), $sortableBlock.data('action'));
            },
            placeholder: "list-placeholder",
            cursor: "move"
        });
    }
    var $sortableImgBlock = $('.img-sortable');
    if ($sortableImgBlock.length > 0) {
        $sortableImgBlock.sortable({
            handle: '.img-handle',
            update: function(a, b){
                sortableMove(a, b, $(this).data('entity'), $sortableBlock.data('action'));
            },
            placeholder: "list-placeholder",
            cursor: "move"
        });
    }

    // --------------------------------
    // Подсказки:
    // --------------------------------
    $('[data-toggle="tooltip"]').tooltip()
});