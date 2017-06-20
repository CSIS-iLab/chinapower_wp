(function() {
	tinymce.PluginManager.add('podcasts', function( editor, url ) {
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
	});
	tinymce.PluginManager.add('stats', function( editor, url ) {
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
	});
})();