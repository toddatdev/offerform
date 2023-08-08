CKEDITOR.editorConfig = function (config) {
    config.toolbar = 'toolbarLight';
    config.uiColor = '#4F405b';
    config.startupFocus = false;
    config.removePlugins = 'exportpdf,stylescombo,showborders,magicline';
    config.removeButtons = '';
    config.extraPlugins = 'link,placeholder,justify,colorbutton,uicolor,pastetools';
    config.skin = 'moono-lisa';
    config.extraAllowedContent = 'span{*},ul{*},li{*}';
    config.toolbar_toolbarLight =
        [
            [
                'Format',
                'NumberedList',
                'BulletedList',
            ],
            [
                'JustifyLeft',
                'JustifyCenter',
                'JustifyRight',
                'JustifyBlock',
            ],
            [
                'Link',
                'Unlink',
            ],
            [
                'Bold',
                'Italic',
                'Underline',
            ],
            [
                'Undo',
                'Redo',
            ],
            [
                'TextColor',
                'BGColor',
            ],
            [
                'CreatePlaceholder'
            ],
            [
                'RemoveFormat',
            ],
        ];

    config.format_tags = 'Large;Medium;Normal';
    config.format_Large = {name: 'Large', element: 'h3'};
    config.format_Medium = {name: 'Medium', element: 'h4'};
    config.format_Normal = {name: 'Normal', element: 'p'};
    config.title = false;
};

CKEDITOR.on("instanceReady", function(event) {
    event.editor.on("beforeCommandExec", function(event) {
        // Show the paste dialog for the paste buttons and right-click paste
        if (event.data.name == "paste") {
            event.editor._.forcePasteDialog = true;
        }
        // Don't show the paste dialog for Ctrl+Shift+V
        if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
            event.cancel();
        }
    })
});


CKEDITOR_CONFIGS = {
    'default':{
        'toolbar': 'default',
        'colorButton_colors': '008000,454545,FFF',
        'colorButton_enableMore': false,
}
}



// CKEDITOR.on("instanceReady", function(event) {
//     event.editor.on("beforePaste", function(event) {
//         event.editor._.forcePasteDialog = true;
//     })
// })

// CKEDITOR.on("instanceReady", function(event) {
//     event.editor.on("beforeCommandExec", function(event) {
//         // Show the paste dialog for the paste buttons and right-click paste
//         if (event.data.name == "paste") {
//             event.editor._.forcePasteDialog = true;
//         }
//         // Don't show the paste dialog for Ctrl+Shift+V
//         if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
//             event.cancel();
//         }
//     })
// });

