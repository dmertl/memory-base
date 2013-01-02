/**
 * jQuery TagInput plugin.
 * Adds delicious style tag entry to an input element.
 * @author David Mertl <dmertl@gmail.com>
 */
(function($) {

	var methods = {
		init: function(options) {
			var settings = $.extend({
				"tags": []
			}, options);

			//Add listener to form submit
			this.closest('form').on('submit', methods.onFormSubmit);

			return this.each(function() {
				var $this = $(this),
						tag_list = methods._createListUiElement();

				//Attach key up event listener to input element
				$this.on('keyup', methods.onInputChange);

				//Attach blur event listener to input element
				$this.on('blur', methods.onInputBlur);

				//Add tag input class to input element
				$this.addClass('ti-tag-input');

				//Insert tag list UI
				$this.after(tag_list);

				//Save reference to elements
				$this.data('tag-input', {
					'input': $this,
					'tagList': tag_list
				});

				//Add any tags passed in through options
				$this.tagInput('addTag', settings.tags);
			});
		},
		/**
		 * Add a tag
		 * @param tag
		 * @return {*}
		 */
		addTag: function(tag) {
			var tag_list = $(this).data('tag-input')['tagList'];
			if(typeof tag === 'string') {
				tag = [tag];
			}
			for(var i = 0; i < tag.length; i++) {
				//Add tag if it does not already exist
				if(!tag_list.find('li[title="' + tag[i] + '"]').length) {
					tag_list.append(methods._createTagUiElement(tag[i]));
				}
			}
			return this;
		},
		/**
		 * Get a list of tags
		 * @return Array
		 */
		getTags: function() {
			var tag_list = $(this).data('tag-input')['tagList'];
			return $.makeArray(tag_list.find('li').map(function() {
				return $(this).html();
			}));
		},
		/**
		 * Event listener when input field changes
		 */
		onInputChange: function() {
			var $this = $(this),
				input_value = $this.val();

			if(input_value) {
				var tags = methods._parseTagInput(input_value);
				if(tags.length) {
					$this.tagInput('addTag', tags);
					//Remove completed tags from input
					$this.val(input_value.replace(/[^,]+,/g, ''));
				}
			}
		},
		/**
		 * Event listener when input field blurs
		 */
		onInputBlur: function() {
			var $this = $(this);
			if($this.val()) {
				$this.tagInput('addTag', $this.val()).val('');
			}
		},
		/**
		 * Event listener when input field's form is submitted
		 */
		onFormSubmit: function(e) {
			$(this).find('input.ti-tag-input').each(function() {
				$(this).val($(this).tagInput('getTags').join(', '));
			});
		},
		_parseTagInput: function(input) {
			//Simple tag matching using regex
			var matches = input.match(/[^,]+,/g);
			if(matches) {
				return matches.map(function(n) { return n.replace(',', '').trim(); });
			} else {
				return [];
			}
		},
		_createListUiElement: function() {
			return $('<ul class="ti-tag-list"></ul>');
		},
		_createTagUiElement: function(name) {
			return $('<li></li>').prop('title', name).html(name);
		}
	};

	$.fn.tagInput = function(method) {
		if(methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if(typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.tagInput');
			return this;
		}
	};

})(jQuery);
