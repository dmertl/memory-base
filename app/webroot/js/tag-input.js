(function($) {

	var methods = {
		init: function(options) {
			var settings = $.extend( {
				"tags": []
			}, options);

			return this.each(function() {
				var element = $(this);
				//Append UI to element
				element.append(methods._createUiContainerElement());
				//Add any tags passed in through options
				for(var i = 0; i < options.tags.length; i++) {
					element.tagInput('addTag', options.tags[i]);
				}
			});
		},
		/**
		 * Add a tag
		 * @param name
		 * @return {*}
		 */
		addTag: function(name) {
			this.find('.ti-tag-list').append(methods._createTagUiElement(name));
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
			return $('<input type="text" name="ti-tag-input" id="ti-tag-input" />');
		},
		_createListUiElement: function() {
			return $('<ul class="ti-tag-list"></ul>');
		},
		_createTagUiElement: function(name) {
			return $('<li></li>').html(name);
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
