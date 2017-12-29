var photo_counter = 0;
var token       = $('input[name=_token]').val();

var urlDomain   = 'http://' + window.location.host;
var pathname    = window.location.pathname.split('/');
var urldelete   = urlDomain + '/' + pathname[1] + '/iblog/category/delete/img';


Dropzone.options.realDropzone = {
    uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 8,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Eliminar',
    dictFileTooBig: 'Imagen no mayor a 8MB',
    acceptedFiles: '.png,.jpg,.gif,.bmp,.jpeg',
    // The setting up of the dropzone
    init: function() {
        this.on("removedfile", function(file) {
            var dirdata = file.dirData;
            var iddata  = file.idData;
            $.ajax({
                type: 'post',
                url: urldelete,
                data: {
                    dirdata: dirdata,
                    iddata: iddata,
                    idedit : $('#idedit').val(),
                    _token: $('input[name=_token]').val()
                },
                dataType: 'html',
                success: function(data) {
                    var rep = JSON.parse(data);
                    if (rep.success) {
                        photo_counter--;
                        $("#photoCounter").text("(" + photo_counter + ")");
                    }
                }
            });
        });
    },
    error: function(file, response) {
        if ($.type(response) === "string") var message = response; //dropzone sends it's own error messages in string
        else var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function(file, done) {
      //  $('#' + file.idDeleteelement).attr('dir-data', done.direccion);
      //  $('#' + file.idDeleteelement).attr('id-data', done.id);
        photo_counter++;
        $("#photoCounter").text("(" + photo_counter + ")");
    }
}
$(document).ready(function() {
    jQuery.deleteFile = function(element) {
        var dirdata = $(element).attr('dir-data');
        var iddata = $(element).attr('id-data');
        $.ajax({
            type: 'post',
            url: urldelete,
            data: {
                dirdata: dirdata,
                iddata: iddata,
                _token: $('input[name=_token]').val()
            },
            dataType: 'html',
            success: function(data) {
                var rep = JSON.parse(data);
                if (rep.success) {
                    photo_counter--;
                    $("#photoCounter").text("(" + photo_counter + ")");
                    $(element).parent().remove();
                }
            }
        });
    }
});