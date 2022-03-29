//TinyMCE editor
      tinymce.init({
        selector: '#Spara',
        plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker link image code',
        toolbar: 'checklist export pageembed table, floating, bullist numlist, link, undo redo | image code',
        branding: false,
        height : "500px",
        file_picker_types: 'file image media',

        images_upload_url: 'imageupload.php',//Bildhantering i editorn med hjälp av TinyMCE

// override default upload handler to simulate successful upload
images_upload_handler: function (blobInfo, success, failure) {
    var xhr, formData;

    xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', 'imageupload.php');

    xhr.onload = function() {
        var json;

        if (xhr.status != 200) {
            failure('HTTP Error: ' + xhr.status);
            return;
        }

        json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + xhr.responseText);
            return;
        }

        success(json.location);
    };

    formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

    xhr.send(formData);
},
      });
