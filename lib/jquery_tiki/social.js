(function ($) {
	var 
		sortFriends = function () {
			$('.friend-list').each(function () {
				$(this).sortList();
			});
		},
		reload = function (control) {
			$('.friend-container').each(function () {
				var $container = $(this);
				var action = $container.data('action');
				var controller = $container.data('controller');
				var params = $container.data('params') || {};
				$container.parent().modal(tr("Loading..."));
				$container.parent().load($.service(controller, action, params), function () {
					$(this).modal();
					sortFriends();
				});
			});
		};

	$(document).on('click', 'button.add-friend', function () {
		var control = this;
		$(this).serviceDialog({
			title: $(this).text(),
			controller: 'social',
			action: 'add_friend',
			success: function () {
				reload(control);
			}
		});
	});
	$(document).on('click', '.request-list .add-friend, .request-list .approve-friend,' +
				' .user-info .add-friend, .user-info .approve-friend', function (e) {
		var control = this;
		e.preventDefault();
		$.post($(control).attr('href'), function () {
			reload(control);
		});

		return false;
	});
	$(document).on('click', ' .remove-friend', function (e) {
		var control = this;
		e.preventDefault();

		$(this).doConfirm({
			success: function () {
				reload(control);
			}
		});

		return false;
	});

	$(sortFriends);
})(jQuery);

(function ($) {
	var createReload = function (link) {
		var activity = $(link).closest('.activity'), container = activity.parent(), id = activity.data('id');

		return function () {
			container.load($.service('object', 'infobox', {
				type: 'activity',
				object: id,
				plain: 1
			}));
		};
	};
	$(document).on('click', '.activity a.comment', function () {
		var myReload = createReload(this);
		$(this).serviceDialog({
			title: $(this).text().replace(/\(\d+\)/, ''),
			load: function () {
				var container = this;
				$('.confirm-prompt', this).requireConfirm({
					success: function () {
						$(container).reload();
					}
				});

				if (! container.reloadDone) {
					var old = container.reload;
					container.reload = function () {
						myReload();
						old.apply(container, []);
					};
					container.reloadDone = true;
				}
			}
		});

		return false;
	});

	$(document).on('click', '.activity a.like', function () {
		var myReload = createReload(this);
		$.post($(this).attr('href'), function () {
			myReload();
		});
		return false;
	});

	$(document).on('click', '.stream-container .show-more', function () {
		var link = this
		  , page = $(link).data('page')
		  , listContainer = $(link).closest('.stream-container').find('ol:first')
		  ;

		$(link).hide();

		$.post($.service('activitystream', 'render'), {
			stream: $(link).data('stream'),
			page: page + 1
		}, function (data) {
			$(link).data('page', page + 1);
			var list = $('<div>' + data + '</div>').find('.stream-container > ol > li:not(.invalid)');
			
			list.appendTo(listContainer);

			if (list.size() > 0) {
				$(link).show();
			}
		});
	});

	$(document).on('scroll', function () {
		function elementInViewport(el) {
			var top = el.offsetTop;
			var height = el.offsetHeight;

			while(el.offsetParent) {
				el = el.offsetParent;
				top += el.offsetTop;
			}

			return top >= window.pageYOffset && (top + height) <= (window.pageYOffset + window.innerHeight);
		}

		$('.stream-container.auto-scroll .show-more:visible').each(function () {
			if (elementInViewport(this)) {
				$(this).click();
			}
		});
	});
})(jQuery);
