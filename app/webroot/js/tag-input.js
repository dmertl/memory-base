(function($) {

	var methods = {
		init: function(options) {
			var settings = $.extend({
				"tags": []
			}, options);

			return this.each(function() {
				var $this = $(this),
						tag_list = methods._createListUiElement();

				//Attach event listener to input element
				$this.on('keyup', methods.onInputChange);

				//Insert tag list UI
				$this.after(tag_list);

				//Save reference to elements
				$this.data('tag-input', {
					'input': $this,
					'tagList': tag_list
				});

				//Add any tags passed in through options
				$this.tagInput('addTag', options.tags);
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
			return tag_list.find('li').map(function() {
				return $(this).html();
			});
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
