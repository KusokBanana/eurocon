(function (global, factory) {
    if (typeof define === "function" && define.amd) {
        define('/App/Travel', ['exports', 'Site'], factory);
    } else if (typeof exports !== "undefined") {
        factory(exports, require('Site'));
    } else {
        var mod = {
            exports: {}
        };
        factory(mod.exports, global.Site);
        global.AppTravel = mod.exports;
    }
})(this, function (exports, _Site2) {
    'use strict';

    Object.defineProperty(exports, "__esModule", {
        value: true
    });
    exports.getInstance = exports.run = exports.AppTravel = undefined;

    var _Site3 = babelHelpers.interopRequireDefault(_Site2);

    var Map = function () {
        function Map() {
            babelHelpers.classCallCheck(this, Map);

            this.window = $(window);
            this.$siteNavbar = $('.site-navbar');
            this.$siteFooter = $('.site-footer');
            this.$pageMain = $('.page-main');

            this.handleMapHeight();
        }

        babelHelpers.createClass(Map, [{
            key: 'handleMapHeight',
            value: function handleMapHeight() {
                var footerH = this.$siteFooter.outerHeight(),
                    navbarH = this.$siteNavbar.outerHeight();
                var mapH = this.window.height() - navbarH - footerH;

                this.$pageMain.outerHeight(mapH);
            }
        }, {
            key: 'getMap',
            value: function getMap() {

                var currentLat = (this.$pageMain.attr('data-current-lat')) ?
                        this.$pageMain.attr('data-current-lat') : 37.769,
                    currentLong = (this.$pageMain.attr('data-current-long')) ?
                        this.$pageMain.attr('data-current-long') : -122.446;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(getPositionSuccess);
                } else {
                    console.warn('Geolocation is not supported by this browser');
                }

                function getPositionSuccess(position) {
                    currentLat = position.coords.latitude;
                    currentLong = position.coords.longitude;
                }

                var mapLatlng = L.latLng(currentLat, currentLong);

                // this accessToken, you can get it to here ==> [ https://www.mapbox.com ]
                L.mapbox.accessToken = 'pk.eyJ1IjoiYW1hemluZ3N1cmdlIiwiYSI6ImNpaDVubzBoOTAxZG11dGx4OW5hODl2b3YifQ.qudwERFDdMJhFA-B2uO6Rg';

                return L.mapbox.map('map', 'mapbox.light').setView(mapLatlng, 9);
            }
        }]);
        return Map;
    }();

    var Markers = function () {
        function Markers(projects, companies, persons, map) {
            babelHelpers.classCallCheck(this, Markers);

            this.projects = projects;
            this.companies = companies;
            this.persons = persons;
            this.map = map;
            this.markers = null;
            this.allMarkers = [];

            this.addMarkersByOption('projects');
        }

        babelHelpers.createClass(Markers, [{
            key: 'deleteMarkers',
            value: function deleteMarkers() {
                this.map.removeLayer(this.markers);
                this.markers = null;
                this.allMarkers.length = 0;
            }
        }, {
            key: 'addMarkersByOption',
            value: function addMarkersByOption(option) {
                /* add markercluster Plugin */
                // this mapbox's Plugins,you can get it to here ==> [ https://github.com/Leaflet/Leaflet.markercluster.git ]
                this.markers = new L.MarkerClusterGroup({
                    removeOutsideVisibleBounds: false,
                    polygonOptions: {
                        color: '#444'
                    }
                });
                this.initMarkers(this.markers, this['' + option]);
                this.map.addLayer(this.markers);
            }
        }, {
            key: 'initMarkers',
            value: function initMarkers(markers, items) {
                for (var i = 0; i < items.length; i++) {
                    var path = void 0,
                        x = void 0;

                    var $item = $(items[i]);
                    var location = $item.attr('data-location');

                    if (!location || location === undefined)
                        continue;

                    location = location.split(',');
                    var markerLatlng = L.latLng(location[0], location[1]);

                    path = $(items[i]).find('img').attr('src');

                    var divContent = '<div class=\'in-map-markers\'>\n                          <div class=\'marker-icon\'>\n                            <img src=\'' + path + '\'/>\n                          </div>\n                        </div>';

                    var itemImg = L.divIcon({
                        html: divContent,
                        iconAnchor: [0, 0],
                        className: ''
                    });

                    /* create new marker and add to map */
                    var obj = {};
                    var itemName = $(items[i]).find('.item-name').html(),
                        itemTitle = $(items[i]).find('.item-title').html(),
                        itemBy = $(items[i]).find('.item-by span').html(),
                        infoType = $(items[i]).attr('data-info-type'),
                        link = $(items[i]).find('.item-link').attr('href'),
                        infoColor = $(items[i]).attr('data-info-color');
                    var infoTab = (!!infoType) ?
                        '<div style="background-color: ' + infoColor + '!important;" class=\'detail\'>'+
                            infoType+
                        '</div>' : '';
                    itemBy = (!!itemBy) ? '<p>By ' + itemBy + '</p>' : '';

                    var popupInfo = '<div class=\'marker-popup-info\'>'+ infoTab +
                        '<h3>' + itemName + '</h3>' + itemBy +
                        '</div><a href="'+link+'" target="_blank"><i class=\'icon wb-chevron-right-mini\'></i></a>';

                    obj = {
                        title: itemName,
                        icon: itemImg
                    };

                    var marker = L.marker(markerLatlng, obj);
                    marker.bindPopup(popupInfo, {
                        closeButton: false
                    });

                    markers.addLayer(marker);

                    this.allMarkers.push(marker);

                    marker.on('popupopen', function () {
                        this._icon.className += ' marker-active';
                        this.setZIndexOffset(999);
                    });

                    marker.on('popupclose', function () {
                        if (this._icon) {
                            this._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable';
                        }
                        this.setZIndexOffset(450);
                    });
                }
            }
        }, {
            key: 'getAllMarkers',
            value: function getAllMarkers() {
                return this.allMarkers;
            }
        }, {
            key: 'getMarkersInMap',
            value: function getMarkersInMap() {
                var inMapMarkers = [];
                var allMarkers = this.getAllMarkers();

                /* Get the object of all Markers in the map view */
                for (var i = 0; i < allMarkers.length; i++) {
                    if (this.map.getBounds().contains(allMarkers[i].getLatLng())) {
                        inMapMarkers.push(allMarkers.indexOf(allMarkers[i]));
                    }
                }

                return inMapMarkers;
            }
        }]);
        return Markers;
    }();

    var AppTravel = function (_Site) {
        babelHelpers.inherits(AppTravel, _Site);

        function AppTravel() {
            babelHelpers.classCallCheck(this, AppTravel);
            return babelHelpers.possibleConstructorReturn(this, (AppTravel.__proto__ || Object.getPrototypeOf(AppTravel)).apply(this, arguments));
        }

        babelHelpers.createClass(AppTravel, [{
            key: 'processed',
            value: function processed() {
                babelHelpers.get(AppTravel.prototype.__proto__ || Object.getPrototypeOf(AppTravel.prototype), 'processed', this).call(this);

                this.window = $(window);
                this.$pageAside = $('.page-aside');

                this.$allProjects = $('.app-travel .projects-info');
                this.allProjects = this.getAllListItems(this.$allProjects);
                this.$allCompanies = $('.app-travel .companies-info');
                this.allCompanies = this.getAllListItems(this.$allCompanies);
                this.$allPersons = $('.app-travel .persons-info');
                this.allPersons = this.getAllListItems(this.$allPersons);

                this.mapbox = new Map();
                this.map = this.mapbox.getMap();

                this.markers = new Markers(this.$allProjects, this.$allCompanies, this.$allPersons, this.map);
                this.allMarkers = this.markers.getAllMarkers();

                this.markersInMap = null;
                this.projectsNum = null;
                this.companiesNum = null;
                this.personsNum = null;

                this.handleResize();

                this.steupListItem('projects');
                this.steupListItem('companies');
                this.steupListItem('persons');

                this.steupMapChange();
                this.setupTabChange();
                this.handleSwitchClick();
                this.handleSpotAction();
                this.handleFilterChange();
            }
        }, {
            key: 'getAllListItems',
            value: function getAllListItems($allListItems) {
                var allListItems = [];
                $allListItems.each(function () {
                    allListItems.push(this);
                });

                return allListItems;
            }
        }, {
            key: 'getDefaultState',
            value: function getDefaultState() {
                return Object.assign(babelHelpers.get(AppTravel.prototype.__proto__ || Object.getPrototypeOf(AppTravel.prototype), 'getDefaultState', this).call(this), {
                    mapChange: true,
                    listItemActive: false,
                    optionChange: 'projects'
                });
            }
        }, {
            key: 'getDefaultActions',
            value: function getDefaultActions() {
                var self = this;
                return Object.assign(babelHelpers.get(AppTravel.prototype.__proto__ || Object.getPrototypeOf(AppTravel.prototype), 'getDefaultActions', this).call(this), {
                    optionChange: function optionChange(change) {
                        if (change) {
                            console.log('tab change');
                            if (self.markers.markers) {
                                self.markers.deleteMarkers();
                            }
                            var tabOption = self.getState('optionChange'); // projects,companies,persons
                            self.markers.addMarkersByOption(tabOption);
                            self.changeListItemsByOption(tabOption);

                        }
                    },
                    mapChange: function mapChange(change) {
                        if (change) {
                            console.log('map change');
                        } else {
                            var tabOption = self.getState('optionChange');
                            self.changeListItemsByOption(tabOption);
                        }
                    },
                    listItemActive: function listItemActive(active) {
                        if (active) {
                            var tabOption = self.getState('optionChange');
                            this.changeMapOnListActiveByOption(tabOption);
                        } else {
                            console.log('listItem unactive');
                        }
                    }
                });
            }
        }, {
            key: 'changeListItems',
            value: function changeListItems(allListItems) {
                var itemsInList = [];
                this.markersInMap = this.markers.getMarkersInMap();
                for (var i = 0; i < this.allMarkers.length; i++) {
                    if (this.markersInMap.indexOf(i) === -1) {
                        $(allListItems[i]).hide();
                    } else {
                        $(allListItems[i]).show();
                        itemsInList.push($(allListItems[i]));
                    }
                }
                return itemsInList;
            }
        }, {
            key: 'onProjectsListChange',
            value: function onProjectsListChange(projectsItemsInList) {
                $('.clearfix.hidden-xl-down').remove();
                for (var i = 0; i < projectsItemsInList.length; i++) {
                    if (i > 0 && (i + 1) % 2 === 0) {
                        var $clear = $('<div></div>').addClass('clearfix hidden-xl-down');
                        projectsItemsInList[i].after($clear);
                    }
                }
            }
        }, {
            key: 'onPersonsListChange',
            value: function onPersonsListChange(personsItemsInList) {
                var $lastReview = $('.last-review');
                if ($lastReview.length > 0) {
                    $lastReview.removeClass('last-review');
                }
                var length = personsItemsInList.length;
                if (length > 0) {
                    personsItemsInList[length - 1].addClass('last-review');
                }
            }
        }, {
            key: 'changeListItemsByOption',
            value: function changeListItemsByOption(option) {
                var optionString = option.substring(0, 1).toUpperCase() + option.substring(1);

                var itemsInList = this.changeListItems(this['all' + optionString]);
                console.log(itemsInList);
                this['on' + optionString + 'ListChange'] ? this['on' + optionString + 'ListChange'](itemsInList) : '';

                this.window.trigger('resize');
            }
        }, {
            key: 'changeMapOnListActive',
            value: function changeMapOnListActive(num) {
                this.map.panTo(this.allMarkers[num].getLatLng());
                this.allMarkers[num].openPopup();
            }
        }, {
            key: 'changeMapOnListActiveByOption',
            value: function changeMapOnListActiveByOption(option) {
                this.changeMapOnListActive(this[option + 'Num']);
            }
        }, {
            key: 'steupListItem',
            value: function steupListItem(option) {
                var _this2 = this;

                var self = this;
                var optionString = option.substring(0, 1).toUpperCase() + option.substring(1);

                this['$all' + optionString].on('click', function () {
                    $('.rating').on('click', function (event) {
                        event.stopPropagation();
                    });

                    self[option + 'Num'] = self['all' + optionString].indexOf(this);
                    self.setState('listItemActive', true);
                });

                this['$all' + optionString].on('mouseup', function () {
                    _this2.setState('listItemActive', false);
                });
            }
        }, {
            key: 'setupTabChange',
            value: function setupTabChange() {
                var self = this;
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    var href = $(e.target).attr('href'); // #projects,#companies,#persons

                    if (href) {
                        var option = href.substring(1);
                        self.setState('optionChange', '' + option);
                    }
                    // e.relatedTarget; /* previous active tab */
                });
            }
        }, {
            key: 'steupMapChange',
            value: function steupMapChange() {
                var _this3 = this;

                this.map.on('viewreset move', function () {
                    _this3.setState('mapChange', true);
                });

                this.map.on('ready blur moveend dragend zoomend', function () {
                    _this3.setState('mapChange', false);
                });
            }
        }, {
            key: 'handleSwitchClick',
            value: function handleSwitchClick() {
                var self = this;
                $(document).on('click', '.page-aside .page-aside-switch', function (event) {
                    if (self.$pageAside.hasClass('open')) {
                        var tabOption = self.getState('optionChange');
                        self.changeListItemsByOption(tabOption);
                    } else {
                        event.stopPropagation();
                    }
                });
            }
        }, {
            key: 'handleResize',
            value: function handleResize() {
                var _this4 = this;

                this.window.on('resize', function () {
                    _this4.mapbox.handleMapHeight();
                });
            }
        }, {
            key: 'handleSpotAction',
            value: function handleSpotAction() {
                $(document).on('click', '.card-actions', function () {
                    var $this = $(this);
                    $this.toggleClass('active');
                });
            }
        }, {
            key: 'handleFilterChange',
            value: function handleFilterChange() {
                var self = this;
                $(document).on('change submit', '.location-filter', function (e) {
                    e.preventDefault();
                    var $this = $(this);

                    var tabOption = self.getState('optionChange'),
                        firstLetterOption = tabOption.substring(0, 1).toUpperCase() + tabOption.substring(1),
                        $allItems = self['$all'+firstLetterOption];

                    var filters = $this.serializeArray();
                    var filterArray = {};
                    $.each(filters, function() {
                        if (this.value && this.name) {
                            if (filterArray[this.name] !== undefined) {
                                filterArray[this.name] = [filterArray[this.name]];
                                filterArray[this.name].push(this.value);
                            } else {
                                filterArray[this.name] = this.value;
                            }
                        }
                    });

                    console.log('filter', filterArray);
                    // console.log(self);
                    console.log('items before', $allItems);
                    if ($allItems.length) {
                        var filteredItems = $allItems.filter(function() {

                            var filter = $(this).attr('data-filter_data');
                            filter = JSON.parse(filter);
                            console.log('item values', filter);

                            var is = true;

                            $.each(filterArray, function(name, values) {

                                var itemVal = filter[name];

                                if (itemVal !== undefined) {

                                    if (typeof itemVal === 'object')
                                        itemVal = Object.values(itemVal);

                                    if (!Array.isArray(itemVal))
                                        itemVal = itemVal.toString();

                                    console.log(name);
                                    console.log(values);

                                    if (name === 'tags[]') {
                                        values = (Array.isArray(values)) ? values : [values];
                                        is = values.some(function(val) {
                                            return itemVal.includes(val);
                                        });
                                        console.log('in each tags', values, name, itemVal, is);

                                    } else {

                                        if (Array.isArray(values)) {

                                            if (values.indexOf(itemVal) === -1) {
                                                is = false;
                                            }

                                        } else {
                                            if (name === 'name') {
                                                if (itemVal.toLowerCase().indexOf(values.toLowerCase()) === -1) {
                                                    is = false;
                                                }
                                            } else {
                                                if (values !== itemVal) {
                                                    is = false;
                                                }
                                            }
                                        }

                                    }

                                    if (!is)
                                        return false;
                                }

                            });

                            return is;

                        })
                    }

                    self.markers['' + tabOption] = filteredItems;
                    self.getDefaultActions().optionChange(true);

                    $allItems.hide();
                    filteredItems.show();
                    self.getDefaultActions().mapChange();

                });
            }
        }]);
        return AppTravel;
    }(_Site3.default);

    var instance = null;

    function getInstance() {
        if (!instance) {
            instance = new AppTravel();
        }
        return instance;
    }

    function run() {
        var app = getInstance();
        app.run();
    }

    exports.default = AppTravel;
    exports.AppTravel = AppTravel;
    exports.run = run;
    exports.getInstance = getInstance;
});
