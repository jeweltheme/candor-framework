(function() {
    tinymce.create('tinymce.plugins.jwthmetiny', {
        init : function(ed, url) {
            ed.addCommand('shortcodeGenerator', function() {

                tb_show("Candor Framework Shortcodes", url + '/shortcodes.php?&width=630&height=400');

                
            });
            //Add button
            ed.addButton('jwthemescgenerator', {    title : 'Shortcodes', cmd : 'shortcodeGenerator', image : url + '/shortcode-icon.png' });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname  : 'Candor Framework TinyMCE',
                author    : 'Jewel Theme',
                authorurl : 'http://www.jeweltheme.com',
                infourl   : 'http://www.jeweltheme.com',
                version   :  tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
    tinymce.PluginManager.add('jwtheme_buttons', tinymce.plugins.jwthmetiny);
})();