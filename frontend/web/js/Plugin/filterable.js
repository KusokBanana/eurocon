(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Plugin/filterable', ['exports', 'jquery', 'Plugin'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'), require('Plugin'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Plugin);
    global.PluginFilterable = mod.exports;
  }
})(this, function (exports, _jquery, _Plugin2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  var _Plugin3 = babelHelpers.interopRequireDefault(_Plugin2);

  var NAME = 'filterable';

  var Filterable = function (_Plugin) {
    babelHelpers.inherits(Filterable, _Plugin);

    function Filterable() {
      babelHelpers.classCallCheck(this, Filterable);
      return babelHelpers.possibleConstructorReturn(this, (Filterable.__proto__ || Object.getPrototypeOf(Filterable)).apply(this, arguments));
    }

    babelHelpers.createClass(Filterable, [{
      key: 'getName',
      value: function getName() {
        return NAME;
      }
    }, {
      key: 'render',
      value: function render() {
        if (typeof _jquery2.default.fn.isotope === 'undefined') {
          return;
        }

        var $el = this.$el,
            options = _jquery2.default.extend(this.options, {
          filter: '*'
        });

        this.$el.isotope(options);
        this.$filters = (0, _jquery2.default)(options.filters);

        var self = this;

        function filterHandle(e, that) {
            var $this = (0, _jquery2.default)(that);
            var $li = $this.parent('li');

            $li.siblings().find('.nav-link.active').each(function () {
                (0, _jquery2.default)(this).attr('aria-expanded', false).removeClass('active');
            });

            $this.addClass('active').attr('aria-expanded', true);

            var filter = $this.attr('data-filter');
            var isSetSearch = setSearchSelectors();
            if (isSetSearch) {
                filter += '.project-filter-search';
            }
            // if (filter !== '*') {
                // var filterArr = filter.split(';');
                // $.each(filterArr, function() {
                //   filter += '[data-type'
                // });
                // filter = '[data-type="' + filter + '"]';

            // }
            self.$el.isotope({
                filter: filter
            });

            e.preventDefault();
        }

        function setSearchSelectors(clear) {
          var searchInput = (0, _jquery2.default)('#projects-search-filter');
          var searchValue = searchInput.val();

          var searched = (0, _jquery2.default)('.project-filter-search');
          if (searched.length) {
            searched.removeClass('project-filter-search');
          }

          if (!searchValue || clear === true)
            return;

          var itemsBlock = (0, _jquery2.default)('[data-plugin="filterable"]');
          var lis = itemsBlock.find('li');
          $.each(lis, function() {
            var item = (0, _jquery2.default)(this);
            var search = searchValue.toLowerCase();
            var text = item.attr('data-search').toLowerCase();

            if (text.indexOf(search) !== -1) {
              item.addClass('project-filter-search');
            }

          });

            return true;

        }

        (0, _jquery2.default)('[data-filter]', this.$filters).on('click', function (e) {
          filterHandle(e, this);
        });
        (0, _jquery2.default)('#filter-search-btn').on('click', function (e) {
          var activeTab = (0, _jquery2.default)('#projectsFilter').find('.active.nav-link');
          filterHandle(e, activeTab[0]);
          return false;
        });
        (0, _jquery2.default)('#projects-search-filter').on('keyup', function (e) {
            if(e.keyCode === 13){
                e.preventDefault();
                var activeTab = (0, _jquery2.default)('#projectsFilter').find('.active.nav-link');
                filterHandle(e, activeTab[0]);
            }
        });
      }
    }], [{
      key: 'getDefaults',
      value: function getDefaults() {
        return {
          animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
          }
        };
      }
    }]);
    return Filterable;
  }(_Plugin3.default);

  _Plugin3.default.register(NAME, Filterable);

  exports.default = Filterable;
});
