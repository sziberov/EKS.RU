app.upload = function(opt) {
    var settings = {
        upload_url: '',
        container: '',
        browse_button: '',
        drop_element: '',
        cb_start: function() {},
        cb_ready: function(f,data) { console.log(f, data); },
        cb_progress: function() {},
        cb_added: function() {},
        cb_before: function(up, file) {
            // up.settings.multipart_params.time = Math.round(Date.parse(file.lastModifiedDate) / 1000);
            // console.log(up, file);
        },
        cb_error: function(err) { console.log(err.message); },
        destroy: false,
        file_data_name: 'file',
        runtimes: 'html5,flash,silverlight,browserplus',
        multipart_params: {
			key: null,
			dpr: (window.devicePixelRatio || 1)
		},
        max_file_size: '1000Gb',
        res_type: 'text'
    };

    opt = $.extend(true, settings, opt);

    var uploader = new plupload.Uploader({
        runtimes: opt.runtimes,
        browse_button: opt.browse_button,
        container: opt.container,
        drop_element: opt.drop_element,
        multi_selection: true,
        file_data_name: opt.file_data_name,
        required_features : 'send_browser_cookies',
        url: opt.upload_url,
        flash_swf_url   : '/js/Moxie.swf',
        silverlight_xap_url : '/js/Moxie.xap',
        filters: {
            max_file_size: opt.max_file_size
        },
        multipart_params: opt.multipart_params
    });

    // uploader.bind('Init', function(up, params) {
    //     console.log( up, params );
    // });

    uploader.init();

    uploader.bind('FilesAdded', function(up, files) {
        opt.cb_added(files);
        up.refresh();
        uploader.start();
    });

    uploader.bind('UploadFile', function(up,file) {
        opt.cb_start(up, file);
    });

    uploader.bind('UploadProgress', function(up, file) {
        opt.cb_progress(file);
    });


    uploader.bind('BeforeUpload', function(up, file) {
        opt.cb_before(up, file);
    });

    uploader.bind('Error', function(up, error) {
        
        console.log(error);
        alert('Ошибка загрузки файла');

        // if (error.code == plupload.HTTP_ERROR) {
        //     u.setProgressText(error.file, 'Ошибка.');
        // } else if (error.code == plupload.FILE_SIZE_ERROR) {
        //     alert(window.alerts.TO_BIG_FILE);
        // }

        opt.cb_error(error);
        up.refresh();
    });

    uploader.bind('FileUploaded', function(up, file, res) {
        if( res.status == 200 ) {
            var data = res.response;
            if(opt.res_type == 'json') data = $.parseJSON( data );            
            opt.cb_ready(file, data);
        }
        else {
            opt.cb_error();
        }
    });

    uploader.removeQueuedFile = function(file) {
        var id = typeof(file) === 'string' ? file : file.id;

        for (var i = this.files.length - 1; i >= 0; i--)
        {
            if (this.files[i].id === id)
            {
                var removed = this.files.splice(i, 1);

                var restartRequired = false;

                if (removed[0].status == plupload.UPLOADING && this.state == plupload.STARTED)
                {
                    restartRequired = true;
                    this.stop();
                }

                this.trigger("FilesRemoved", removed);

                removed[0].destroy();

                this.trigger("QueueChanged");
                this.refresh();

                if (restartRequired)
                {
                    this.start();
                }
                return removed[0];
            }
        }
    };

    return uploader;
}