(function() {
	tinymce.PluginManager.add('chinapower', function( editor, url ) {
		editor.addButton('podcasts', {
			text: null,
			icon: 'icon dashicons-format-audio',
			tooltip: 'Insert Podcast Embed',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert Podcast Embed',
					width: 400,
					height: 100,
					body: [
						{
							type: 'listbox',
							name: 'listboxName',
							label: null,
							values: tinyMCE_podcasts
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[podcast id="' + e.data.listboxName + '"]');
					}
				});
			}
		});

		editor.addButton('stats', {
			text: null,
			icon: 'icon dashicons-chart-area',
			tooltip: 'Insert Stat',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert Number for Featured Statistic',
					width: 400,
					height: 100,
					body: [
						{
							type: 'textbox',
							name: 'stat'
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[stat]' + e.data.stat + '[/stat]');
					}
				});
			}
		});

		editor.addButton('view', {
			text: null,
			icon: 'icon dashicons-external',
			tooltip: 'Insert View link for Data Sources',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert View Link for Data Sources',
					width: 400,
					height: 100,
					body: [
						{
							type: 'textbox',
							name: 'url',
							label: 'URL'
						},
						{
		                    type   : 'checkbox',
		                    name   : 'external',
		                    label  : 'External Link?',
		                    checked : false
		                },
					],
					onsubmit: function( e ) {
						editor.insertContent( '[view url="'+e.data.url+'" external="'+e.data.external+'"]');
					}
				});
			}
		});

		editor.addButton('cpp', {
			text: 'CPP',
			icon: null,
			tooltip: 'Insert CPP Image',
			onclick: function() {
				editor.insertContent( '[cpp]');
			}
		});

		editor.addButton('note', {
			text: 'Footnote',
			icon: null,
			tooltip: 'Insert Footnote',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert Footnote Content',
					width: 400,
					height: 100,
					body: [
						{
							type: 'textbox',
							multiline: true,
							name: 'note'
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[note]' + e.data.note + '[/note]');
					}
				});
			}
		});
	});
})();