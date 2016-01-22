/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {

    config.toolbarGroups = [
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
        {name: 'forms', groups: ['forms']},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'styles', groups: ['styles']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
        {name: 'links', groups: ['links']},
        {name: 'insert', groups: ['insert']},
        {name: 'colors', groups: ['colors']},
        {name: 'tools', groups: ['tools']},
        {name: 'others', groups: ['others']},
        {name: 'about', groups: ['about']}
    ];

    config.removeButtons = 'Save,NewPage,Form,HiddenField,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,About,Flash,Table,CreateDiv,BidiLtr,BidiRtl,Outdent,Indent,Language,Smiley,PageBreak,Iframe';

    // Define changes to default configuration here. For example:
    config.language = 'es';
    // config.uiColor = '#AADC6E';
    config.skin = 'moonocolor';

    config.height = 300;

    //To detects whenever the content is changed
    //config.extraPlugins = 'onchange';
};
