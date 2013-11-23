(function() {
        tinymce.create('tinymce.plugins.DNSIpsum', {
                init : function(ed, url) {
                        ed.addButton('DNSIpsum', {
                                title : 'DNSIpsum Lorem Ipsum Generator',
                                cmd : 'DNSIpsum',
                                image : url + '/DNSIpsum.png',
                        });
                        ed.addCommand('DNSIpsum', function() {
                            var number = prompt("How many paragraphs of lorem ipsum text would you like to add? "),
                                shortcode;
                            if (number !== null) {
                                number = parseInt(number);
                                if (number > 0 && number <= 20) {
                                    shortcode = '[dns-ipsum amount="' + number + '"/]';
                                    ed.execCommand('mceInsertContent', 0, shortcode);
                                }
                                else {
                                    alert("The number value is invalid. It should be between 0 to 20.");
                                }
                            }
                        });                        
                },
 
                getInfo : function() {
                        return {
                                longname : 'DNSIpsum Lorem Ipsum Generator',
                                author : 'Due North Studios, LLC',
                                authorurl : 'http://duenorthstudios.com',
                                infourl : 'http://duenorthstudios.com',
                                version : "1.0"
                        };
                }
        });
 
        tinymce.PluginManager.add('DNSIpsum', tinymce.plugins.DNSIpsum);
})();