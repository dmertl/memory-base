(function($) {

	var methods = {
		init: function(options) {
			var settings = $.extend({
				"tags": []
			}, options);

			return this.each(function() {
				var element = $(this);
				//Append UI to element
				element.append(methods._createUiContainerElement());
				//Add any tags passed in through options
				element.tagInput('addTag', options.tags);
			});
		},
		/**
		 * Add a tag
		 * @param tag
		 * @return {*}
		 */
		addTag: function(tag) {
			if(typeof tag === 'string') {
				tag = [tag];
			}
			var tag_list = this.find('.ti-tag-list');
			for(var i = 0; i < tag.length; i++) {
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
			return this.find('.ti-tag-list li').map(function() {
				return $(this).html();
			});
		},
		/**
		 * Event listener when input field changes
		 */
		onInputChange: function() {
			var e_this = $(this);
			var input_value = e_this.val();
			if(input_value) {
				var tags = methods._parseTagInput(input_value);
				if(tags.length) {
					e_this.closest('.ti-container').parent().tagInput('addTag', tags);
					//Remove completed tags from input
					e_this.val(input_value.replace(/[^,]+,/g, ''));
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
		_createUiContainerElement: function() {
			return $('<div class="ti-container"></div>')
					.append(methods._createLabelUiElement())
					.append(methods._createInputUiElement())
					.append(methods._createListUiElement());

		},
		_createLabelUiElement: function() {
			return $('<label for="ti-tag-input">Tags</label>');
		},
		_createInputUiElement: function() {
			return $('<input type="text" name="ti-tag-input" id="ti-tag-input" />')
					.on('keyup', methods.onInputChange);
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
