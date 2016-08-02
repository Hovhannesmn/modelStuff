tinymce.PluginManager.add('cms', function(editor, url) {

    editor.addButton('row', {
        text: 'Row',
        icon: false,
        onclick: function() {
            editor.insertContent('<div class="row">Click to edit content</div>...');
        }
    });

    editor.addButton('col', {
        text: 'Col',
        icon: false,
        onclick: function() {
        	editor.windowManager.open({
                title: 'Insert column:',
                body: [
                    {type: 'listbox', name: 'width', label: 'Select column width:', values: [
                    	{text:'1/1', value: '12'}, 
                    	{text:'1/2', value: '6'},
                    	{text:'1/3', value: '4'}, 
                    	{text:'1/4', value: '3'},
                    	{text:'2/3', value: '8'}, 
                    	{text:'3/4', value: '9'}
                    ]}
                ],
                onsubmit: function(e) {
                    editor.insertContent('<div class="col-sm-'+e.data.width+'">Click to edit content</div>');
                }
            });
        }
    });
});
