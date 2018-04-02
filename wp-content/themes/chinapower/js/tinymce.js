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

		editor.addButton('fullWidth', {
			text: 'FullWidth',
			icon: null,
			tooltip: 'Insert Full Width',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert Full Width',
					width: 600,
					minHeight: 200,
					body: [
					{
						type: 'textbox',
						multiline: false,
						name: 'maxWidth',
						label: 'Max Width',
						placeholder: 'Insert Max Width'
					},
					{
						type: 'textbox',
						multiline: true,
						name: 'content',
						label: 'Full Width Content',
						placeholder: 'Insert the content you want to display at full width here.',
						minHeight: 125
					}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[fullWidth width="' + e.data.maxWidth + '"][/fullWidth]');
					}
				});
			}
		});

		editor.addButton('view-post', {
			text: 'View Post',
			icon: null,
			tooltip: 'Insert View Post Container',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert View Post Container',
					width: 600,
					minHeight: 200,
					body: [
						{
							type: 'textbox',
							multiline: false,
							name: 'title',
							label: 'Title',
							placeholder: 'LEARN MORE'
						},
						{
							type: 'listbox',
							name: 'id',
							label: 'Post',
							values: tinyMCE_posts
						}
					],
					onsubmit: function( e ) {
						var titleAttr = ''
						if ( e.data.title ) {
							titleAttr = ' title="' + e.data.title + '"'
						}
						editor.insertContent( '[view-post id="' + e.data.id + '"' + titleAttr + ']' );
					}
				});
			}
		});

	});
})();
