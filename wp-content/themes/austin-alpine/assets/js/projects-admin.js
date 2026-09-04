/**
 * Project Photos meta box: media-modal picker, drag reorder, inline alt text.
 *
 * The hidden input holding the comma-separated attachment IDs is the single
 * source of truth; every interaction rewrites it from the DOM order so the
 * saved order always matches what the editor sees.
 */
(function ($) {
	'use strict';

	var strings = window.alpineProjectGallery || {};

	function t(key, fallback) {
		return strings[key] || fallback;
	}

	$(function () {
		var $box = $('[data-alpine-gallery]');

		if (!$box.length) {
			return;
		}

		var $list = $box.find('[data-alpine-gallery-list]');
		var $input = $box.find('[data-alpine-gallery-input]');
		var $empty = $box.find('[data-alpine-gallery-empty]');
		var $clear = $box.find('[data-alpine-gallery-clear]');
		var frame;

		function currentIds() {
			return $list
				.find('[data-alpine-gallery-item]')
				.map(function () {
					return parseInt($(this).data('id'), 10);
				})
				.get()
				.filter(function (id) {
					return !isNaN(id);
				});
		}

		function sync() {
			var ids = currentIds();
			$input.val(ids.join(','));
			$empty.prop('hidden', ids.length > 0);
			$clear.prop('hidden', ids.length === 0);
		}

		function buildItem(attachment) {
			var id = attachment.id;
			var alt = attachment.alt || '';
			// Prefer the small thumbnail; fall back to the full URL for sizes
			// WordPress has not generated (SVG, very small uploads).
			var thumb =
				(attachment.sizes && attachment.sizes.thumbnail && attachment.sizes.thumbnail.url) ||
				(attachment.sizes && attachment.sizes.full && attachment.sizes.full.url) ||
				attachment.url;

			var $item = $('<li/>', {
				'class': 'alpine-gallery-item',
				'data-alpine-gallery-item': '',
				'data-id': id
			});

			$('<span/>', { 'class': 'alpine-gallery-handle', title: t('reorder', 'Drag to reorder') })
				.append($('<span/>', { 'class': 'dashicons dashicons-menu' }))
				.appendTo($item);

			$('<img/>', { 'class': 'alpine-gallery-thumb', src: thumb, alt: '', width: 80, height: 80 }).appendTo($item);

			var $fields = $('<span/>', { 'class': 'alpine-gallery-fields' });
			var inputId = 'alpine-alt-' + id;

			var $label = $('<label/>', { 'class': 'alpine-gallery-label', 'for': inputId }).text(
				t('altLabel', 'Alt text') + ' '
			);

			$('<span/>', { 'class': 'alpine-gallery-alt-warning' })
				.text(t('altWarning', '— empty, please describe this photo'))
				.prop('hidden', alt.trim() !== '')
				.appendTo($label);

			$label.appendTo($fields);

			$('<input/>', {
				type: 'text',
				id: inputId,
				'class': 'widefat alpine-gallery-alt',
				name: 'alpine_project_alt[' + id + ']',
				value: alt,
				placeholder: t('altPlace', 'Describe what this photo shows')
			}).appendTo($fields);

			$fields.appendTo($item);

			$('<button/>', { type: 'button', 'class': 'button-link alpine-gallery-remove', 'data-alpine-gallery-remove': '' })
				.append($('<span/>', { 'class': 'dashicons dashicons-no-alt' }))
				.append($('<span/>', { 'class': 'screen-reader-text' }).text(t('remove', 'Remove this photo')))
				.appendTo($item);

			return $item;
		}

		/* --- Media modal --- */
		$box.on('click', '[data-alpine-gallery-add]', function (event) {
			event.preventDefault();

			if (!frame) {
				frame = wp.media({
					title: t('title', 'Select project photos'),
					button: { text: t('button', 'Add to gallery') },
					library: { type: 'image' },
					multiple: 'add'
				});

				frame.on('select', function () {
					var existing = currentIds();

					frame
						.state()
						.get('selection')
						.map(function (model) {
							var attachment = model.toJSON();

							// Skip anything already in the gallery rather than duplicating it.
							if (existing.indexOf(attachment.id) !== -1) {
								return;
							}

							existing.push(attachment.id);
							$list.append(buildItem(attachment));
						});

					sync();
				});
			}

			frame.open();
		});

		/* --- Remove one --- */
		$box.on('click', '[data-alpine-gallery-remove]', function (event) {
			event.preventDefault();
			$(this).closest('[data-alpine-gallery-item]').remove();
			sync();
		});

		/* --- Remove all --- */
		$box.on('click', '[data-alpine-gallery-clear]', function (event) {
			event.preventDefault();

			if (!window.confirm(t('confirm', 'Remove all photos from this project gallery?'))) {
				return;
			}

			$list.empty();
			sync();
		});

		/* --- Live alt-text warning --- */
		$box.on('input', '.alpine-gallery-alt', function () {
			$(this)
				.closest('[data-alpine-gallery-item]')
				.find('.alpine-gallery-alt-warning')
				.prop('hidden', $(this).val().trim() !== '');
		});

		/* --- Drag to reorder --- */
		$list.sortable({
			handle: '.alpine-gallery-handle',
			placeholder: 'alpine-gallery-placeholder',
			forcePlaceholderSize: true,
			axis: 'y',
			update: sync
		});

		sync();
	});
})(jQuery);
